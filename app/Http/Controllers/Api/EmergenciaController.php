<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Emergencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmergenciaController extends Controller
{
    public function getEmergencias()
{
    $emergencias = Emergencia::all();

    if ($emergencias->isEmpty()) {
        return response()->json([], 204);
    }

    // Obtener los usuarios relacionados a las emergencias
    $userIds = $emergencias->pluck('user_id')->unique()->toArray();
    $users = User::whereIn('id', $userIds)->get()->keyBy('id');

    // Agregar el campo 'nombre' a cada emergencia
    $emergencias = $emergencias->map(function ($emergencia) use ($users) {
        $userId = $emergencia->user_id;
        $emergencia->name_user = isset($users[$userId]) ? $users[$userId]->name : null;
        return $emergencia;
    });

    return response()->json([
        'success' => true,
        'emergencias' => $emergencias,
    ]);
}


    public function getEmergenciaById($id)
    {
        $emergencia = Emergencia::find($id);

        if (empty($emergencia)) {
            return response()->json([], 204);
        }

        return response()->json([
            'success' => true,
            'emergencia' => $emergencia,
        ]);
    }

    public function createEmergencia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'diagnostico' => 'nullable|string',
            'estado' => 'required|string',
            'fecha' => 'required|date',
            'gravedad' => 'required|string',
            'hora' => 'required',
            'motivo' => 'nullable|string',
            'observacion' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'medico_id' => 'nullable|exists:users,id',
        ]);

        $validator->setCustomMessages([
            'required' => 'El campo :attribute es obligatorio.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'exists' => 'El campo :attribute no existe en la tabla de usuarios.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $emergencia = new Emergencia();
        
        $emergencia->diagnostico = $request->input('diagnostico');
        $emergencia->estado = $request->input('estado');
        $emergencia->fecha = $request->input('fecha');
        $emergencia->gravedad = $request->input('gravedad');
        $emergencia->hora = $request->input('hora');
        $emergencia->motivo = $request->input('motivo');
        $emergencia->observacion = $request->input('observacion');
        $emergencia->user_id = $request->input('user_id');
        $emergencia->medico_id = $request->input('medico_id');
        $emergencia->save();

        return response()->json(['message' => 'Emergencia creada exitosamente'], 201);
    }

    public function updateEmergencia(Request $request, $id)
    {
        $emergencia = Emergencia::find($id);

        if (!$emergencia) {
            return response()->json(['message' => 'Emergencia no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            
            'diagnostico' => 'nullable|string',
            'estado' => 'nullable|string',
            'fecha' => 'nullable|date',
            'gravedad' => 'nullable|string',
            'hora' => 'nullable',
            'motivo' => 'nullable|string',
            'observacion' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'medico_id' => 'nullable|exists:users,id',
        ]);

        $validator->setCustomMessages([
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'exists' => 'El campo :attribute no existe en la tabla de usuarios.',
        ]);

   

        if ($request->filled('diagnostico')) {
            $emergencia->diagnostico = $request->input('diagnostico');
        }

        if ($request->filled('estado')) {
            $emergencia->estado = $request->input('estado');
        }

        if ($request->filled('fecha')) {
            $emergencia->fecha = $request->input('fecha');
        }

        if ($request->filled('gravedad')) {
            $emergencia->gravedad = $request->input('gravedad');
        }

        if ($request->filled('hora')) {
            $emergencia->hora = $request->input('hora');
        }

        if ($request->filled('motivo')) {
            $emergencia->motivo = $request->input('motivo');
        }

        if ($request->filled('observacion')) {
            $emergencia->observacion = $request->input('observacion');
        }

        if ($request->filled('user_id')) {
            $emergencia->user_id = $request->input('user_id');
        }

        if ($request->filled('medico_id')) {
            $emergencia->medico_id = $request->input('medico_id');
        }

        $emergencia->save();


        return response()->json(['message' => 'Emergencia actualizada exitosamente'], 200);
    }

    public function deleteEmergencia($id)
    {
        $emergencia = Emergencia::find($id);

        if (!$emergencia) {
            return response()->json(['message' => 'Emergencia no encontrada'], 404);
        }

        $emergencia->delete();

        return response()->json(['message' => 'Emergencia eliminada exitosamente'], 200);
    }
}
