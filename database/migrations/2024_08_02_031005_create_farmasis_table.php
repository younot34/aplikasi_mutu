<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmasis', function (Blueprint $table) {
            $table->id();
            $table->date('waktu');
            $table->string('nama_px');
            $table->integer('r');
            $table->string('nama_obat');
            $table->integer('total_obat_fornas');
            $table->integer('total_item');
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
        Schema::dropIfExists('farmasis');
    }
}
