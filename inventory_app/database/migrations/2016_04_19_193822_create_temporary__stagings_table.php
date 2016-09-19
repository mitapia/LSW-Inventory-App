<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryStagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_stagings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_prep_id');
            $table->string('size', 12);
            $table->integer('price_rule_id');
            $table->boolean('reorder');
            for ($i=1; $i <= 4; $i++) { 
                $table->tinyInteger('store_'.$i)->default(0)->unsigned();
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
        Schema::drop('temporary_stagings');
    }
}
