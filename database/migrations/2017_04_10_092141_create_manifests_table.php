<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PAX\Models\Manifest;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.manifests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('city_id')->index()->unsigned()->nullable();
            $table->integer('cbv_id')->nullable();
            $table->string('flight_number');
            $table->date('flight_date');
            $table->time('arrival_time')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->string('type')->default(Manifest::INBOUND);
            $table->boolean('is_open')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('manifests');
    }
}
