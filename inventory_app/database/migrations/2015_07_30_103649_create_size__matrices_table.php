<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_matrix', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->tinyInteger('vendor_id')->unsigned();
            for ($i=0; $i <= 13; $i++) { 
                $table->tinyInteger($i.'_K')->default(0)->unsigned();
            }
            for ($i=0; $i <= 14; $i += 0.5) { 
                // Having problems with '.' replacing for underscore to let migration finish
                // Also having problems accessing colums when assessing lone digits, a mysql limitation
                $name = str_replace('.', '_', strval($i)) . '_A';
                $table->tinyInteger($name)->default(0)->unsigned();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('size_matrix');
    }
}
