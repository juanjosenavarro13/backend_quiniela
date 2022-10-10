<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|unique:teams',
            'logo'          => 'mimes:jpeg,jpg,png|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $team = new Team();
        $team->name = $request->name;

        // if exist logo img
        if ($request->hasFile('logo')) {
            $nameImg = Storage::disk('public')->put('logos', $request->file('logo'));
            $team->logo_url = Storage::url($nameImg);
        }

        // save on db teams
        $team->save();

        return response()->json($team, 200);
    }

    public function edit(Request $request, $id)
    {
        if (!Team::find($id)) {
            return response()->json('team no encontrado', 400);
        }

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|unique:teams',
            'logo'          => 'mimes:jpeg,jpg,png|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $team = Team::find($id);
        $team->name = $request->name;

        if ($request->hasFile('logo')) {
            $nameImg = Storage::disk('public')->put('logos', $request->file('logo'));
            $team->logo_url = Storage::url($nameImg);
        }

        $team->update();

        return response()->json($team, 200);
    }
}
