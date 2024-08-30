<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oks', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal')->nullable();
            $table->string('no_rm');
            $table->string('nama_pasien');
            $table->integer('umur');
            $table->string('diagnosa');
            $table->string('tindakan_operasi');
            $table->string('dokter_op');
            $table->string('dokter_anest');
            $table->string('jenis_op');
            $table->string('asuransi');
            $table->datetime('rencana_tindakan');
            $table->datetime('signin');
            $table->datetime('time_out');
            $table->datetime('sign_out');
            $table->string('penandaan_lokasi_op');
            $table->string('kelengkapan_ssc');
            $table->string('penundaan_op_elektif');
            $table->string('sc_emergensi');
            $table->string('keterangan')->nullable();
            $table->string('kendala')->nullable();
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
        Schema::table('oks', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });
    }
}
