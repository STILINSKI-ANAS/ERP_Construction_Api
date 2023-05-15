<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projet;

class ProjetController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'adress'=>'required',
            'invested'=>'required',
            'payed'=>'required',
            'balance'=>'required',
            'num_employee'=>'required',
        ]);
        return projet::create($request->all());
    }

    public function show (Request $request, $id){
        $projet = projet::find($id);
        $projet->makeHidden(['created_at', 'updated_at']);
        $projet->articles->makeHidden(['created_at', 'updated_at','pivot']);
        return $projet;
    }
    public function index (){
        $projet = projet::all();
        return $projet;
    }
    public function update(Request $request, $id){
        $projet = projet::find($id);
        $projet->update($request->all());
        return $projet;
    }

    public function destroy($id){
        return projet::destroy($id);
    }

    public function search($name){
        return projet::where('name', 'like','%'.$name.'%')->get();
    }
}
