<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ews', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_rm');
            $table->string('nama_pasien');
            $table->string('terisi')->nullable();
            $table->string('tidak_terisi')->nullable();
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
        Schema::dropIfExists('ews');
    }
}
