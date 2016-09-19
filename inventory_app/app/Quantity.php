<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quantity';

    /**
     * Get the inventory_prep for the Size_Matix.
     */
    public function inventory_prep()
    {
        return $this->hasMany('App\Inventory_Prep');
    }

}
