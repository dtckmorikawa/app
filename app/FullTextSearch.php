<?php

namespace App;

trait FullTextSearch
{
    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~','*'];
        $term = str_replace($reservedSymbols, '', $term);

        //全角スペースで区切ってあれば半角スペースに変更
        $term = str_replace('　', ' ', $term);
        
        //半角スペースで区切って配列に
        $words = explode(' ', $term);
        
        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            //dd(mb_strlen($word,'utf-8'));
            if(mb_strlen($word,'utf-8') >= 2) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);
        return $searchTerm;
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        $columns = implode(',',$this->searchable);
        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)" , $this->fullTextWildcards($term));
        return $query;
    }
}