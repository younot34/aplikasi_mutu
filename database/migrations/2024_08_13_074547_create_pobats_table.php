<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePobatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pobats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ri_id');
            $table->string('benar_namao');
            $table->string('benar_alamato');
            $table->timestamps();

            $table->foreign('ri_id')->references('id')->on('ris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pobats');
    }
}
