<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryPrepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory__prep', function (Blueprint $table) {
            $table->increments('id');
            $table->string('style', 31);
            $table->decimal('cost', 13, 2);
            $table->string('notes', 150);
            $table->integer('department_id');
            $table->integer('category_id');
            $table->integer('invoice_id');
            $table->integer('invoice_vendor_id');   // not sure if this is neccesary
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
        Schema::drop('inventory__prep');
    }
}
