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

    /**
     * Get the Vendor that owns the size_matrix.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    /**
     * Scope a query to find the colums with non zero values
     *
     * @return array($column => $value)
     */
    public function scopeNonZeroColumns($query, $matrix_id)
    {
        // initiate array
        $colums = [];

        // fill the array with the column names
        for ($i=0; $i <= 13; $i++) { 
            //$colums .= ', `'.$i.'_K`';
            array_push($colums, $i.'_K');
        }
        for ($i=0; $i <= 14; $i += 0.5) { 
            $name = str_replace('.', '_', strval($i)) . '_A';
            //$colums .= ', `'.$name;
            array_push($colums, $name);
        }

        $size_range = $query->where('id', $matrix_id)->get($colums)->toArray();

        foreach ($size_range[0] as $size => $qty) {
            if ($qty == 0) {
                // remove from array
                unset($size_range[0][$size]);
            }
        }

        return $size_range[0];
    }
}
