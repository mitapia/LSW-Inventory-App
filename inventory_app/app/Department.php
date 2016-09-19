<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'department';

    /**
     * The Price Rule that belong to the Department.
     */
    public function price_rule()
    {
        return $this->belongsToMany('App\Price_Rule')->withTimestamps();
    }

    /**
     * Get the inventory_prep for the Department.
     */
    public function inventory_prep()
    {
        return $this->hasMany('App\Inventory_Prep');
    }
}
