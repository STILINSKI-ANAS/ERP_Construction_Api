<?php

namespace App\Http\Controllers;
use App\Models\entrepot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EntrepotController extends Controller
{
    //
    public function addFournisseur(Request $request, entrepot $article){
        $article->fournisseurs()->attach($request->fournisseurs);
        return 'Attached';
    }

    public function index (){
        $article = entrepot::all();
        return $article;
    }
    public function show (Request $request, $id){
        $article = entrepot::find($id);
        $article->makeHidden(['created_at', 'updated_at']);
        $article->fournisseurs->makeHidden(['created_at', 'updated_at','pivot']);
        return $article;
    }

    public function store(Request $request){
        $request->validate([
            "name"=>'required',
            "prix_achat"=>'required',
            "prix_vente"=>'required',
            "category"=>'required',
            "quantity"=>'required'
        ]);
        return entrepot::create($request->all());
    }

    public function update(Request $request, $id){
        $article = entrepot::find($id);
        $article->update($request->all());
        return $article;
    }

    public function destroy($id){
        return entrepot::destroy($id);
    }

    public function search($name){
        return entrepot::where('name', 'like','%'.$name.'%')->get();
    }





}
