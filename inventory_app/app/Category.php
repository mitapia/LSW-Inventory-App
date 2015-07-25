<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The Price Rule that belong to the Category.
     */
    public function price_rule()
    {
        return $this->belongsToMany('App\Price_Rule')->withTimestamps();
    }

    /**
     * Get the inventory_prep for the Category.
     */
    public function inventory_prep()
    {
        return $this->hasMany('App\Inventory_Prep');
    }    
}
