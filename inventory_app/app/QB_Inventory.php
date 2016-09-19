<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QB_Inventory extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qb_inventory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['qb_id', 'style', 'color', 'size', 'upc'];

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany('App\Reoder_History');
    }
}
