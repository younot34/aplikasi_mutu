<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpjpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpjps', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_rm');
            $table->string('nama_pasien');
            $table->string('terverifikasi')->nullable();
            $table->string('tidak_terverifikasi')->nullable();
            $table->string('dpjp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dpjps');
    }
}
