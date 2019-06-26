<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddBrokerDetailsWaybill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dbo.waybills', function (Blueprint $table) {
            //
            $table->string('broker_name', 80)->nullable();
            $table->string('broker_phone', 20)->nullable();
            $table->string('broker_city', 50)->nullable();
            $table->string('broker_country', 50)->nullable();
            $table->string('broker_customs_id', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('waybills', function (Blueprint $table) {
            //
        });
    }
}
