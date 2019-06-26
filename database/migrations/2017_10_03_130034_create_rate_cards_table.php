<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.rate_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('packaging_type');
            $table->double('weight');
            $table->double('zone_a');
            $table->double('zone_b');
            $table->double('zone_c');
            $table->double('zone_d');
            $table->double('zone_e');
            $table->double('zone_f');
            $table->double('zone_g');
            $table->double('zone_h');
            $table->double('zone_i');
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
        Schema::dropIfExists('rate_cards');
    }
}
