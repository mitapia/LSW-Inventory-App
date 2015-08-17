<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Populate tables with inital entries
        $this->call(DepartmentTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(VendorTableSeeder::class);
        $this->call(OnlineColorTableSeeder::class);
        $this->call(SizeMatrixTableSeeder::class);

        Model::reguard();
    }
}
