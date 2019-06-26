<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInCbvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.in_cbvs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('manifest_id')->index()->unsigned();
            $table->date('cbv_date')->nullable();
            $table->string('cbv_number')->nullable();
            $table->double('cbv_rate')->nullable();
            $table->double('consignment_weight')->nullable();
            $table->string('handlers')->nullable();
            $table->text('invoices')->nullable();
            $table->timestamps();

            $table->foreign('manifest_id')->references('id')->on('manifests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_cbvs');
    }
}
