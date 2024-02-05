<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    //GETS ATHLETES (FROM A COACH) WITH THEIR PAYMENTS DATA
    public function getAthleteWithPayments($id)
    {
        $athlete = User::where("id", $id)->with("payments")->first();
        return $athlete;
    }
    public function getAthletesWithLastPayments($id) {
        $athletes = User::where("coach_id", $id)->with(["payments" => function($query) {
            $query->orderBy('date', 'desc'); // Ordena los pagos por fecha de forma descendente
        }])->get()->map(function($athlete) {
            $athlete->latest_payment = $athlete->payments->first(); // Obtiene el pago más reciente para cada atleta
            return $athlete;
        });
        return $athletes;
    }

    public function store(Request $request) {
        $payment = Payment::create([
            "date" => $request->input("date"),
            "quantity" => $request->input("quantity"),
            "athlete_id" => $request->input("athlete_id"),
            "coach_id" => $request->input("coach_id"),
        ]);
        $payment->save();
        return $payment;
    }
}
