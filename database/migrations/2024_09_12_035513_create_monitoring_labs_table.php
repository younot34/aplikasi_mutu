<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_labs', function (Blueprint $table) {
            $table->id();
            $table->string('variabel');
            $table->string('sub_variabel_1');
            $table->string('sub_variabel_2');
            $table->integer('total_1');
            $table->integer('total_2');
            $table->integer('hasil');
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
        Schema::dropIfExists('monitoring_labs');
    }
}
