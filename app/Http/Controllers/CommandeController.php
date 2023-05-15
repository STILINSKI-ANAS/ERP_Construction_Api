<?php

namespace App\Http\Controllers;

use App\Models\commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function show (Request $request, $id){
        $commande = commande::find($id);
        $f = $commande->toArray();
        return $commande->$id;
    }
}
