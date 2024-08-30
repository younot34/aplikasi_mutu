<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJatuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jatuhs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_rm');
            $table->string('nama_px');
            $table->string('rendah')->nullable();
            $table->string('tinggi')->nullable();
            $table->string('kancing')->nullable();
            $table->string('segitiga')->nullable();
            $table->string('handreal')->nullable();
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
        Schema::dropIfExists('jatuhs');
    }
}
