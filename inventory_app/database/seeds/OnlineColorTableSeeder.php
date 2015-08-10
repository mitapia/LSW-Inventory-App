<?php

use Illuminate\Database\Seeder;

class OnlineColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$colors = array(
			'Beige',
			'Black',
			'Blue',
			'Brown',
			'Gold',
			'Green',
			'Gray',
			'Multicolor',
			'Orange',
			'Pink',
			'Purple',
			'Red',
			'Silver',
			'White',
			'Yellow'
		);

		foreach($colors as $color) {
		    $online_color = Online_Color::create(array('name' => $color ));
		}  
    }
}
