<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Video extends Model implements TranslatableContract
{
    use Translatable;


    /**
     * translated attributes
     */
    public $translatedAttributes = ['videos_title', 'videos_desc'];

    /**
     * fillable attributes
     */
    protected $fillable = ['category_id', 'videos_name', 'videos_status', 'is_like', 'is_dislike'];

    /**
     * Get the the user that like the post.
     */
    public function getIsLikeAttribute()
    {
        $videoLikes = $this->likes->pluck('users_id')->toArray();
        // check if this user likes this video
        $check = in_array(Auth::guard('users')->id(), $videoLikes);

        return $check;
    }

    /**
     * Get the the user that dislike the post.
     */
    public function getIsDislikeAttribute()
    {
        $videoLikes = $this->dislikes->pluck('users_id')->toArray();
        // check if this user likes this video
        $check = in_array(Auth::guard('users')->id(), $videoLikes);

        return $check;
    }

    /**
     * Category that own the video
     */
    public function category()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }


    /**
     * likes that belongs To Video
     */
    public function likes()
    {
    	return $this->hasMany('App\Models\Like', 'videos_id', 'id')->where('status', "1");
    }

    /**
     * likes that belongs To Video
     */
    public function dislikes()
    {
    	return $this->hasMany('App\Models\Like', 'videos_id', 'id')->where('status', "2");
    }


}
