<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\ClientProjet;
use App\Models\entrepot;
use App\Models\projet;
use App\Models\utilisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientProjetController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projet_id' => 'required|exists:projets,id',
            'client_id' => 'required|exists:clients,id',
            'objet' => 'required|string',
            'somme' => 'required',
            'status' => 'required|string',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $client = Entrepot::find($request->client_id);
//        $prix_total = $entrepot->prix_vente * $request->quantity;

        $paiement = ClientProjet::create(array_merge(
            $request->all(),
//            ['prix_total' => $prix_total]
        ));

        $projet = projet::find($paiement->projet_id);
        $paiements = DB::table('client_projet')->where('projet_id', $projet->id)->sum('somme');
        $balance =  $paiements - $projet->charges;
//        $balance = $projet->produits + $paiements;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['produits' => $paiements],

        ));

//        $entrepot->update(array_merge(
//            ['quantity' => ($entrepot->quantity -$request->quantity)],
//        ));


        return response()->json($paiements, 201);
    }

    public function show (Request $request, $id){
        $utilisation = utilisation::find($id);
        $utilisation->makeHidden(['created_at', 'updated_at']);
        $utilisation->projet->makeHidden(['created_at', 'updated_at']);
        $utilisation->article->makeHidden(['created_at', 'updated_at']);
        return $utilisation;
    }

    public function update(Request $request, $id)
    {
        $paiement = ClientProjet::find($id);

        $oldUtilQuantity = $paiement->quantity;

        if (!$paiement) {
            return response()->json(['error' => 'Utilisation not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
//            'projet_id' => 'required|exists:projets,id',
//            'client_id' => 'required|exists:clients,id',
//            'objet' => 'required|string',
//            'somme' => 'required',
//            'status' => 'required|string',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $paiement->update(array_merge(
            $request->all()
        ));

//        $entrepot = Entrepot::find($utilisation->entrepot_id);
//        $prix_total = $entrepot->prix_vente * $utilisation->quantity;

//        $utilisation->update(array_merge(
//            ['prix_total' => $prix_total]
//        ));

        $projet = projet::find($paiement->projet_id);

        $paiements = DB::table('client_projet')->where('projet_id', $projet->id)->sum('somme');

        $balance = $paiements - $projet->charges;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['produits' => $paiements],

        ));
//        $oldQuantity = $entrepot->quantity;


//        $newQuantity = $oldQuantity  + $oldUtilQuantity - $request->quantity;
//
//        $entrepot->update(array_merge(
//            ['quantity' => $newQuantity],
//        ));


        return response()->json($paiement, 200);
    }

    public function destroy($id)
    {
        $paiement = ClientProjet::find($id);
        if (!$paiement) {
            return response()->json(['message' => 'Utilisation not found'], 404);
        }
        $projet = projet::find($paiement->projet_id);
//        $client = client::find($paiement->client_id);

        $produits= $projet->produits - $paiement->somme;

        $balance= $produits - $projet->charges;
//        $charges= $projet->charges - $client->prix_total;


        $projet->update(array_merge(
            ['balance' => $balance],
            ['produits' => $produits],
        ));

//        $quantity= $entrepot->quantity + $utilisation->quantity;
//
//        $entrepot->update(array_merge(
//            ['quantity' => $quantity],
//        ));

        $paiement->delete();
        return response()->json(['message' => 'Utilisation deleted'], 200);
    }

    public function getByProjetId($projetId)
    {
        $paiements = ClientProjet::where('projet_id', $projetId)
            ->with(['client' => function($query) {
                $query->select('id', 'name');
            }])
            ->get();
        $paiements->makeHidden(['created_at', 'updated_at']);

        return response()->json($paiements, 200);
    }}
