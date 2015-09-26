<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_rule', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('minimum_cost', 13, 2);
            $table->decimal('maximum_cost', 13, 2);

            $table->string('item_description',  31);
            $table->decimal('regular_price', 13, 2);
            $table->decimal('custom_price_1', 13, 2);
            $table->decimal('custom_price_2', 13, 2);
            $table->decimal('custom_price_3', 13, 2);
            $table->decimal('custom_price_4', 13, 2);
            $table->boolean('rewards')->default(1);

            $table->tinyInteger('priority');
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
        Schema::drop('price_rule');
    }
}
