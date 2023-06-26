<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Leo Mogiano';
        $user->email = 'leo@gmail.com';
        $user->password = Hash::make('leo123');
        $user->role = 'Doctor';
        $user->group = 'Personal Médico';
        $user->especialidad = 'Cardiología';
        $user->sexo = 'Masculino';
        $user->carnet = '6287907 SC';
        $user->telefono = '62223712';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->save();

        $user = new User();
        $user->name = 'Michael Scott';
        $user->email = 'michael@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_5/1683210230michael.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Doctor';
        $user->group = 'Personal Médico';
        $user->especialidad = 'Pediatría';
        $user->sexo = 'Masculino';
        $user->carnet = '1287907 SC';
        $user->telefono = '62523222';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->save();

        $user = new User();
        $user->name = 'Ana de Armas';
        $user->email = 'ana@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_8/1683211660ana.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Doctor';
        $user->group = 'Personal Médico';
        $user->especialidad = 'Ginecología';
        $user->sexo = 'Femenino';
        $user->carnet = '2287907 SC';
        $user->telefono = '72523888';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->save();


        // ENFERMEROS

        $user = new User();
        $user->name = 'Christian Bale';
        $user->email = 'julian@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_10/1687206574bale.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Enfermero';
        $user->group = 'Personal Médico';
        $user->especialidad = 'Enfermería Pediátrica';
        $user->sexo = 'Masculino';
        $user->carnet = '3287907 SC';
        $user->telefono = '62523000';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->save();

        $user = new User();
        $user->name = 'Pam Wesley';
        $user->email = 'pam@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_11/1687206386pam.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Enfermero';
        $user->group = 'Personal Médico';
        $user->especialidad = 'Enfermería Quirúrgica';
        $user->sexo = 'Femenino';
        $user->carnet = '62229071 CBBA';
        $user->telefono = '72523712';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->save();

        $user = new User();
        $user->name = 'Jim Halpert';
        $user->email = 'jim@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_12/1687205247jim.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Enfermero';
        $user->group = 'Personal Médico';
        $user->especialidad = 'Enfermería Geriátrica';
        $user->sexo = 'Masculino';
        $user->carnet = '32122356 SC';
        $user->telefono = '60023712';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->save();

        // PACIENTES

        $user = new User();
        $user->name = 'Brad Pitt';
        $user->email = 'brad@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_7/1683211406Brad.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Asegurado';
        $user->group = 'Pacientes';
        $user->especialidad = null;
        $user->sexo = 'Masculino';
        $user->carnet = '32120956 LP';
        $user->telefono = '62520012';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->contacto_emerg = '623552111';
        $user->save();

        $user = new User();
        $user->name = 'Evan Peters';
        $user->email = 'evan@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_13/1687205789evan.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'No Asegurado';
        $user->group = 'Pacientes';
        $user->especialidad = null;
        $user->sexo = 'Masculino';
        $user->carnet = '32123226 SC';
        $user->telefono = '62511712';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->contacto_emerg = '68764323';
        $user->save();

        $user = new User();
        $user->name = 'Ella Freya';
        $user->email = 'ella@gmail.com';
        $user->foto = 'https://mogi-aws-bucket.s3.amazonaws.com/user_10/1687205898ella.jpg';
        $user->password = Hash::make('leo123');
        $user->role = 'Asegurado';
        $user->group = 'Pacientes';
        $user->especialidad = null;
        $user->sexo = 'Femenino';
        $user->carnet = '52123226 SC';
        $user->telefono = '62523712';
        $user->tipo_sangre = 'O+';
        $user->fecha_nac = '1990-01-01';
        $user->contacto_emerg = '75555876';
        $user->save();

        
    }
}
