<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Idotanggal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idotanggals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ido_id');
            $table->date('tanggal');
            $table->string('data_pertanggal_1');
            $table->string('data_pertanggal_2');
            $table->timestamps();

            $table->foreign('ido_id')->references('id')->on('idos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idotanggals');
    }
}
