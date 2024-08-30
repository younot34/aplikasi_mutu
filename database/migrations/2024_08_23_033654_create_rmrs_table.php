<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rmrs', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal')->nullable();
            $table->integer('no')->nullable();
            $table->integer('no_rm')->nullable();
            $table->string('asesmen')->nullable();
            $table->string('cppt')->nullable();
            $table->string('resep')->nullable();
            $table->string('resume')->nullable();
            $table->string('lengkap')->nullable();
            $table->string('tidak')->nullable();
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
        Schema::dropIfExists('rmrs');
    }
}
