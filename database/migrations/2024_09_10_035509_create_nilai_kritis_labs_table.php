<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiKritisLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_kritis_labs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('unit_asal')->nullable();
            $table->string('dokter_pengirim')->nullable();
            $table->string('jenis_pelayanan')->nullable();
            $table->time('waktu_sampling')->nullable();
            $table->time('waktu_selsai')->nullable();
            $table->time('waktu_diterima')->nullable();
            $table->string('selisih_waktu')->nullable();
            $table->string('hasil_pemeriksaan_nilai_kritis')->nullable();
            $table->string('pemberi_informasi')->nullable();
            $table->string('penerima_informasi')->nullable();
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
        Schema::dropIfExists('nilai_kritis_labs');
    }
}
