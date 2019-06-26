<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountRateCardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.discount_rate_card_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_rate_card_id')->unsigned();
            $table->string('package_type', 120)->nullable();
            $table->string('weight', 11)->default(0.0000);
            $table->string('a', 20)->nullable();
            $table->string('b', 20)->nullable();
            $table->string('c', 20)->nullable();
            $table->string('d', 20)->nullable();
            $table->string('e', 20)->nullable();
            $table->string('f', 20)->nullable();
            $table->string('g', 20)->nullable();
            $table->string('h', 20)->nullable();
            $table->string('i', 20)->nullable();
            $table->string('j', 20)->nullable();
            $table->string('k', 20)->nullable();
            $table->string('l', 20)->nullable();
            $table->string('m', 20)->nullable();
            $table->string('n', 20)->nullable();
            $table->string('o', 20)->nullable();
            $table->string('p', 20)->nullable();
            $table->string('q', 20)->nullable();
            $table->string('r', 20)->nullable();
            $table->string('s', 20)->nullable();
            $table->string('t', 20)->nullable();
            $table->string('u', 20)->nullable();
            $table->string('v', 20)->nullable();
            $table->string('w', 20)->nullable();
            $table->string('x', 20)->nullable();
            $table->string('y', 20)->nullable();
            $table->string('z', 20)->nullable();
            $table->foreign('discount_rate_card_id')->references('id')->on('discount_rate_cards')->onDelete('cascade');
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
        Schema::dropIfExists('discount_rate_card_items');
    }
}
