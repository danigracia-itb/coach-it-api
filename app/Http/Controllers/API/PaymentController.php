<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PaymentReminderMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function store(Request $request) {
        $payment = Payment::create([
            "date" => $request->input("date"),
            "quantity" => $request->input("quantity"),
            "payment_type" => $request->input("payment_type"),
            "athlete_id" => $request->input("athlete_id"),
            "coach_id" => $request->input("coach_id"),
        ]);
        $payment->save();
        return $payment;
    }

    public function reminder(Request $request) {
        Mail::to($request->input("athlete_email"))->send(new PaymentReminderMail($request->input("athlete_name"), $request->input("coach"), $request->input("date"), $request->input("quantity"), $request->input("payment_type")));

        return "success";
    }
}
