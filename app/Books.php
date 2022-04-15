<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; 
use WebDevEtc\BlogEtc\Models\BlogEtcPost;
use App\User;

class Books extends Model
{
    //traits
    use FullTextSearch;
    use Sortable;

    public $sortable = [ // ソート対象カラム追加
        'book_name', 
        'user_id' 
    ];

    public $fillable = [
        'book_name',
        'slug',
        'book_description',
        'book_structure',
        'user_id'
    ];

    /**
    * The columns of the full text index
    */
    protected $searchable = [
        'book_name',
        'book_description',
        'book_structure',
        'slug'
    ];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function book_posts()
    {
        return $this->belongsToMany(BlogEtcPost::class, 'posts_books');
    }

    public function book_category_name()
    {
        return $this->belongsToMany(BlogEtcCategory::class, 'book_categories');
    }

    /**
    * Returns the URL for an admin user to edit this category
    * @return string
    */
    public function book_edit_url()
    {
        return route("adminbook.edit", $this->id);
    }

    public function book_author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book_author_string()
    {
        if ($this->book_author) {
            return optional($this->book_author)->name;
        } else {
            return 'Unknown Author';
        }
    }


}
