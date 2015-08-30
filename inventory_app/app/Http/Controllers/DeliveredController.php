<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeliveredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $open_invoices = App\Invoice::open()->get();

        return view('delivered.index', ['invoices' => $open_invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $delivered = $request->all();

        if (empty($delivered)) {
             return 'No item was selected';
        }

        /**
         *  Validations
         * 
         *  - Make sure id exists and is numeric
         *  - Chekc if item is a reorder
         *  
         *  Reoder - to determine a reoder must check for existence of particular item in current inventory
         *  Unique itme - a unique combination of 3 specific fields: style(Item Name), color(Attribute), size
         *
        */
        for ($i=0; $i < count($delivered['checkbox']); $i++) { 
            $this->validate($request, [
                'checkbox.'.$i  =>  'required|numeric|exists:inventory_prep,id',
            ]);  
        }

        foreach ($delivered['checkbox'] as $item) {
            $exists = App\Inventory_Prep::existsInInventory($item);
            if ($exists['status']  == 'true') {
                // must mark item for reorder
                  App\Inventory_Prep::where('id', $item)
                                    ->update(['reorder' => true]);      
                return json_encode('Item '.$exists['info'].' exists. Setting Item as Re-Order.');
            }
        }
        
        App\Inventory_Prep::whereIn('id', $delivered['checkbox'])
          ->update(['delivered' => true]);

        //** this must be change to a success json
        return json_encode('success');
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
