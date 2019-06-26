<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PAX\Models\Quote;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('waybill_id')->nullable();
            $table->integer('client_id');
            $table->string('category')->default(Quote::CATEGORY_INBOUND);
            $table->text('proforma_data')->nullable();
            $table->text('invoice_data')->nullable();

            $table->float('break_bulk_fee')->default(0);
            $table->float('storage_fee')->default(0);
            $table->float('storage_time')->default(0);
            $table->float('fob')->default(0);
            $table->float('conversion_rate')->default(1);
            $table->float('local_amount')->default(0);

            $table->float('freight')->default(0);
            $table->float('other_charges')->default(0);
            $table->float('insurance_rate')->default(0);
            $table->float('insurance')->default(0);
            $table->float('cif')->default(0);

            $table->float('duty_rate')->default(0);
            $table->float('duty_amount')->default(0);

            $table->float('vat_rate')->default(0);
            $table->float('vat_amount')->default(0);

            $table->float('idf')->default(0);
            $table->float('rdl')->default(0);
            $table->float('kaa')->default(0);
            $table->float('kebs')->default(0);
            $table->float('gok')->default(0);
            $table->float('agency_fees')->default(0);

            $table->float('proforma_total')->default(0);
            $table->float('invoice_total')->default(0);
            $table->float('variance')->default(0);

            $table->string('package_type')->nullable();
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

            $table->integer('total')->nullable();
            $table->string('weight')->nullable();
            $table->double('actual_weight')->nullable();
            $table->string('currency', 3)->nullable();
            $table->float('value')->nullable()->default(0);
            $table->float('usd_value')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
