<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apds', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('unit');
            $table->string('nama_petugas')->nullable();
            $table->string('profesi')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('topi')->nullable();
            $table->string('kacamata')->nullable();
            $table->string('masker')->nullable();
            $table->string('gown')->nullable();
            $table->string('sarung_tangan')->nullable();
            $table->string('sepatu')->nullable();
            $table->string('ya')->nullable();
            $table->string('tidak')->nullable();
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
        Schema::dropIfExists('apds');
    }
}
