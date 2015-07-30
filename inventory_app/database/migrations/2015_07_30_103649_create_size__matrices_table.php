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
            for ($i=0; $i <= 16; $i += 0.5) { 
                // Having problems with '.' replacing for underscore to let migration finish
                $name = str_replace('.', '_', strval($i));
                $table->tinyInteger($name);
            };
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
