<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = App\Inventory_Prep::where('invoice_id', 7)->get();
        return view('quantity.create', ['invoice' => $items, 'page' => 'quantity.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        //return $request->id;

        $items = App\Invoice::findorFail($request->id);
        //return $items->Inventory_Prep;
        //return view('quantity.create');
        return view('quantity.create', ['invoice' => $items, 'page' => 'quantity.create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Store request
        $qty = $request->all();

        // validate itmes in table
        for ($i=0; $i < count($qty); $i++) { 
            $this->validate($request, [
                $i.'.id' => 'required|unique:quantity,inventory_prep_id',
                $i.'.warehouse' => 'required|numeric|min:0',
                $i.'.berry' => 'required|numeric|min:0',
                $i.'.lancaster' => 'required|numeric|min:0',
                $i.'.wichita' => 'required|numeric|min:0'
            ]);
        }

        // loop through table to save qty
        foreach ($qty as $item) {
            $quantity = new App\Quantity;

            $quantity->inventory_prep_id = $item['id'];
            $quantity->store_1  = $item['warehouse'];
            $quantity->store_2  = $item['berry'];
            $quantity->store_3  = $item['lancaster'];
            $quantity->store_4  = $item['wichita'];

            $quantity->save();

            // change quantiy_set flag to true
            $inventory_prep = App\Inventory_Prep::findOrFail($item['id']);

            $inventory_prep->quantity_set = true;

            $inventory_prep->save();
        }
        return json_encode(array('status' => 'success'));
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
