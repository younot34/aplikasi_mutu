<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlebititanggalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plebititanggals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plebiti_id');
            $table->date('tanggal');
            $table->string('data_pertanggal_1');
            $table->string('data_pertanggal_2');
            $table->timestamps();

            $table->foreign('plebiti_id')->references('id')->on('plebitis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plebititanggals');
    }
}
