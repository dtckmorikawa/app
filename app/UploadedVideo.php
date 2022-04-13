<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; 

class UploadedVideo extends Model
{
        //traits
    use FullTextSearch;
    use Sortable;

    public $table = 'uploaded_video';
    
    public $casts = [
        'uploaded_videos' => 'array',
    ];
    public $fillable = [
        'video_title',
        'uploader_id',
        'source', 
        'uploaded_video',
    ];    
    /**
    * The columns of the full text index
    */
    protected $searchable = [
        'video_title',
        'uploaded_video',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function video_posts()
    {
        return $this->belongsToMany(BlogEtcPost::class, 'video_title', 'id');
    }

}
