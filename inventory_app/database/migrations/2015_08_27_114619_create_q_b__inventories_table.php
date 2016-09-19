<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQBInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qb_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qb_id')->unsigned();
            $table->string('style', 31);
            $table->string('color', 12);
            $table->string('size', 12);
            $table->integer('vendor_id');
            $table->char('upc', 13);
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
        Schema::drop('qb_inventory');
    }
}
