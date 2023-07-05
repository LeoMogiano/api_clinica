<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function getPersonalMed()
    {
        $personalMed = User::where('group', 'Personal Médico')->get();

        if (empty($personalMed)) {
            return response()->json([], 204);
        }

        return response()->json([
            'users' => $personalMed
        ]);
    }

    public function getPacientes()
    {
        $pacientes = User::where('group', 'Pacientes')->get();

        if (empty($pacientes)) {
            return response()->json([], 204);
        }

        return response()->json([
            'users' => $pacientes
        ]);
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'user' => $user
        ]);
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string',
            'group' => 'nullable|string',
            'especialidad' => 'nullable|string',
            'sexo' => 'nullable|string',
            'carnet' => 'nullable|string',
            'fecha_nac' => 'nullable|date',
            'telefono' => 'nullable|string',
            'tipo_sangre' => 'nullable|string',
            'contacto_emerg' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
        ]);

        $validator->setCustomMessages([
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El campo :attribute ya ha sido tomado.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->group = $request->input('group');
        $user->especialidad = $request->input('especialidad');
        $user->sexo = $request->input('sexo');
        $user->carnet = $request->input('carnet');
        $user->fecha_nac = $request->input('fecha_nac');
        $user->telefono = $request->input('telefono');
        $user->tipo_sangre = $request->input('tipo_sangre');
        $user->contacto_emerg = $request->input('contacto_emerg');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $directory = 'user_' . $user->id;

            Storage::disk('s3')->putFileAs($directory, $file, $fileName, 'public');
            $fileUrl = Storage::disk('s3')->url($directory . '/' . $fileName);

            $user->foto = $fileUrl;
        }

        $user->save();

        return response()->json(['message' => 'Usuario creado exitosamente'], 201);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $rules = [
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:6',
            'name' => 'string',
            'role' => 'nullable|string',
            'group' => 'nullable|string',
            'especialidad' => 'nullable|string',
            'sexo' => 'nullable|string',
            'carnet' => 'nullable|string',
            'fecha_nac' => 'nullable|date',
            'telefono' => 'nullable|string',
            'tipo_sangre' => 'nullable|string',
            'contacto_emerg' => 'nullable|string',
            // Validación de la imagen
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->setCustomMessages([
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El campo :attribute ya ha sido tomado.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $directory = 'user_' . $user->id;

            Storage::disk('s3')->putFileAs($directory, $file, $fileName, 'public');
            $fileUrl = Storage::disk('s3')->url($directory . '/' . $fileName);

            // Eliminar la foto anterior si existe
            if ($user->foto) {
                $existingFile = str_replace(Storage::disk('s3')->url(''), '', $user->foto);
                Storage::disk('s3')->delete($existingFile);
            }

            $user->foto = $fileUrl;
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('role')) {
            $user->role = $request->input('role');
        }

        if ($request->has('group')) {
            $user->group = $request->input('group');
        }

        if ($request->has('especialidad')) {
            $user->especialidad = $request->input('especialidad');
        }

        if ($request->has('sexo')) {
            $user->sexo = $request->input('sexo');
        }

        if ($request->has('carnet')) {
            $user->carnet = $request->input('carnet');
        }

        if ($request->has('fecha_nac')) {
            $user->fecha_nac = $request->input('fecha_nac');
        }

        if ($request->has('telefono')) {
            $user->telefono = $request->input('telefono');
        }

        if ($request->has('tipo_sangre')) {
            $user->tipo_sangre = $request->input('tipo_sangre');
        }

        if ($request->has('contacto_emerg')) {
            $user->contacto_emerg = $request->input('contacto_emerg');
        }

        $user->save();

        return response()->json(['message' => 'Usuario actualizado exitosamente'], 200);
    }


    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
    }

    public function identifyUser(Request $request)
    {
        $users = User::where('group', 'Pacientes')->get();
    
        if ($request->hasFile('foto')) {
            $imageFile = $request->file('foto');
            $extension = $imageFile->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $directory = 'reconocimientos';
            Storage::disk('s3')->putFileAs($directory, $imageFile, $fileName, 'public');
            $imageUrl = Storage::disk('s3')->url($directory . '/' . $fileName);
    
            foreach ($users as $user) {
                if ($user->foto) {
                    $image1 = substr($imageUrl, 41, strlen($imageUrl));
                    $image2 = substr($user->foto, 41, strlen($user->foto));
    
                    $client = new RekognitionClient([
                        'region' => 'us-east-1',
                        'version' => 'latest',
                    ]);
    
                    $results = $client->compareFaces([
                        'SimilarityThreshold' => 80,
                        'SourceImage' => [
                            'S3Object' => [
                                'Bucket' => 'mogi-aws-bucket',
                                'Name' => $image1,
                            ],
                        ],
                        'TargetImage' => [
                            'S3Object' => [
                                'Bucket' => 'mogi-aws-bucket',
                                'Name' => $image2,
                            ],
                        ],
                    ]);
    
                    $resultLabels = $results->get('FaceMatches');
    
                    if (!empty($resultLabels)) {
                        return response()->json(['user' => $user], 200);
                    }
                }
            }
        }
    
        return response()->json([], 204);
    }

}
