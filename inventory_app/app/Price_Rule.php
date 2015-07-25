<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_Rule extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'price_rule';

    /**
     * The Department that belong to the Price Rule.
     */
    public function department()
    {
        return $this->belongsToMany('App\Department')->withTimestamps();
    }    

    /**
     * The Category that belong to the Price Rule.
     */
    public function category()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }    

    /**
     * The Vendor that belong to the Price Rule.
     */
    public function vendor()
    {
        return $this->belongsToMany('App\Vendor')->withTimestamps();
    }
}
