<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{

    /**
     * table
     */
    protected $table = 'category_translations';

    /**
     * primary key
     */
    protected $primaryKey = 'categories_trans_id';


    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['category_id', 'categories_title', 'categories_desc'];


    /**
     * Info that belongs To
     */
    public function category()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    
}
