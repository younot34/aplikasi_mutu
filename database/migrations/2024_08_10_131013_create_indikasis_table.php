<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ppi_id');
            $table->integer('opp')->nullable();
            $table->integer('indikasi')->nullable();
            $table->string('cuci_tangan') ->nullable();
            $table->timestamps();

            $table->foreign('ppi_id')->references('id')->on('ppis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indikasis');
    }
}
