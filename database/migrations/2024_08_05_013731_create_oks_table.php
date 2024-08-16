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
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_pelaksanaan');
            $table->string('waktu_pending')->nullable();
            $table->string('alasan')->nullable();
            $table->string('nama_dokter');
            $table->string('nama_pasien');
            $table->integer('no_rm');
            $table->string('diagnosa');
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
