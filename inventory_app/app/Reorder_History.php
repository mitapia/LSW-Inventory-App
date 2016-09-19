<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reorder_History extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reorder_history';

    /**
     * Get the item that owns this record.
     */
    public function post()
    {
        return $this->belongsTo('App\QB_Inventory');
    }

    /**
     * Get the Vendor that owns the Invoice.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
