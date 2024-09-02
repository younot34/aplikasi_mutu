<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rmris', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('resume_ada')->nullable();
            $table->string('resume_tidakAda')->nullable();
            $table->string('resume_lengkap')->nullable();
            $table->string('resume_tidak')->nullable();
            $table->string('pengantar_ada')->nullable();
            $table->string('pengantar_tidakAda')->nullable();
            $table->string('pengantar_lengkap')->nullable();
            $table->string('pengantar_tidak')->nullable();
            $table->string('cppt_ada')->nullable();
            $table->string('cppt_tidakAda')->nullable();
            $table->string('cppt_lengkap')->nullable();
            $table->string('cppt_tidak')->nullable();
            $table->string('general_ada')->nullable();
            $table->string('general_tidakAda')->nullable();
            $table->string('general_lengkap')->nullable();
            $table->string('general_tidak')->nullable();
            $table->string('informed_ada')->nullable();
            $table->string('informed_tidakAda')->nullable();
            $table->string('informed_lengkap')->nullable();
            $table->string('informed_tidak')->nullable();
            $table->string('keterangan_lengkap')->nullable();
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
        Schema::dropIfExists('rmris');
    }
}
