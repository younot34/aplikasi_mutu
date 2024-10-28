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
            $table->string('no_rm')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->integer('umur')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tindakan_operasi')->nullable();
            $table->string('dokter_op')->nullable();
            $table->string('dokter_anest')->nullable();
            $table->string('jenis_op')->nullable();
            $table->string('asuransi')->nullable();
            $table->datetime('rencana_tindakan')->nullable();
            $table->datetime('signin')->nullable();
            $table->datetime('time_out')->nullable();
            $table->datetime('sign_out')->nullable();
            $table->string('penandaan_lokasi_op')->nullable();
            $table->string('kelengkapan_ssc')->nullable();
            $table->string('penundaan_op_elektif')->nullable();
            $table->string('penundaan_op_elektif1')->nullable();
            $table->string('sc_emergensi1')->nullable();
            $table->string('sc_emergensi')->nullable();
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
