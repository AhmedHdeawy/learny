<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'settings';

    /**
     * timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'settings_key', 'settings_value'
    ];

}
