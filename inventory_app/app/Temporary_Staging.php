<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporary_Staging extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'temporary_stagings';

    /**
     * Get the inventory_prep that own the staging item.
     */
    public function inventory_prep()
    {
        return $this->belongsTo('App\Inventory_Prep');
    }

    /**
     * Get the price_rule that own the staging item.
     */
    public function price_rule()
    {
        return $this->belongsTo('App\Price_Rule');
    }

    /**
     * Scope a query to only include items ready to export.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReadyToExport($query)
    {
        return $query->with([
                'inventory_prep', 
                'inventory_prep.department',
                'inventory_prep.invoice',
                'inventory_prep.size_matrix',
                'inventory_prep.detail',
                'inventory_prep.quantity'
            ])
            ->where('reorder', false)
            ->where('price_rule_id', '!=', '0');
    }

    /**
     * Scope a query to only include reorder items.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReadyToExport($query)
    {
        return $query->with([
                'inventory_prep', 
                'inventory_prep.detail',
                'inventory_prep.quantity'
            ])
            ->where('reorder', true);
    }
}
