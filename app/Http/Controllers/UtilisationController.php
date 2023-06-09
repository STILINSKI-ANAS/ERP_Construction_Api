<?php

namespace App\Http\Controllers;

use App\Models\entrepot;
use App\Models\projet;
use App\Models\utilisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UtilisationController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projet_id' => 'required|exists:projets,id',
            'entrepot_id' => 'required|exists:entrepot,id',
            'quantity' => 'required|numeric|min:1',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $entrepot = Entrepot::find($request->entrepot_id);
        $prix_total = $entrepot->prix_vente * $request->quantity;
        $sommeO = DB::table('utilisations')->where('projet_id',  $request->projet_id)->sum('prix_total');

        $utilisation = Utilisation::create(array_merge(
            $request->all(),
            ['prix_total' => $prix_total]
        ));

        $projet = projet::find($utilisation->projet_id);
        $sommeN = DB::table('utilisations')->where('projet_id', $projet->id)->sum('prix_total');
        $charges = $projet->charges + $prix_total;
        $balance = $projet->produits - $charges;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['charges' => $charges],

        ));

        $entrepot->update(array_merge(
            ['quantity' => ($entrepot->quantity -$request->quantity)],
        ));


        return response()->json($utilisation, 201);
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
        $utilisation = Utilisation::find($id);
        $oldPrix_total = $utilisation->prix_total;
        $oldQuantity = $utilisation->quantity;
        if (!$utilisation) {
            return response()->json(['error' => 'Utilisation not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'projet_id' => 'exists:projets,id',
            'entrepot_id' => 'exists:entrepot,id',
            'quantity' => 'numeric|min:1',
            'prix_total' => '',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $projet = projet::find($utilisation->projet_id);
        $entrepot = Entrepot::find($utilisation->entrepot_id);
//        utilisation->quantity, prix_total
//        projet->charges, balance
//        entrepot->quantity

        $newQuantity = $request->quantity;
        $newPrix_total = $entrepot->prix_vente * $newQuantity;

        $utilisation->update(array_merge(
            ['quantity' => $newQuantity],
            ['prix_total' => $newPrix_total]
        ));

        $diff = $newPrix_total - $oldPrix_total;
        $charges = $projet->charges + $diff;
        $balance = $projet->produits - $charges;

        $projet->update([
            'balance' => $balance,
            'charges' => $charges,
        ]);

        $diff = $newQuantity - $oldQuantity;
        $newEntrQuantity = $entrepot->quantity + $diff;

        $entrepot->update(array_merge(
            ['quantity' => $newEntrQuantity],
        ));


        return response()->json($utilisation, 200);
    }

    public function destroy($id)
    {
        $utilisation = Utilisation::find($id);
        if (!$utilisation) {
            return response()->json(['message' => 'Utilisation not found'], 404);
        }
        $projet = projet::find($utilisation->projet_id);
        $entrepot = Entrepot::find($utilisation->entrepot_id);

        $charges= $projet->charges - $utilisation->prix_total;
        $balance = $projet->produits - $charges;


        $projet->update(array_merge(
            ['balance' => $balance],
            ['charges' => $charges],
        ));

        $quantity= $entrepot->quantity + $utilisation->quantity;

        $entrepot->update(array_merge(
            ['quantity' => $quantity],
        ));





        $utilisation->delete();
        return response()->json(['message' => 'Utilisation deleted'], 200);
    }

    public function getByProjetId($projetId)
    {
        $utilisations = Utilisation::where('projet_id', $projetId)
            ->with(['article' => function($query) {
                $query->select('id', 'name');
            }])
            ->get();
        $utilisations->makeHidden(['created_at', 'updated_at']);

        return response()->json($utilisations, 200);
    }

    public function index()
    {
        $utilisations = Utilisation::all();
        return response()->json($utilisations, 200);
    }




}
