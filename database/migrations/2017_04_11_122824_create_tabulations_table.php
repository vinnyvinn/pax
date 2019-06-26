<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.tabulations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('freight');
            $table->string('exchange_rate');
            $table->string('import_duty_rate');
            $table->string('vat_rate');
            $table->string('kebs_amount');
            $table->string('other_charges');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('tabulations');
    }
}
