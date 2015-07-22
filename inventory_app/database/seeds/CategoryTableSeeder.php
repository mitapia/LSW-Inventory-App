<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = array(
			'Sandals',
			'Pumps',
			'Flats',
			'Wedges and Platforms',
			'Boots',
			'Sneakers',
			'Heels',
			'Clogs & Mules',
			'Booties',
			'Dress Shoes',
			'Slippers',
			'Accessories',
			'Mix'
		);

		foreach($categories as $cat) {
		    $category = Category::create(array('name' => $cat));
		}   
    }
}
