<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoachController extends Controller
{
    public function getClients($id)
    {
        $clients = User::where("coach_id", $id)->get();
        return $clients;
    }
}
