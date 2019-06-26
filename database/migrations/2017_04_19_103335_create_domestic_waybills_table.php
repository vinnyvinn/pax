<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PAX\Models\DomesticWaybill;

class CreateDomesticWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.domestic_waybills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->bigInteger('project_id')->nullable();
            $table->string('status')->default(DomesticWaybill::STATUS_RAW);
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->integer('total_package')->default(1);
            $table->integer('weight')->default(0);
            $table->string('packaging');
            $table->string('shipment_description');
            $table->string('shipment_value');

            $table->string('con_phone')->nullable();
            $table->string('con_company')->nullable();
            $table->string('con_name')->nullable();
            $table->string('con_address')->nullable();
            $table->string('con_address_alternate')->nullable();
            $table->string('con_city')->nullable();
            $table->string('con_country')->nullable();

            $table->string('shipper_phone')->nullable();
            $table->string('shipper_company')->nullable();
            $table->string('shipper_name')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('shipper_address_alternate')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('bill_duty')->nullable();
            $table->string('bill_to')->nullable();
            $table->string('special_handling')->nullable();
            $table->string('internal_billing_reference')->nullable();
            $table->double('length')->default(0);
            $table->double('width')->default(0);
            $table->double('height')->default(0);
            $table->double('dim')->default(0);
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
        Schema::dropIfExists('domestic_waybills');
    }
}
