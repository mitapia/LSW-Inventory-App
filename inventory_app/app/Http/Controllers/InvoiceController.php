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
        // Show all OPEN invoices
        $invoices = App\Invoice::open()->get();
        $page = 'invoice.index';

        // Forward directly to the create page
        return view('invoice.index', compact('invoices', 'page'));
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
        $vendors = App\Vendor::all();
        $page = 'invoice.create';

        return view('invoice.create', compact('sizes', 'departments', 'vendors', 'page'));
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

        // Validate submited data
        $this->validate($request, [
            'form.vendor' => 'required|exists:vendor,id',
            'form.invoice_number' => 'required|max:32',
            'form.page_number' => 'required|numeric|min:1|max:'.$data['form']['page_total'],
            'form.page_total' => 'required|numeric|min:1',
            'form.notes' => 'max:255',
        ]);

        // loops through table contents to Validate
        for ($i=0; $i < (count($data['table']) - 1); $i++) { 
            $this->validate($request, [
                'table.'.$i.'.style' => 'required|max:32',
                'table.'.$i.'.cost' => 'required|numeric',
                'table.'.$i.'.size' => 'required|exists:size_matrix,name,vendor_id,'.$data['form']['vendor'],
                'table.'.$i.'.department' => 'required|exists:department,name',
                'table.'.$i.'.color' => 'required|max:12',
            ]);
        };
            

        $invoice = new App\Invoice;

        $invoice->invoice_number  = $data['form']['invoice_number'];
        $invoice->page_number     = $data['form']['page_number'];
        $invoice->total_pages     = $data['form']['page_total'];
        $invoice->notes           = $data['form']['notes'];

        $invoice->created_by      = 'staff';
        $invoice->vendor_id       = $data['form']['vendor'];

        $invoice->save();  

        // Use the ID of the last created Invoice
        $last_invoice = App\Invoice::lastCreated()->id;

        // loop through items in table and add them to inventory_prep
        for ($i=0; $i < (count($data['table']) - 1); $i++) { 
            $style  = $data['table'][$i]['style'];
            $cost = $data['table'][$i]['cost'];
            $color  = $data['table'][$i]['color'];
            
            $department_id  = App\Department::where('name', $data['table'][$i]['department'])->firstOrFail()->id;
            $size_matrix_id = App\Size_Matrix::where('name', $data['table'][$i]['size'])->firstOrFail()->id;

            $inventory = new App\Inventory_Prep;

            $inventory->style       = $style;
            $inventory->cost        = $cost;
            $inventory->color       = $color;
            $inventory->department_id   = $department_id;
            $inventory->invoice_id      = $last_invoice;
            $inventory->size_matrix_id  = $size_matrix_id;

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

        return view('invoice.view', [ 'invoice' => $invoice, 'page' => 'invoice.index' ]);
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
