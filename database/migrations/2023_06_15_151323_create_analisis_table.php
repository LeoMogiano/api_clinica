<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('motivo');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('emergencia_id');
            $table->foreign('emergencia_id')->on('emergencias')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('analisis');
    }
}
