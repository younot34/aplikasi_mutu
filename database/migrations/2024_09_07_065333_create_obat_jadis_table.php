<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatJadisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_jadis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->time('resep_masuk')->nullable();
            $table->time('resep_diserahkan')->nullable();
            $table->string('waktu_pelayanan')->nullable();
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
        Schema::dropIfExists('obat_jadis');
    }
}
