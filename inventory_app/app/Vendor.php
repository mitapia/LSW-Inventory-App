<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendor';

    /**
     * The Price Rule that belong to the Vendor.
     */
    public function price_rule()
    {
        return $this->belongsToMany('App\Price_Rule')->withTimestamps();
    }

    /**
     * Get the Invoice for the Vendor.
     */
    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }  

    /**
     * Get the size_matrix for the vendor.
     */
    public function size_matrix()
    {
        return $this->hasMany('App\Size_Matrix');
    }

    /**
     * Get the size_matrix for the vendor.
     */
    public function qb_inventory()
    {
        return $this->hasMany('App\QB_Inventory');
    }
}
