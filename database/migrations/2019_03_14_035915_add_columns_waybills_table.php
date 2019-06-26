<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsWaybillsTable extends Migration
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
            $table->date('pod_date')->nullable();
            $table->string('pod_time')->nullable();
            $table->string('pod_name')->nullable();
            $table->boolean('pod_set')->default(false);
            $table->string('fedex_client_account')->nullable();
            $table->string('dims')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dbo.waybills', function (Blueprint $table) {
            //
        });
    }
}
