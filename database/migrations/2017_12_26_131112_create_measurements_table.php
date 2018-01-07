<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('max');
            $table->float('mean');
            $table->integer('county_code');
            $table->string('county');
            $table->dateTime('date');
            $table->integer('state_id')->unsigned()->default(0);
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('pollution_id')->unsigned();
            $table->foreign('pollution_id')->references('id')->on('pollutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurements');
    }
}
