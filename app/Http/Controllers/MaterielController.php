<?php

namespace App\Http\Controllers;

use App\Models\materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index()
    {
        $materiel = materiel::all();
        return response()->json($materiel, 200);
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'hourly_rate'=>'required',
        ]);
        return materiel::create($request->all());
    }
    public function update(Request $request, $id){
        $materiel = materiel::find($id);
        $materiel->update($request->all());
        return $materiel;
    }
    public function destroy($id){
        return materiel::destroy($id);
    }
    public function show (Request $request, $id){
        $materiel = materiel::find($id);
        return $materiel;
    }

}
