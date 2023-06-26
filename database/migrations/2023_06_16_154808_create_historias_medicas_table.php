<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias_medicas', function (Blueprint $table) {
            $table->id();
            $table->string('antmed_fam');     // Antecedentes Medicos Familiares
            $table->string('antmed_pers');    // Antecedentes Medicos Personales
            $table->string('medis_act');      // AMedicamentos Actuales
            $table->string('alergias');       // Alergias
            $table->string('h_enfermedades'); // Historial Enfermedades
            $table->string('h_cirugias');     // Historial Cirugias
            $table->string('salud_actual');   // Salud Actual
            $table->string('notas');          // Notas
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('historias_medicas');
    }
}
