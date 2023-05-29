<?php

namespace App\Http\Controllers;

use App\Models\ClientProjet;
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

        $paiement = ClientProjet::create(
            $request->all()
        );

        $projet = projet::find($paiement->projet_id);
        $paiements = DB::table('client_projet')->where('projet_id', $projet->id)->sum('somme');
        $balance =  $paiements - $projet->charges;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['produits' => $paiements],
        ));
        return response()->json($paiements, 201);
    }

    public function show (Request $request, $id){
        $paiement = ClientProjet::find($id);
        $paiement->makeHidden(['created_at', 'updated_at']);
        return $paiement;
    }

    public function update(Request $request, $id)
    {
        $paiement = ClientProjet::find($id);

        if (!$paiement) {
            return response()->json(['error' => 'Utilisation not found.'], 404);
        }

        $validator = Validator::make($request->all(),[
            'somme' => 'required',
            'status' => 'string',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $paiement->update(array_merge(
            $request->all()
        ));

        $projet = projet::find($paiement->projet_id);

        $paiements = DB::table('client_projet')->where('projet_id', $projet->id)->sum('somme');

        $balance = $paiements - $projet->charges;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['produits' => $paiements],

        ));

        return response()->json($paiement, 200);
    }

    public function destroy($id)
    {
        $paiement = ClientProjet::find($id);
        if (!$paiement) {
            return response()->json(['message' => 'Utilisation not found'], 404);
        }
        $projet = projet::find($paiement->projet_id);

        $produits= $projet->produits - $paiement->somme;

        $balance= $produits - $projet->charges;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['produits' => $produits],
        ));

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
