<?php

namespace Database\Seeders;

use App\Models\Analisis;
use Illuminate\Database\Seeder;

class AnalisisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Analisis::create([
            'descripcion' => 'Análisis de sangre para evaluar infección',
            'motivo' => 'Dolor de cabeza y fiebre persistente',
            'emergencia_id' => 1,
            'fecha' => '2023-06-14',
            'hora' => '09:30:00',
        ]);

        Analisis::create([
            'descripcion' => 'Análisis de tomografía de tórax',
            'motivo' => 'Tos persistente y dificultad respiratoria',
            'emergencia_id' => 1,
            'fecha' => '2023-06-15',
            'hora' => '14:00:00',
        ]);

        // Análisis para la emergencia con id 2
        Analisis::create([
            'descripcion' => 'Estudio de resonancia magnética de pierna',
            'motivo' => 'Dolor e inflamación en pierna después de una caída',
            'emergencia_id' => 2,
            'fecha' => '2023-06-13',
            'hora' => '11:30:00',
        ]);

        Analisis::create([
            'descripcion' => 'Análisis de sangre para evaluar coagulación',
            'motivo' => 'Hinchazón y moretones en la pierna lesionada',
            'emergencia_id' => 2,
            'fecha' => '2023-06-14',
            'hora' => '10:45:00',
        ]);

        // Análisis para la emergencia con id 3

        Analisis::create([
            'descripcion' => 'Estudio de ultrasonido abdominal',
            'motivo' => 'Dolor intenso en el abdomen y distensión abdominal',
            'emergencia_id' => 3,
            'fecha' => '2023-06-14',
            'hora' => '12:15:00',
        ]);

        Analisis::create([
            'descripcion' => 'Análisis de sangre para evaluar función hepática',
            'motivo' => 'Malestar general y coloración amarillenta en la piel',
            'emergencia_id' => 3,
            'fecha' => '2023-06-15',
            'hora' => '16:45:00',
        ]);
    }
}
