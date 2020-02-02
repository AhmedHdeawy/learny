<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoTranslation extends Model
{

    /**
     * table
     */
    protected $table = 'video_translations';

    /**
     * primary key
     */
    protected $primaryKey = 'videos_trans_id';


    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['video_id', 'videos_title', 'videos_desc'];


    /**
     * Video that belongs To
     */
    public function video()
    {
    	return $this->belongsTo('App\Models\Video', 'video_id', 'id');
    }
    
}
