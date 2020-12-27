<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdVentaToCelularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('celulares', function (Blueprint $table) {
            $table->bigInteger('venta_id')->unsigned()->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('celulares', function (Blueprint $table) {
            //
        });
    }
}
