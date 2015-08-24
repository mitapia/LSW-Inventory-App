<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size_Matrix extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'size_matrix';

    /**
     * Get the inventory_prep for the Size_Matix.
     */
    public function inventory_prep()
    {
        return $this->hasMany('App\Inventory_Prep');
    }
}
