<?php

use Illuminate\Database\Seeder;
use App\Vendor;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendors = array(
			"05"	=>	"CPC Ardor",
			"06"	=>	"Donis Dynasty",
			"08"	=>	"Eagle Shoes",
			"09"	=>	"Elim Shoes",
			"10"	=>	"Forever Link",
			"12"	=>	"Hot Air Inc",
			"13"	=>	"Happy New Star",
			"19"	=>	"Melrose",
			"20"	=>	"I Heart Footwear",
			"21"	=>	"Marilyn Moda",
			"22"	=>	"X-Power / Nuera Group",
			"25"	=>	"Ositos Shoes",
			"26"	=>	"People's Shoe",
			"28"	=>	"Red Circle",
			"29"	=>	"Rockland Footwear",
			"30"	=>	"DND Fashion",
			"31"	=>	"High Output / Shenzhen",
			"32"	=>	"Saul Caudillo",
			"33"	=>	"Shoe Dynasty",
			"34"	=>	"Springland Footwear",
			"35"	=>	"Sunny AIT",
			"37"	=>	"Syke Footwear",
			"38"	=>	"Sup Trading / Smart Easy",
			"40"	=>	"Top Link / Universal Link",
			"41"	=>	"Twin Tiger",
			"95"	=>	"Neway Shoes",
			"98"	=>	"Amiga Shoes Factory",
			"92"	=>	"K-Swiss",
			"93"	=>	"Elegant Footwear",
			"11"	=>	"Golden Asia Footwear",
			"99"	=>	"Golden West Footwear",
			"89"	=>	"Milan Import",
			"88"	=>	"Shine Max",
			"87"	=>	"JP Original",
			"96"	=>	"Formosa Fashion",
			"86"	=>	"ChinAmerica",
			"85"	=>	"Makers Shoes",
			"83"	=>	"Mythology Trading",
			"82"	=>	"Machi Footwear",
			"44"	=>	"Bella Shoes",
			"45"	=>	"Lasonia Shoes",
			"23"	=>	"Oceanlink",
			"81"	=>	"Reyme"
        );

        foreach ($vendors as $id => $ven) {
        	$vendor = Vendor::create(array(
        		'id' 	=> $id, 
        		'name' 	=> $ven 
        	));
        }
    }
}
