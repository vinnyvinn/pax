<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('import_duty')->index()->unsigned();
            $table->integer('agency_fee')->index()->unsigned();
            $table->integer('outbound_freight')->index()->unsigned();
            $table->integer('break_bulk')->index()->unsigned();
            $table->integer('storage_fee')->index()->unsigned();
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
        Schema::dropIfExists('cities');
    }
}
