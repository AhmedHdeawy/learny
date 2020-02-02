<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'categories';

    /**
     * translated attributes
     */
    public $translatedAttributes = ['categories_title', 'categories_desc'];

    /**
     * fillable attributes
     */
    protected $fillable = ['categories_status'];

    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('categories_status', '1');
    }

    /**
     * Many to one relation with videos.
     * 
     * @return collection of branches
     */
    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'category_id', 'id');
    }
}
