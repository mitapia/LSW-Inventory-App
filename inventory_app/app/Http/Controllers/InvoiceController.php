<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $invoices = App\Invoice::all();

        // Forward directly to the create page
        return view('invoice.index', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sizes = App\Size_Matrix::all();
        $departments = App\Department::all();
        $categories = App\Category::all();
        $vendors = App\Vendor::all();

        return view('invoice.create', [ 
            'sizes' => $sizes, 
            'departments' => $departments, 
            'categories' => $categories,
            'vendors' => $vendors
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
        // Dump all data into $data
        $data = $request->all();

        $invoice = new App\Invoice;

        $invoice->invoice_number  = $data['form']['invoice_number'];
        $invoice->page_number     = $data['form']['page_number'];
        $invoice->total_pages    = $data['form']['page_total'];
        $invoice->notes           = $data['form']['notes'];

        $invoice->created_by      = 'test001';
        $invoice->vendor_id       = $data['form']['vendor'];

        $invoice->save();  

        // Use the ID of the last created Invoice
        $last_invoice = App\Invoice::lastCreated()->id;

        // loop through items in table and add them to inventory_prep
        for ($i=0; $i < (count($data['table']) - 1); $i++) { 
            $style  = $data['table'][$i]['style'];
            $cost = $data['table'][$i]['cost'];
            $notes  = $data['table'][$i]['note'];
            
            $department_id  = App\Department::where('name', $data['table'][$i]['department'])->firstOrFail()->id;
            $category_id    = App\Category::where('name', $data['table'][$i]['category'])->firstOrFail()->id;
            $size_matrix_id = App\Size_Matrix::where('name', $data['table'][$i]['size'])->firstOrFail()->id;

            $inventory = new App\Inventory_Prep;

            $inventory->style       = $style;
            $inventory->cost    = $cost;
            $inventory->notes     = $notes;
            $inventory->department_id     = $department_id;
            $inventory->category_id     = $category_id;
            $inventory->invoice_id     = $last_invoice;
            $inventory->size_matrix_id     = $size_matrix_id;

            $inventory->save();
        }

        return json_encode(array('status' => 'success', 'invoice_id' => $last_invoice));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // check that the invoive exists
        $invoice = App\Invoice::findOrFail($id);

        return view('invoice.view', [ 'invoice' => $invoice ]);
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
