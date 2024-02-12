<?php

namespace App\Http\Controllers\API;

use App\Models\Trac;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TracController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'leg_soreness' => 'required|integer|between:1,5',
            'push_soreness' => 'required|integer|between:1,5',
            'pull_soreness' => 'required|integer|between:1,5',
            'sleep_nutrition' => 'required|integer|between:1,5',
            'recovery' => 'required|integer|between:1,5',
            'motivation' => 'nullable|integer|between:1,5',
            'technical_comfort' => 'nullable|integer|between:1,5',
            'notes' => 'nullable|string',
        ]);

        // Crear un nuevo Trac con los datos validados
        $trac = new Trac($validatedData);
        $trac->save();

        // Devolver una respuesta de éxito
        return $trac;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trac = Trac::findOrFail($id);
        return $trac;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'leg_soreness' => 'required|integer|between:1,5',
            'push_soreness' => 'required|integer|between:1,5',
            'pull_soreness' => 'required|integer|between:1,5',
            'sleep_nutrition' => 'required|integer|between:1,5',
            'recovery' => 'required|integer|between:1,5',
            'motivation' => 'nullable|integer|between:1,5',
            'technical_comfort' => 'nullable|integer|between:1,5',
            'notes' => 'nullable|string',
        ]);

        $trac = Trac::findOrFail($id);

        $trac->update($validatedData);

        $trac->save();
        // Devolver una respuesta de éxito
        return $trac;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trac = Trac::findOrFail($id);
        $trac->delete();
    }
}
