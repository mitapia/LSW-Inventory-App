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
     * Using to for testing only
     *
     * @return Response
     */
    public function storeTest2()
    {
        // Make sure staging table is clear
        App\Temporary_Staging::truncate();

        // Retrive items ready to export
        $items = App\Inventory_Prep::readyToExport()->get();

        // Loop through items and expand sizes requested into staging table
        foreach ($items as $item) {
            // retrive non zero colums
            $matrix = App\Size_Matrix::nonZeroColumns($item->size_matrix_id);

            // Enter each returned size into staging table
            foreach ($matrix as $size => $quantity) {
                // Check for price rule
                $price_id = App\Price_Rule::matchPriceRule($item)->firstOrFail();


                // Check for duplicates in staging
                $duplicate_staging_item = App\Temporary_Staging::where('style', $item->style)->where('color', $item->color)->where('size', $size);

                if ($duplicate_staging_item->exists()) {
                    // check for other matching values
                    $staging_item = $duplicate_staging_item->firstOrFail();
                    
                    // update
                    $staging_item->store_1           += ( $item->quantity->store_1 * $quantity );
                    $staging_item->store_2           += ( $item->quantity->store_2 * $quantity );
                    $staging_item->store_3           += ( $item->quantity->store_3 * $quantity );
                    $staging_item->store_4           += ( $item->quantity->store_4 * $quantity );

                    $staging_item->save();

                } else {

                    // Check for re-orders **MAY DO OUTSIDE THIS LOOP**

                    $staging_item = new App\Temporary_Staging;

                    $staging_item->inventory_prep_id = $item->id;
                    $staging_item->style             = $item->style;
                    $staging_item->color             = $item->color;
                    $staging_item->size              = $size;
                    $staging_item->store_1           = ( $item->quantity->store_1 * $quantity );
                    $staging_item->store_2           = ( $item->quantity->store_2 * $quantity );
                    $staging_item->store_3           = ( $item->quantity->store_3 * $quantity );
                    $staging_item->store_4           = ( $item->quantity->store_4 * $quantity );

                    $staging_item->save();
                }
            }
        }

        return 'finished';        
    }

    /**
     * Using to for testing only
     *
     * @return Response
     */
    public function storeTest()
    {
        // Make sure staging table is clear
        // ** MUST UPDATE TO USE MODEL **
        App\Temporary_Staging::truncate();

        // Retrive items ready to export
        $items = App\Inventory_Prep::readyToExport()->get();

        /** 
         * Check for repeating style+color 
         * If none found then dont bother running any furhter checks for duplicates
         */
        $unique_style_color_list = $items->unique(function ($item) {
                return $item['style'].$item['color'];
            });
        $unique_count = $items->unique(function ($item) {
                return $item['style'].$item['color'].$item['size_matrix_id'];
            })->count();







        if ($items->count() != $unique_style_color_list->count()) {
            // check for duplicate entries
            if ($items->count() == $unique_count) {

                $duplicate_keys = $items->diff($unique_style_color_list)->unique(function ($item) {
                        return $item['style'].$item['color'];
                    });;



                //return $duplicate_keys;
                // $duplicate_keys->each(function ($duplicate_entry) use ($items) {
                //     $items->where('style', $duplicate_entry->style)->where('color', $duplicate_entry->color);
                // });

                foreach ($duplicate_keys as $duplicate_entry) {
                    $duplicate_items = $items->where('style', $duplicate_entry->style)->where('color', $duplicate_entry->color);

                    // *** Need to compare them 2 at a time *** //
                    // check if the size matix of the repeating items overlap
                    //$duplicate_items = null;


                    // $reduced_matrices = array();  // initiate empty array
                    // foreach ($duplicate_items as $item) {
                    //     $reduced_matrix = App\Size_Matrix::nonZeroColumns($item->size_matrix_id);
                    //     array_push($reduced_matrices, $reduced_matrix);
                    // }
                    // $overlaping_keys = call_user_func_array('array_intersect_key', $reduced_matrices);


                }


                // $duplicate_keys = $items->diff($unique_style_color_list)->map(function($item) { return ['style' => $item->style, 'color' => $item->color]; });


                
            } else {
                 return 'Duplicate entries found.';
            }
        }








        // Loop through items and expand sizes requested into staging table
        foreach ($items as $item) {
            // retrive non zero colums
            $matrix = App\Size_Matrix::nonZeroColumns($item->size_matrix_id);

            // Enter each returned size into staging table
            foreach ($matrix as $size => $quantity) {
                // Check for price rule
                $price_id = App\Price_Rule::matchPriceRule($item)->id();

                // Check for duplicates in staging

                // Check for re-orders **MAY DO OUTSIDE THIS LOOP**

                $staging_item = new App\Temporary_Staging;

                $staging_item->inventory_prep_id = $item->id;
                $staging_item->size              = $size;
                $staging_item->store_1           = $item->quantity->store_1;
                $staging_item->store_2           = $item->quantity->store_2;
                $staging_item->store_3           = $item->quantity->store_3;
                $staging_item->store_4           = $item->quantity->store_4;

                $staging_item->save();
            }
        }

        return 'finished';
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
                        // 'Qty 15' => a
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
        })->export('xls');

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
