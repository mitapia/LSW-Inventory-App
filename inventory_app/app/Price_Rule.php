<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_Rule extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'price_rule';

    /**
     * The Department that belong to the Price Rule.
     */
    public function department()
    {
        return $this->belongsToMany('App\Department', 'department_price_rule', 'price_rule_id')->withTimestamps();
    }    

    /**
     * The Category that belong to the Price Rule.
     */
    public function category()
    {
        return $this->belongsToMany('App\Category', 'category_price_rule', 'price_rule_id')->withTimestamps();
    }    

    /**
     * The Vendor that belong to the Price Rule.
     */
    public function vendor()
    {
        return $this->belongsToMany('App\Vendor', 'price_rule_vendor', 'price_rule_id')->withTimestamps();
    }

    /**
     * Scope a query to find the colums with non zero values
     *
     * @return array(
     *          $item_desctiption, 
     *          $regular_price
     *          $custom_1
     *          $custom_2
     *          $custom_3
     *          $custom_4
     *          $rewards
     *         )
     */
    public function scopeGenerate($query, $inventory_id)
    {
        // retrive info of item
        $item = Inventory_prep::find($inventory_id);
 
        // select appropriate rule to use
        $rule = Price_Rule::where('minimum_cost', '<=', $item->cost)
                        ->where('maximum_cost', '>=', $item->cost)
                        ->orderBy('priority')

                        ->has('department')
                        //->has('category')
                        //->has('')

                        ->first();

        $generated = array(
            'item_description' => $rule->item_desctiption,
            'regular_price' => $rule->regular_price, 
            'custom_1' => $rule->custom_price_1, 
            'custom_2' => $rule->custom_price_2,
            'custom_3' => $rule->custom_price_3,
            'custom_4' => $rule->custom_price_4,
            'rewards' => $rule->rewards
        );
        return $generated;
    }
}
