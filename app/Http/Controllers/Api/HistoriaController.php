<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoriaMedica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoriaController extends Controller
{
    public function getHistoriaByPaciente($userId)
    {
        $historia = HistoriaMedica::where('user_id', $userId)->first();

        if (!$historia) {
            return response()->json([], 204);
        }

        return response()->json(['historia' => $historia], 200);
    }

    public function createHistoria(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'antmed_fam' => 'required|string',
            'antmed_pers' => 'required|string',
            'medis_act' => 'required|string',
            'alergias' => 'required|string',
            'h_enfermedades' => 'required|string',
            'h_cirugias' => 'required|string',
            'salud_actual' => 'required|string',
            'notas' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $validator->setCustomMessages([
            'required' => 'El campo :attribute es obligatorio.',
            'exists' => 'El campo :attribute no existe.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $historia = new HistoriaMedica();
        $historia->antmed_fam = $request->input('antmed_fam');
        $historia->antmed_pers = $request->input('antmed_pers');
        $historia->medis_act = $request->input('medis_act');
        $historia->alergias = $request->input('alergias');
        $historia->h_enfermedades = $request->input('h_enfermedades');
        $historia->h_cirugias = $request->input('h_cirugias');
        $historia->salud_actual = $request->input('salud_actual');
        $historia->notas = $request->input('notas');
        $historia->user_id = $request->input('user_id');
        $historia->save();

        return response()->json(['message' => 'Historia médica creada exitosamente'], 201);
    }

    public function updateHistoria(Request $request, $id)
    {
        $historia = HistoriaMedica::find($id);

        if (!$historia) {
            return response()->json(['message' => 'Historia médica no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'antmed_fam' => 'nullable|string',
            'antmed_pers' => 'nullable|string',
            'medis_act' => 'nullable|string',
            'alergias' => 'nullable|string',
            'h_enfermedades' => 'nullable|string',
            'h_cirugias' => 'nullable|string',
            'salud_actual' => 'nullable|string',
            'notas' => 'nullable|string',
        ]);

        $validator->setCustomMessages([
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($request->has('antmed_fam')) {
            $historia->antmed_fam = $request->input('antmed_fam');
        }

        if ($request->has('antmed_pers')) {
            $historia->antmed_pers = $request->input('antmed_pers');
        }

        if ($request->has('medis_act')) {
            $historia->medis_act = $request->input('medis_act');
        }

        if ($request->has('alergias')) {
            $historia->alergias = $request->input('alergias');
        }

        if ($request->has('h_enfermedades')) {
            $historia->h_enfermedades = $request->input('h_enfermedades');
        }

        if ($request->has('h_cirugias')) {
            $historia->h_cirugias = $request->input('h_cirugias');
        }

        if ($request->has('salud_actual')) {
            $historia->salud_actual = $request->input('salud_actual');
        }

        if ($request->has('notas')) {
            $historia->notas = $request->input('notas');
        }

        $historia->save();

        return response()->json(['message' => 'Historia médica actualizada exitosamente'], 200);
    }

    public function deleteHistoria($id)
    {
        $historia = HistoriaMedica::find($id);

        if (!$historia) {
            return response()->json(['message' => 'Historia médica no encontrada'], 404);
        }

        $historia->delete();

        return response()->json(['message' => 'Historia médica eliminada exitosamente'], 200);
    }
}
