<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PriceRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $count_departments = App\Department::count();
        $count_categories = App\Category::count();
        $count_vendors = App\Vendor::count();

        $rules = App\Price_Rule::get()->sortBy('priority');
        $last_priority = $rules->last();

        return view('settings.price_rule.index', [
            'price_rules' => $rules, 
            'page' => 'settings',
            'total_departments' => $count_departments,
            'total_categories' => $count_categories,
            'total_vendors' => $count_vendors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin');

        $departments = App\Department::all();
        $categories = App\Category::all();
        $vendors = App\Vendor::all();
        $price_rule = App\Price_Rule::get()->sortBy('priority')->last();
        $last_priority = empty($price_rule->priority) ? 1 : ++$price_rule->priority;

        return view('settings.price_rule.create', [
            'departments' => $departments, 
            'categories'  => $categories,
            'vendors'     => $vendors,
            'page' => 'settings',
            'next_priority' => $last_priority
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin');

        // Validation
        $this->validate($request, [
            'min' => 'required|numeric|min:0.01',
            'max' => 'required|numeric|min:0.01',

            'regular_price' => 'required|numeric|min:0.01',
            'employee_price' => 'required|numeric|min:0.01',
            'wholesale_price' => 'required|numeric|min:0.01',

            'priority' => 'required|numeric|integer|min:1',
            //'rewards' => 'required|boolean',

            'department' => 'required|exists:department,id',
            'category' => 'required|exists:category,id',
            'vendor' => 'required|exists:vendor,id',
        ]);

        DB::transaction(function () use ($request) {
            $rule = new App\Price_Rule;

            $rule->minimum_cost = $request->input('min');
            $rule->maximum_cost = $request->input('max');
            $rule->item_description = $request->input('item_description');
            $rule->regular_price = $request->input('regular_price');
            $rule->custom_price_1 = $request->input('regular_price');
            $rule->custom_price_2 = $request->input('employee_price');
            $rule->custom_price_3 = $request->input('wholesale_price');
            $rule->custom_price_4 = $request->input('regular_price');
            $rule->rewards = $request->input('rewards');
            $rule->priority = $request->input('priority');

            $rule->save();

            $rule->department()->attach($request->input('department'));
            $rule->category()->attach($request->input('category'));
            $rule->vendor()->attach($request->input('vendor'));
        });

        return redirect()->route('settings.price_rule.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('admin');
    }
}
