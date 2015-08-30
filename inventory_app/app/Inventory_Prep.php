<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    /**
     * Scope a query to find if item already exists in QuickBooks
     *
     * @return array()
     */
    public function scopeExistsInInventory($query, $id)
    {
        // reset invebtory count
        $inventory = 0;
        $colums = [];

        $item = $query->find($id);

        // fill the array with the column names
        for ($i=1; $i <= 13; $i++) { 
            //$colums .= ', `'.$i.'_K`';
            array_push($colums, $i.'_K');
        }
        for ($i=0; $i <= 14; $i += 0.5) { 
            $name = str_replace('.', '_', strval($i)) . '_A';
            //$colums .= ', `'.$name;
            array_push($colums, $name);
        }        

        //$matrix = Size_Matrix::where('id', $item->size_matrix_id)->get($colums)->toArray();
        $matrix = Size_Matrix::nonZeroColumns($item->size_matrix_id);

        // loop through the columns
        foreach ($matrix[0] as $key => $value) {
            // must convert key to proper format (ex. '5_5_A' => '5.5')
            if (strrpos($key, '_A')) {
                // remove trailing '_A'
                $trimed = rtrim($key, '_A');
                // convert '_' to decimal
                $size = str_replace('_', '.', strval($trimed));
            } else {
                //  '_K' should not need any addtional formating
                $size = $key;
            }
            $inventory = QB_Inventory::where('style', $item->style)
                                     ->where('color', $item->color)
                                     ->where('size', $size)
                                     ->count();
            if ($inventory > 0) {
                return array(
                    'status' => 'true', 
                    'info' => 'Style: '.$item->style.', Color: '.$item->color.', Size: '.$size
                );
            }
        }
        return array('status' => 'false');
    }
}
