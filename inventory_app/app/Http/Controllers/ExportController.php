<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use DB;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $open_invoices = App\Invoice::open()->select('id')->get();

        $items = App\Inventory_Prep::whereIn('invoice_id', $open_invoices)
                                    ->where('detail_set', true)
                                    ->where('quantity_set', true)
                                    ->where('reorder', false)
                                    ->get();
        return view('export.index', ['items' => $items, 'page' => 'export.index']);
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
        //** Debugnin and optimization only
        //DB::enableQueryLog();
        //file_put_contents('query_log.txt', date("D M j G:i:s T Y")."\r", FILE_APPEND);

        // $request will contain flag of closing invoices


        $table = array();

        $open_invoices = App\Invoice::open()->get();
        // get starting id number
        $current_id = App\QB_Inventory::max('id');


        foreach ($open_invoices as $invoice) {
            $items = App\Inventory_Prep::where('invoice_id', $invoice->id)
                                        ->where('detail_set', true)
                                        ->where('quantity_set', true)
                                        ->where('reorder', 0)
                                        ->get();

            foreach ($items as $item) {
                /*
                *   Costom price
                *  #1 - Sale
                *  #2 - Employee
                *  #3 - Wholesale
                *  #4 - Custom
                *   
                *   Qty
                *  # is based on the QuickBook class set in program not by Store Code
                *  1090 Warehouse = Qty 1
                *  1001 Berry = Qty 2
                *  1012 Wichita = Qty 3
                *  1011 Longview = Qty 4
                *  
                *   Custom Fields
                *  #1 - Brand
                *  #2 - Category
                *  #3 - Online Color
                *  #4 - (currently not in use)
                *  #5 - (currently not in use)
                */

                // request fields dependent by price
                $price = App\Price_Rule::generate($item->id);

                // need a row per size available            
                $sizes = App\Size_Matrix::nonZeroColumns($item->size_matrix_id);

                foreach ($sizes as $size => $qty) {
                    ++$current_id;
                    // vendor+department+itmenumber = 13 digits min
                    $upc = sprintf("%02u%02u%09u", $item->invoice->vendor_id, $item->department_id, $current_id);

                    $row = array(
                        'Item Number'       =>  $current_id,
                        'Item Name'         =>  $item->style,
                        'Department Name'   =>  $item->department->name,
                        'Department Code'   =>  $item->department_id,
                        'Item Description'  =>  $price['item_description'],
                        // 'Brief Description' => 
                        'Attribute'         =>  $item->color,
                        'Size'              =>  $size,
                        'Average Unit Cost' =>  $item->cost,
                        'Order Cost'        =>  $item->cost,
                        'Vendor Name'       =>  $invoice->vendor->name,
                        'Vendor Code'       =>  $invoice->vendor_id,
                        'Regular Price'  =>     $price['regular_price'],
                        'Custom Price 1' =>     $price['custom_1'],
                        'Custom Price 2' =>     $price['custom_2'],
                        'Custom Price 3' =>     $price['custom_3'],
                        'Custom Price 4' =>     $price['custom_4'],
                        'Tax Code'       =>     'Tax',
                        'UPC'       =>  $upc,
                        'Item Type' =>  'Inventory',
                        'Qty 1' =>      ($qty)*($item->quantity->{'store_1'}),
                        'Qty 2' =>      ($qty)*($item->quantity->{'store_2'}),
                        'Qty 3' =>      ($qty)*($item->quantity->{'store_3'}),
                        'Qty 4' =>      ($qty)*($item->quantity->{'store_4'}),
                        // 'Qty 5' => 
                        // 'Qty 6' => 
                        // 'Qty 7' => 
                        // 'Qty 8' => 
                        // 'Qty 9' => 
                        // 'Qty 10' => 
                        // 'Qty 11' => 
                        // 'Qty 12' => 
                        // 'Qty 13' => 
                        // 'Qty 14' => 
                        // 'Qty 15' => 
                        // 'Qty 16' => 
                        // 'Qty 17' => 
                        // 'Qty 18' => 
                        // 'Qty 19' => 
                        // 'Qty 20' => 
                        'Custom Field 1' =>     $item->detail->brand,
                        'Custom Field 2' =>     $item->detail->category->name,
                        'Custom Field 3' =>     $item->detail->online_color->name,
                        // 'Custom Field 4' => 
                        // 'Custom Field 5' => 
                        'Print Tags'              => 'Yes',
                        'Eligible for Commission' => 'No',
                        'Eligible for Rewards'    => ($price['rewards']) ? 'Yes' : 'No',
                        // 'Weight' => 
                    );

                    array_push($table, $row);
                }
            }   
        }



        Excel::create('Filename'.date('c'), function($excel) use($table) {

        $excel->sheet('Sheetname', function($sheet) use($table) {
                $sheet->fromArray($table);
            });
        })->store('xls');

        return ('ok');

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
