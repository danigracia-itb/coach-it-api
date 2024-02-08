<?php

namespace App\Http\Controllers\API;

use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'muscular_group' => 'required|integer|in:1,2,3,4',
            'user_id' => 'required|exists:users,id',
        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear el ejercicio
        $exercise = Exercise::create([
            'name' => $request->name,
            'muscular_group' => $request->muscular_group,
            'is_default' => false,
            'user_id' => $request->user_id,
        ]);

        // Retornar el ejercicio creado
        return $exercise;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Buscar el modelo por el ID
         $exercise = Exercise::find($id);

         // Verificar si el modelo existe
         if (!$exercise) {
             return response()->json(['message' => 'Exercise not found'], 404);
         }

         // Eliminar el modelo
         $exercise->delete();

         return response()->json(['message' => 'Exercise Deleted']);
    }

    //Other
    //Gets all exercises defaults + created (recives coach id)
    public function getAllUserExercises($id)
    {
        $exercises = Exercise::where(function ($query) use ($id) {
            $query->where('user_id', '=', $id)
                  ->orWhere('is_default', '=', true);
        })->get();
        return $exercises;
    }
}
