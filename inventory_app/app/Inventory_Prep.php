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
     * Get the Category that owns the Invetory_Prep item.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the Invoice that owns the Invetory_Prep item.
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
