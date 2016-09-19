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
     * Get the inventory_prep for the staging item.
     */
    public function inventory_prep()
    {
        return $this->hasMany('App\Inventory_Prep');
    }
}
