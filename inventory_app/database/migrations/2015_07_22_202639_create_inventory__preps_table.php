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
        Schema::create('inventory_prep', function (Blueprint $table) {
            $table->increments('id');
            $table->string('style', 31);
            $table->decimal('cost', 13, 2);
            $table->string('color', 12);
            $table->integer('department_id');
            $table->integer('category_id');
            $table->integer('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
            $table->integer('size_matrix_id');
            $table->foreign('size_matrix_id')->references('id')->on('size_matrix')->onDelete('cascade');
            $table->boolean('detail_set')->default(0);
            $table->boolean('quantity_set')->default(0);
            $table->boolean('delivered')->default(0);
            $table->boolean('reorder')->default(0);
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
        Schema::drop('inventory_prep');
    }
}
