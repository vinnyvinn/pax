<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('dbo.Client', 'FedexId')) {
            
        } else {
            Schema::table('dbo.Client', function (Blueprint $table) {
                //
                $table->string('FedexId', 100)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('dbo.Client', function (Blueprint $table) {
            //
                $table->dropColumn('FedexId');
            });
    }
}
