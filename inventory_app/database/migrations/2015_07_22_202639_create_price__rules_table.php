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
