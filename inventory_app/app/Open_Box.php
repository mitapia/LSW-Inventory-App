<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Open_Box extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'open_box';

    /**
     * Get the Category that owns the Invetory_Prep item.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the Category that owns the Invetory_Prep item.
     */
    public function online_color()
    {
        return $this->belongsTo('App\Online_Color');
    }
}
