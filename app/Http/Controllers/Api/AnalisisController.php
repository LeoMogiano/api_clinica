<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Analisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnalisisController extends Controller
{
    public function getAnalisisByEmergencia($idEmergencia)
    {
        $analisis = $analisis = Analisis::where('emergencia_id', $idEmergencia)->get();

        if ($analisis->isEmpty()) {
            return response()->json([], 204);
        }

        return response()->json([
            'analisis' => $analisis
        ]);
    }

    public function createAnalisis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'motivo' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'emergencia_id' => 'required|exists:emergencias,id',
        ]);

        $validator->setCustomMessages([
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'date' => 'El campo :attribute debe ser una fecha válida.',

            'exists' => 'El campo :attribute no existe en la tabla de emergencias.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $analisis = new Analisis();
        $analisis->descripcion = $request->input('descripcion');
        $analisis->motivo = $request->input('motivo');
        $analisis->fecha = $request->input('fecha');
        $analisis->hora = $request->input('hora');
        $analisis->emergencia_id = $request->input('emergencia_id');
        $analisis->save();

        return response()->json(['message' => 'Análisis creado exitosamente'], 201);
    }

    public function deleteAnalisis($id)
    {
        $analisis = Analisis::find($id);

        if (!$analisis) {
            return response()->json(['message' => 'Análisis no encontrado'], 404);
        }

        $analisis->delete();

        return response()->json(['message' => 'Análisis eliminado exitosamente'], 200);
    }
}
