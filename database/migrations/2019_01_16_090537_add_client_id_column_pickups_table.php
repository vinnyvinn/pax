<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientIdColumnPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dbo.pickups', function (Blueprint $table) {
            //
            $table->integer('client_id')->unsigned()->nullable();
            $table->dropColumn('bill_account');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dbo.pickups', function (Blueprint $table) {
            //
        });
    }
}
