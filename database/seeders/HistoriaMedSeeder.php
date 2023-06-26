<?php

namespace Database\Seeders;

use App\Models\HistoriaMedica;
use Illuminate\Database\Seeder;

class HistoriaMedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $historia1 = new HistoriaMedica();
        $historia1->antmed_fam = 'Hipertensión arterial en la familia, enfermedad cardíaca en el abuelo paterno';
        $historia1->antmed_pers = 'Alergias estacionales (polen, ácaros del polvo)';
        $historia1->medis_act = 'Ninguno';
        $historia1->alergias = 'Polen, frutos secos, mariscos';
        $historia1->h_enfermedades = 'Varicela en la infancia, bronquitis aguda a los 5 años';
        $historia1->h_cirugias = 'Apéndice removido en 2010';
        $historia1->salud_actual = 'Sin síntomas. Mantiene una presión arterial estable y realiza ejercicio regularmente. Último chequeo médico: febrero 2023, todo normal.';
        $historia1->notas = 'Se recomienda evitar el contacto con alérgenos conocidos, llevar un control regular de la presión arterial y mantener un estilo de vida saludable.';
        $historia1->user_id = 7;
        $historia1->save();

        $historia2 = new HistoriaMedica();
        $historia2->antmed_fam = 'Asma en la familia, enfermedad celíaca en la madre';
        $historia2->antmed_pers = 'Fractura de brazo a los 10 años';
        $historia2->medis_act = 'Inhalador para el asma (utilizado ocasionalmente)';
        $historia2->alergias = 'Ninguna';
        $historia2->h_enfermedades = 'Sin antecedentes relevantes';
        $historia2->h_cirugias = 'Ninguna';
        $historia2->salud_actual = 'Control del asma con el inhalador. Sin problemas respiratorios recientes. Último chequeo médico: enero 2023, todo normal.';
        $historia2->notas = 'Se recomienda llevar el inhalador siempre consigo, realizar controles regulares con el médico y llevar una dieta libre de gluten si presenta síntomas de intolerancia.';
        $historia2->user_id = 8;
        $historia2->save();

        $historia3 = new HistoriaMedica();
        $historia3->antmed_fam = 'Cáncer de mama en la familia (madre, tía materna)';
        $historia3->antmed_pers = 'Apendicitis a los 20 años';
        $historia3->medis_act = 'Ninguno';
        $historia3->alergias = 'Ninguna';
        $historia3->h_enfermedades = 'Ninguna';
        $historia3->h_cirugias = 'Mastectomía bilateral en 2018';
        $historia3->salud_actual = 'Sin síntomas. Realiza revisiones periódicas con el especialista. Último chequeo médico: marzo 2023, todo normal.';
        $historia3->notas = 'Se recomienda continuar con las revisiones de seguimiento, realizar autoexámenes de mama regularmente y mantener una vida saludable.';
        $historia3->user_id = 9;
        $historia3->save();
    }
}
