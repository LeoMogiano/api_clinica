<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencias', function (Blueprint $table) {
            $table->id();
            //inicial
            $table->string('motivo')->nullable();
            $table->string('gravedad')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado');
            $table->date('fecha');
            $table->time('hora');
            //final
            $table->string('detalle_fin')->nullable();
            $table->string('diagnostico')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->on('users')->references('id')->onDelete('cascade');
            //ACTUALIZAR MEDICO_ID
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
        Schema::dropIfExists('emergencias');
    }
}
