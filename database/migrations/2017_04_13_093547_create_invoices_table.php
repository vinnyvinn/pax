<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PAX\Models\Invoice;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('waybill_id')->unsigned()->index();
            $table->bigInteger('invoice_id')->nullable();
            $table->integer('client_id');
            $table->string('external_invoice')->nullable();
            $table->string('type')->default(Invoice::PROFORMA);
            $table->string('category')->default(Invoice::CATEGORY_INBOUND);
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
        Schema::dropIfExists('invoices');
    }
}
