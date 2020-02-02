<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'contactus';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'message'
    ];

}
