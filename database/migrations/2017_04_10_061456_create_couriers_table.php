<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.couriers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('national_id');
            $table->string('fedex_id');
            $table->string('phone');
            $table->integer('route_id')->unsigned()->index()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couriers');
    }
}
