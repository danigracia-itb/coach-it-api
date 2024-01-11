<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {

        // Datos del formulario
        $data = [
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Envía el correo
        try {
            Mail::to('admin@example.com')->send(new ContactFormMail($data));
            return response()->json(['message' => 'Contact form sended succesfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error while sending the email'], 500);
        }
    }
}
