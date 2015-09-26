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
        $rules = App\Price_Rule::get();
        return view('price_rule.index', ['price_rules' => $rules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $departments = App\Department::all();
        $categories = App\Category::all();
        $vendors = App\Vendor::all();

        return view('price_rule.create', [
            'departments' => $departments, 
            'categories'  => $categories,
            'vendors'     => $vendors
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
        // Validation
        $this->validate($request, [
            'min' => 'required|numeric|min:0.01',
            'max' => 'required|numeric|min:0.01',

            'regular_price' => 'required|numeric|min:0.01',
            'employee_price' => 'required|numeric|min:0.01',
            'wholesale_price' => 'required|numeric|min:0.01',

            'priority' => 'required|numeric|integer|min:1',
            'rewards' => 'required|boolean',

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

            $rule->save();

            $rule->department()->attach($request->input('department'));
            $rule->category()->attach($request->input('category'));
            $rule->vendor()->attach($request->input('vendor'));
        });

        return route('price_rule.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
