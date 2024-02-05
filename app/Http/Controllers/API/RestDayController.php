<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RestDay;
use Illuminate\Http\Request;

class RestDayController extends Controller
{
    public function store(Request $request)
    {

        // Crear el ejercicio
        $restDay = RestDay::create([
            'date' => $request->input("date"),
            'user_id' => $request->input("user_id"),
        ]);

        // Retornar el ejercicio creado
        return $restDay;
    }

    public function availableDay(Request $request) {
        $restDay = RestDay::where("date", $request->input("date"))->where('user_id', $request->input("user_id"))->first();
        $restDay->delete();
        return "success";
    }
}
