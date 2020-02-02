<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoTranslation extends Model
{

    /**
     * table
     */
    protected $table = 'info_translations';

    /**
     * primary key
     */
    protected $primaryKey = 'infos_trans_id';


    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * fillable attributes
     */
    protected $fillable = ['infos_title', 'infos_desc'];


    /**
     * Info that belongs To
     */
    public function info()
    {
    	return $this->belongsTo('App\Models\Info', 'info_id', 'id');
    }
    
}
