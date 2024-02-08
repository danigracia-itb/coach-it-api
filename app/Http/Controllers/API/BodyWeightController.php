<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BodyWeight;
use Illuminate\Http\Request;

class BodyWeightController extends Controller
{
    public function store(Request $request) {
        $body_weight = BodyWeight::create([
            "date" => $request->input("date"),
            "value" => $request->input("value"),
            "user_id" => $request->input("user_id"),
        ]);
        $body_weight->save();
        return $body_weight;
    }
    public function update(Request $request, $id) {
        $body_weight = BodyWeight::findOrFail($id);
        $body_weight->value = $request->input("value");
        $body_weight->save();
        return $body_weight;
    }
    public function show($id) {
        $body_weights = BodyWeight::where("user_id", $id)->orderBy("date", "ASC")->get();
        return $body_weights;
    }
}
