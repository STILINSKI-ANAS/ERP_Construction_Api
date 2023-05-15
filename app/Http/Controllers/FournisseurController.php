<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fournisseur;

class FournisseurController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'adresse'=>'required',
            'CIN'=>'required',
            'balance'=>'required',
            'email'=>'required',
            'phoneNumber'=>'required'
        ]);
        return fournisseur::create($request->all());
    }

    public function show (Request $request, $id){
        $fournisseur = fournisseur::find($id);
        $a = $fournisseur->articles;
        return $a;
    }
    public function index (){
        $fournisseur = fournisseur::all();
        return $fournisseur;
    }
    public function update(Request $request, $id){
        $fournisseur = fournisseur::find($id);
        $fournisseur->update($request->all());
        return $fournisseur;
    }

    public function destroy($id){
        return fournisseur::destroy($id);
    }

    public function search($name){
        return fournisseur::where('name', 'like','%'.$name.'%')->get();
    }
}
