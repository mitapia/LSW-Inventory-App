<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DCVM2mRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_price_rule', function (Blueprint $table) {
            $table->integer('department_id');
            $table->integer('price_rule_id');
            $table->timestamps();
        });

        Schema::create('category_price_rule', function (Blueprint $table) {
            $table->integer('category_id');
            $table->integer('price_rule_id');
            $table->timestamps();
        });

        Schema::create('price_rule_vendor', function (Blueprint $table) {
            $table->integer('vendor_id');
            $table->integer('price_rule_id');
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
        Schema::drop('department_price_rule');
        Schema::drop('category_price_rule');
        Schema::drop('price_rule_vendor');
    }
}
