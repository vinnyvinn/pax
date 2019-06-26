<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PAX\Models\Pickup;

class CreatePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.pickups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('courier_id')->nullable();
            $table->string('pickup_no');
            $table->date('pickup_date')->nullable();
            $table->string('ready_time')->nullable();
            $table->string('close_time')->nullable();
            $table->string('no_packages');
            $table->string('expected_weight')->nullable();
            $table->integer('weight_unit')->nullable();
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->string('address')->nullable();
            $table->boolean('cash_collect')->default(0);
            $table->integer('shipping')->nullable();
            $table->integer('status')->default(Pickup::STATUS_pending);
            //customer details
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('company_name')->nullable();
            $table->string('bill_account')->nullable();
            $table->integer('bill_company');

            $table->boolean('recurrent')->default(0);
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
        Schema::dropIfExists('pickups');
    }
}
