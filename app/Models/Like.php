<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    
    /**
     * fillable attributes
     */
    protected $fillable = ['videos_id', 'users_id', 'status'];


    /**
     * User that own the like
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'users_id', 'id');
    }


    /**
     * Video that has the like
     */
    public function video()
    {
        return $this->belongsTo('App\Models\Video', 'videos_id', 'id');
    }

}
