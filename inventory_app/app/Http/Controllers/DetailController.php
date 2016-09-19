<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Query all open Invoices
        $invoices = App\Invoice::open()->get();

        return view('detail.index', ['invoices' => $invoices, 'page' => 'detail.index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $invoice = App\Invoice::findorFail($request->id);
        $colors = App\Online_Color::all();
        $cat = App\Category::all();

        return view('detail.create', [ 
            'invoice' => $invoice, 
            'colors' => $colors, 
            'categories' => $cat,
            'page' => 'detail.create'
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
        // Store request
        $details = $request->all();

        // validate items in table
        for ($i=0; $i < count($details); $i++) { 
            $this->validate($request, [
                $i.'.id' => 'required|unique:detail,inventory_prep_id',
                $i.'.brand' => 'required|max:31',
                $i.'.category' => 'required|exists:category,name',
                $i.'.online_color' => 'required|exists:online_color,name',
            ]);
        };

        // loop through table to save items
        foreach ($details as $item) {
            $category = App\Category::where('name', $item['category'])->firstOrFail()->id;
            $color = App\Online_Color::where('name', $item['online_color'])->firstOrFail()->id;

            $detail = new App\Detail;

            $detail->brand             = $item['brand'];
            $detail->category_id       = $category;
            $detail->online_color_id   = $color;
            $detail->inventory_prep_id = $item['id'];

            $detail->save();

            // change detail_set flag to true
            $inventory_prep = App\Inventory_Prep::findOrFail($item['id']);

            $inventory_prep->detail_set = true;

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
