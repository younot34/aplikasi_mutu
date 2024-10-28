<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal')->nullable();
            $table->string('no_ro')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('ruangan')->nullable();
            $table->integer('umur')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->string('dokter_pengirim')->nullable();
            $table->string('jenis_pemeriksaan')->nullable();
            $table->string('petugas')->nullable();
            $table->string('kvmas')->nullable();
            $table->time('mulai')->nullable();
            $table->time('selesai')->nullable();
            $table->string('tarif')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('radios');
    }
}
