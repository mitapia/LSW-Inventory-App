<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice';

    /**
     * Get the inventory_prep for the Invoice.
     */
    public function inventory_prep()
    {
        return $this->hasMany('App\Inventory_Prep');
    }  

    /**
     * Get the Vendor that owns the Invoice.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    /**
     * Scope a query to only include last server added.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastCreated($query)
    {

        return $query->orderBy('created_at', 'desc')->firstorFail();
    }
}
