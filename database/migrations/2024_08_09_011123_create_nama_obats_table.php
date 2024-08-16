<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamaObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nama_obats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farmasi_id');
            $table->integer('r');
            $table->string('nama_obat');
            $table->timestamps();

            $table->foreign('farmasi_id')->references('id')->on('farmasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nama_obats');
    }
}
