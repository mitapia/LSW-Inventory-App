<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     * Since only admin level users will be able to access Registration this is ok.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the user that owns the permission.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
