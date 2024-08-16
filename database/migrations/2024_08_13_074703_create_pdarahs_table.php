<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdarahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdarahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ri_id');
            $table->string('benar_namad');
            $table->string('benar_alamatd');
            $table->timestamps();

            $table->foreign('ri_id')->references('id')->on('ris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdarahs');
    }
}
