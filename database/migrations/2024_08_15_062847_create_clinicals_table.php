<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinicals', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm');
            $table->string('nama_px');
            $table->string('ca_cervik')->nullable();
            $table->string('tb')->nullable();
            $table->string('ht')->nullable();
            $table->string('hiv')->nullable();
            $table->string('dm')->nullable();
            $table->date('masuk');
            $table->date('keluar');
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
        Schema::dropIfExists('clinicals');
    }
}
