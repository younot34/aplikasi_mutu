<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ppi_id');
            $table->string('profesi')->nullable();
            $table->integer('jumlah')->nullable();
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
        Schema::dropIfExists('profesis');
    }
}
