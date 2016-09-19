<?php

use Illuminate\Database\Seeder;

class SampleInvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Size matices required for the folowing batch of invoces
        $matrix = new App\Size_Matrix;

        $matrix->name       = 'A1';
        $matrix->vendor_id  = '09';
        for ($i=1; $i <= 2; $i++) { 
	        $matrix->{$i.'_K'}		= '1';        	
        }

        $matrix->save();

        $matrix = new App\Size_Matrix;

        $matrix->name       = 'A2';
        $matrix->vendor_id  = '09';
        for ($i=2; $i <= 3; $i++) { 
	        $matrix->{$i.'_K'}		= '2';        	
        }

        $matrix->save();

        // dumy data to create invoce
    	$sample_invoices = array(
    		array(
	    		'invoice_number' => '1000010298', 
	    		'page_number'	 => '1',
	    		'page_total'	 => '1',
	    		'notes'			 => 'first test invoice',
	    		'vendor'		 => '09', 	// Elim Shoes
	    		'items'			 => array(
	    			array(
		    			'style'			=>	'anna-0',
		    			'cost'			=>	'3',
		    			'color'			=>	'black',
		    			'department'	=>	'Women',
		    			'size'			=>	'A1',
	    			),
	    			array(
		    			'style'			=>	'anna-0',
		    			'cost'			=>	'3.5',
		    			'color'			=>	'white',
		    			'department'	=>	'Women',
		    			'size'			=>	'A1',
	    			),
	    			array(
		    			'style'			=>	'0093763',
		    			'cost'			=>	'7',
		    			'color'			=>	'black',
		    			'department'	=>	'Men',
		    			'size'			=>	'A2',
	    			))
    			),
    		array(
	    		'invoice_number' => '1000010JBD', 
	    		'page_number'	 => '1',
	    		'page_total'	 => '2',
	    		'notes'			 => 'anoher invoice',
	    		'vendor'		 => '09', 	// Elim Shoes
	    		'items'			 => array(
	    			array(
		    			'style'			=>	'style-00',
		    			'cost'			=>	'11',
		    			'color'			=>	'black',
		    			'department'	=>	'Boys',
		    			'size'			=>	'A1',
	    			),
	    			array(
		    			'style'			=>	'color-8',
		    			'cost'			=>	'2',
		    			'color'			=>	'silver',
		    			'department'	=>	'Boys',
		    			'size'			=>	'A1',
	    			),
	    			array(
		    			'style'			=>	'color-8',
		    			'cost'			=>	'2',
		    			'color'			=>	'green',
		    			'department'	=>	'Boys',
		    			'size'			=>	'A2',
	    			),
	    			array(
		    			'style'			=>	'6738899',
		    			'cost'			=>	'1',
		    			'color'			=>	'orange',
		    			'department'	=>	'Girls',
		    			'size'			=>	'A2',
	    			))
    			),
    		array(
	    		'invoice_number' => '1000010JBD-2', 
	    		'page_number'	 => '2',
	    		'page_total'	 => '2',
	    		'notes'			 => 'second page invoice',
	    		'vendor'		 => '09', 	// Elim Shoes
	    		'items'			 =>  array(
	    			array(
		    			'style'			=>	'anna-0',
		    			'cost'			=>	'3',
		    			'color'			=>	'black',
		    			'department'	=>	'Women',
		    			'size'			=>	'A2',
	    			),
	    			array(
		    			'style'			=>	'anna-1',
		    			'cost'			=>	'3',
		    			'color'			=>	'black',
		    			'department'	=>	'Women',
		    			'size'			=>	'A2',
	    			))
    			)
    		);

    	// create invoces using dumy data
    	foreach ($sample_invoices as $data) {
	        $invoice = new App\Invoice;

	        $invoice->invoice_number  = $data['invoice_number'];
	        $invoice->page_number     = $data['page_number'];
	        $invoice->total_pages     = $data['page_total'];
	        $invoice->notes           = $data['notes'];

	        $invoice->created_by      = 'testing';
	        $invoice->vendor_id       = $data['vendor'];

	        $invoice->save();  

	        foreach ($data['items'] as $item) {
	            $style  = $item['style'];
	            $cost = $item['cost'];
	            $color  = $item['color'];
	            
	            $department_id  = App\Department::where('name', $item['department'])->firstOrFail()->id;
	            $size_matrix_id = App\Size_Matrix::where('name', $item['size'])->firstOrFail()->id;

	            $inventory = new App\Inventory_Prep;

	            $inventory->style       = $style;
	            $inventory->cost        = $cost;
	            $inventory->color       = $color;
	            $inventory->department_id   = $department_id;
	            $inventory->invoice_id      = $invoice->id;
	            $inventory->size_matrix_id  = $size_matrix_id;

	            $inventory->save();  	        	
	        }
    	}
    }
}
