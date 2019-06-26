<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbo.routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('area_code_id')->unsigned()->index();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('area_code_id')
                ->references('id')
                ->on('area_codes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
