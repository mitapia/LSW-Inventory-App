<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exceptions\InconsistentAttributeException;
use App\Exceptions\DuplicateIdentifierException;
use DB;

class ExportController extends Controller
{
    /**
     * Display a list of to be exported, inclding re-orders. 
     * Also warns of errors with items.  
     *
     * @return Response
     */
    public function index()
    {
        //$open_invoices = App\Invoice::open()->select('id')->get();

        // $items = App\Inventory_Prep::whereIn('invoice_id', $open_invoices)
        //                             ->where('detail_set', true)
        //                             ->where('quantity_set', true)
        //                             ->where('reorder', false)
        //                             ->get();

        // prep staging stable
        $this->populateStagingTable();
        $items = App\Temporary_Staging::all();
        $reorder_count = App\Temporary_Staging::where('reorder', true)->count();
        $missing_price_rule = App\Temporary_Staging::where('price_rule_id', '0')->count();

        return view('export.index', [
            'items' => $items, 
            'page' => 'export.index',
            'reorder_count' => $reorder_count,
            'missing_price_rule' => $missing_price_rule
        ]);
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
     * @return file
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            // prep staging stable
            //$this->populateStagingTable();

            // Querry for item to be exported
            $items = App\Temporary_Staging::readyToExport()->get();

            // This will be used to build spreadsheet
            $table = array();

            // get starting id number
            $current_id = App\QB_Inventory::max('qb_id');

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

                // Shorten variable names for easier management. In Alphabetical order
                $brand              = $item->inventory_prep->detail->brand;
                $category_name      = $item->inventory_prep->detail->category->name;
                $color              = $item->inventory_prep->color;
                $cost               = $item->inventory_prep->cost;
                ++$current_id;
                $custom_price_1     = $item->price_rule->custom_price_1;
                $custom_price_2     = $item->price_rule->custom_price_2;
                $custom_price_3     = $item->price_rule->custom_price_3;
                $custom_price_4     = $item->price_rule->custom_price_4;
                $department_id      = $item->inventory_prep->department_id;
                $department_name    = $item->inventory_prep->department->name;
                $item_description   = $item->price_rule->item_description;
                $online_color       = $item->inventory_prep->detail->online_color->name;
                $qty_1              = $item->store_1;
                $qty_2              = $item->store_2;
                $qty_3              = $item->store_3;
                $qty_4              = $item->store_4;
                $regular_price      = $item->price_rule->regular_price;
                $rewards            = $item->price_rule->rewards;
                $size               = $item->size;
                $style              = $item->inventory_prep->style;
                $vendor_id          = $item->inventory_prep->invoice->vendor_id;
                $vendor_name        = $item->inventory_prep->invoice->vendor->name;

                // vendor+department+itmenumber = 13 digits min
                $upc = sprintf("%02u%02u%09u", $vendor_id, $department_id, $current_id);

                // verify item does not exist in QB_inventory
                $duplicate_identifier = App\QB_Inventory::where('qb_id', $current_id)
                                              ->orwhere('upc', $upc);
                if ($duplicate_identifier->count() > 0) {
                    $message = 'Found a duplicate identifier in QuickBook Inventory.  Either item number: <strong>'.$current_id.'</strong> or UPC: <strong> '.$upc.'</strong> already exist in database. Please contact Development department.';
                    throw new DuplicateIdentifierException($message);
                }


                $row = array(
                    'Item Number'       =>  $current_id,
                    'Item Name'         =>  $style,
                    'Department Name'   =>  $department_name,
                    'Department Code'   =>  $department_id,
                    'Item Description'  =>  $item_description,
                    // 'Brief Description' => 
                    'Attribute'         =>  $color,
                    'Size'              =>  $size,
                    'Average Unit Cost' =>  $cost,
                    'Order Cost'        =>  $cost,
                    'Vendor Name'       =>  $vendor_name,
                    'Vendor Code'       =>  $vendor_id,
                    'Regular Price'     =>  $regular_price,
                    'Custom Price 1'    =>  $custom_price_1,
                    'Custom Price 2'    =>  $custom_price_2,
                    'Custom Price 3'    =>  $custom_price_3,
                    'Custom Price 4'    =>  $custom_price_4,
                    'Tax Code'          =>  'Tax',
                    'UPC'               =>  $upc,
                    'Item Type'         =>  'Inventory',
                    'Qty 1'             =>  $qty_1,
                    'Qty 2'             =>  $qty_2,
                    'Qty 3'             =>  $qty_3,
                    'Qty 4'             =>  $qty_4,
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
                    'Custom Field 1'    =>   $brand,
                    'Custom Field 2'    =>   $category_name,
                    'Custom Field 3'    =>   $online_color,
                    // 'Custom Field 4' => 
                    // 'Custom Field 5' => 
                    'Print Tags'              => 'Yes',
                    'Eligible for Commission' => 'No',
                    'Eligible for Rewards'    => ($rewards) ? 'Yes' : 'No',
                    // 'Weight' => 
                );
                array_push($table, $row);

                $qb_inventory = App\QB_Inventory::create([
                    'qb_id'        => $current_id,
                    'style'     => $style,
                    'color'     => $color,
                    'size'      => $size,
                    'upc'       => $upc
                ]);
            }  

            // $request will contain flag of closing invoices
            if (isset($request->close_invoice)) {
                $invoice_ids = array_unique($items->fetch('inventory_prep.invoice.id')->toArray());
                 App\Invoice::whereIn('id', $invoice_ids)->update(['open' => false]);
            }

            $filename = 'QB_Inventory_Import_'.date('Y_F_d_\THi');//.str_replace(' ', '_', date("r"));
            Excel::create($filename, function($excel) use($table) {
                $excel->sheet('Sheetname', function($sheet) use($table) {
                    $sheet->fromArray($table);
                });
            })->store('xls')->export('xls');

            $reorders = App\Temporary_Staging::reorders();
            return view('export.reorder', ['reorders' => $reorders]);
        });
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

    /**
     * Populates Staging table
     *
     */
    protected function populateStagingTable()
    {
        // Make sure staging table is clear
        //App\Temporary_Staging::truncate(); // does not work with transaction()
        DB::table('temporary_stagings')->truncate();

        // Retrive items ready to export
        $items = App\Inventory_Prep::readyForStaging()->get();

        // Loop through items and expand sizes requested into staging table
        foreach ($items as $item) {
            // retrive non zero colums
            $matrix = App\Size_Matrix::nonZeroColumns($item->size_matrix_id);

            // Enter each returned size into staging table
            foreach ($matrix as $size => $quantity) {
                // Check for duplicates in staging
                $duplicate_staging_item = App\Temporary_Staging::whereHas('inventory_prep', function ($query) use ($item) {
                    $query->where('style', $item->style)
                          ->where('color', $item->color);
                })->where('size', $size);

                if ($duplicate_staging_item->exists()) {
                    // seleet the other matching item
                    $staging_item = $duplicate_staging_item->firstOrFail();

                    // Compare other attributes to see if it really is the same item or just has the exact same name
                    /*
                    Cost
                    Department
                    Category
                    brand
                    online color
                    vendor
                    */
                    $header = 'Found duplicate item. Style: <strong>'.$item->style
                        .'</strong> Color: <strong>'.$item->color
                        .'</strong> Size: <strong>'.$size
                        .'</strong> on invoices: <strong>'.$item->invoice->invoice_number
                        .'</strong> and <strong>'.$staging_item->inventory_prep->invoice->invoice_number.'</strong>, BUT the ';
                    if ($staging_item->inventory_prep->cost != $item->cost) {
                        $message = $header.'<strong>Cost</strong> in the items do not match.  Please double check that all information for both items is correct.';
                        throw new InconsistentAttributeException($message);
                    }
                    if ($staging_item->inventory_prep->department_id != $item->department_id) {
                        $message = $header.'<strong>Department</strong> in the items do not match.  Please double check that all information for both items is correct.';
                        throw new InconsistentAttributeException($message);
                    }
                    if ($staging_item->inventory_prep->detail->category_id != $item->detail->category_id) {
                        $message = $header.'<strong>Category</strong> in the items do not match.  Please double check that all information for both items is correct.';
                        throw new InconsistentAttributeException($message);
                    }
                    if ($staging_item->inventory_prep->detail->brand != $item->detail->brand) {
                        $message = $header.'<strong>Brand</strong> in the items do not match.  Please double check that all information for both items is correct.';
                        throw new InconsistentAttributeException($message);
                    }
                    if ($staging_item->inventory_prep->detail->online_color_id != $item->detail->online_color_id) {
                        $message = $header.'<strong>Online Color</strong> in the items do not match.  Please double check that all information for both items is correct.';
                        throw new InconsistentAttributeException($message);
                    }
                    if ($staging_item->inventory_prep->invoice->vendor_id != $item->invoice->vendor_id) {
                        $message = $header.'<strong>Vendor</strong> in the items do not match.  Please double check that all information for both items is correct.';
                        throw new InconsistentAttributeException($message);
                    }
                    
                    // update
                    $staging_item->store_1           += ( $item->quantity->store_1 * $quantity );
                    $staging_item->store_2           += ( $item->quantity->store_2 * $quantity );
                    $staging_item->store_3           += ( $item->quantity->store_3 * $quantity );
                    $staging_item->store_4           += ( $item->quantity->store_4 * $quantity );

                    $staging_item->save();

                } else {
                    // Reorder and price_rule check only has to be done onece, so dont need to querry for every duplicate found
                    $matching_price_rule = App\Price_Rule::matchPriceRule($item);
                    if ($matching_price_rule->exists()) {
                        $price_rule = $matching_price_rule->first()->id;
                    } else {
                        $price_rule = '';
                    }
                    
                    $reorder = App\QB_Inventory::where('style', $item->style)
                                               ->where('color', $item->color)
                                               ->where('size', $size);
                    $reorder_check = ($reorder->exists()) ? true : false ;

                    $staging_item = new App\Temporary_Staging;

                    $staging_item->inventory_prep_id = $item->id;
                    $staging_item->size              = $size;
                    $staging_item->price_rule_id     = $price_rule;
                    $staging_item->reorder           = $reorder_check;
                    $staging_item->store_1           = ( $item->quantity->store_1 * $quantity );
                    $staging_item->store_2           = ( $item->quantity->store_2 * $quantity );
                    $staging_item->store_3           = ( $item->quantity->store_3 * $quantity );
                    $staging_item->store_4           = ( $item->quantity->store_4 * $quantity );

                    $staging_item->save();
                }
            }
        }
    }
}
