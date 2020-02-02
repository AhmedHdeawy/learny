<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Info extends Model implements TranslatableContract
{
    use Translatable;


    /**
     * translated attributes
     */
    public $translatedAttributes = ['infos_title', 'infos_desc'];

    /**
     * fillable attributes
     */
    protected $fillable = ['infos_key', 'infos_status'];


}
