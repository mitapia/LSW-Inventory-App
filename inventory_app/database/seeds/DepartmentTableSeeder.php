<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$departments = array(
			'Men',
			'Women',
			'Girls',
			'Boys',
			'Accessories'
		);

		foreach($departments as $dep) {
		    $department = Department::create(array('name' => $dep ));
		}        
    }
}


