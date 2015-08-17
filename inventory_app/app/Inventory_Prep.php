<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_Prep extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_prep';


    /**
     * Get the Department that owns the Invetory_Prep item.
     */
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * Get the Invoice that owns the Invetory_Prep item.
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    /**
     * Get the Size_Matrix that owns the Invetory_Prep item.
     */
    public function size_matrix()
    {
        return $this->belongsTo('App\Size_Matrix');
    }

    /**
     * Get the Quantity of the Invetory_Prep item.
     */
    public function quantity()
    {
        return $this->hasOne('App\Quantity');
    }

    /**
     * Get the Detail of the Invetory_Prep item.
     */
    public function detail()
    {
        return $this->hasOne('App\Detail');
    }
}
