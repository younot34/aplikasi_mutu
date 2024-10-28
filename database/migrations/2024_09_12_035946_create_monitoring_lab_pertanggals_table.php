<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringLabPertanggalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_lab_pertanggals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monitoring_lab_id');
            $table->date('tanggal');
            $table->string('data_pertanggal_1');
            $table->string('data_pertanggal_2');
            $table->string('data_pertanggal_3');
            $table->string('data_pertanggal_4');
            $table->string('data_pertanggal_5');
            $table->string('data_pertanggal_6');
            $table->timestamps();

            $table->foreign('monitoring_lab_id')->references('id')->on('monitoring_labs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring_lab_pertanggals');
    }
}
