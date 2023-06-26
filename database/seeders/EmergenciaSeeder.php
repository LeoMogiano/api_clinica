<?php

namespace Database\Seeders;

use App\Models\Emergencia;
use Illuminate\Database\Seeder;

class EmergenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emergencias = [
            [
                'detalle_fin' => null,
                'diagnostico' => 'Neumonía',
                'estado' => 'En atención',
                'fecha' => '2023-06-13',
                'gravedad' => 'Alta',
                'hora' => '10:00:00',
                'motivo' => 'Dificultad para respirar y fiebre alta',
                'observacion' => 'El paciente presentaba dificultad para respirar, fiebre alta y tos persistente.',
                'user_id' => 7
            ],
            [
                'detalle_fin' => null,
                'diagnostico' => 'Fractura de tibia y peroné',
                'estado' => 'En atención',
                'fecha' => '2023-06-13',
                'gravedad' => 'Media',
                'hora' => '11:30:00',
                'motivo' => 'Dolor e inflamación en pierna después de una caída',
                'observacion' => 'El paciente sufrió una caída que resultó en una fractura de tibia y peroné. Se le realizó una radiografía y se remitió a cirugía ortopédica para tratamiento adicional.',
                'user_id' => 8
            ],
            [
                'detalle_fin' => 'Se le diagnosticó con gastroenteritis aguda y se le brindó tratamiento con líquidos intravenosos y medicamentos para controlar los síntomas. Tras una mejoría significativa, se le dio de alta con instrucciones de cuidado en el hogar.',
                'diagnostico' => 'Gastroenteritis aguda',
                'estado' => 'Finalizada',
                'fecha' => '2023-06-13',
                'gravedad' => 'Baja',
                'hora' => '14:45:00',
                'motivo' => 'Dolor abdominal, vómitos y diarrea',
                'observacion' => 'El paciente presentaba dolor abdominal intenso, vómitos y diarrea.',
                'user_id' => 9
            ]
        ];

        foreach ($emergencias as $emergencia) {
            Emergencia::create($emergencia);
        }
    }
    
}
