<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PAX\Models\NonFedexWaybill;

class CreateNonFedexWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.non_fedex_waybills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('manifest_id')->nullable();
            $table->integer('city_id')->index()->unsigne()->nullable();
            $table->integer('area_code_id')->index()->unsigne()->nullable();
            $table->integer('route_id')->index()->unsigne()->nullable();
            $table->integer('courier_id')->index()->unsigne()->nullable();
            $table->bigInteger('project_id')->nullable();
            $table->string('category')->default(NonFedexWaybill::CATEGORY_INBOUND);
            $table->integer('type')->default(NonFedexWaybill::NON_DUTIABLE);
            $table->string('package_type')->nullable();
            $table->boolean('clearance_billed')->default(false);
            $table->boolean('freight_billed')->default(false);
            $table->date('shipped_date')->nullable();
            $table->string('waybill_number')->nullable();
            $table->string('crn_number')->nullable();
            $table->string('origin');
            $table->string('destination');
            $table->string('export_city');
            $table->string('con_phone')->nullable();
            $table->string('con_company')->nullable();
            $table->string('con_name')->nullable();
            $table->string('con_address')->nullable();
            $table->string('con_address_alternate')->nullable();
            $table->string('con_city')->nullable();
            $table->string('con_state')->nullable();
            $table->string('con_country')->nullable();
            $table->string('con_postal')->nullable();


            $table->string('shipper_phone')->nullable();
            $table->string('shipper_company')->nullable();
            $table->string('shipper_name')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('shipper_address_alternate')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_state')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('shipper_postal')->nullable();

            $table->string('bill_to', 1)->nullable();
            $table->string('bill_duty', 1)->nullable();
            $table->integer('total')->nullable();
            $table->string('weight')->nullable();
            $table->double('actual_weight')->nullable();
            $table->string('currency', 3)->nullable();
            $table->float('value')->nullable()->default(0);
            $table->float('conversion_rate')->nullable();
            $table->float('usd_value')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('current_status')->default(0);

            $table->string('clearing_agent')->default(NonFedexWaybill::CA_PAX);
            $table->string('clearing_agent_name')->default(NonFedexWaybill::CA_PAX);
            $table->boolean('clearing_agent_assigned')->default(false);

            $table->timestamp('initial_billing_time')->nullable();
            $table->boolean('overage')->default(false);

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
        Schema::dropIfExists('non_fedex_waybills');
    }
}
