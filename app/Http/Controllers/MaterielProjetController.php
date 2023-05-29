<?php

namespace App\Http\Controllers;

use App\Models\MaterielProjet;
use App\Models\Projet;
use App\Models\Materiel;
use App\Models\worker;
use App\Models\WorkerProjet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MaterielProjetController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projet_id' => 'required|exists:projets,id',
            'materiel_id' => 'required|exists:materiels,id',
            'hours' => 'required',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $materiel = materiel::find($request->materiel_id);
        $somme = $materiel->hourly_rate* $request->hours;
        $sommeO = DB::table('materiel_projets')->where('projet_id', $request->projet_id)->sum('somme');
        $materielProjet = MaterielProjet::create(array_merge(
            $request->all(),
            ['somme' => $somme]
        ));

        $projet = Projet::find($request->projet_id);

        $sommeN = DB::table('materiel_projets')->where('projet_id', $projet->id)->sum('somme');
        $charge = $projet->charges + $somme;
        $balance = $projet->produits - $charge;

        $projet->update(array_merge(
            ['balance' => $balance],
            ['charges' => $charge],
        ));

        return response()->json($materielProjet, 201);
    }

    public function show(Request $request, $id)
    {
        $materielProjet = MaterielProjet::find($id);
        $materielProjet->makeHidden(['created_at', 'updated_at']);
        $materielProjet->projet->makeHidden(['created_at', 'updated_at']);
        $materielProjet->materiel->makeHidden(['created_at', 'updated_at']);
        return $materielProjet;
    }

    public function update(Request $request, $id)
    {
        $materielProjet = MaterielProjet::find($id);
        $oldSomme = $materielProjet->somme;
        if (!$materielProjet) {
            return response()->json(['error' => 'MaterielProjet not found.'], 404);
        }

        $validator = Validator::make($request->all(),[
            'projet_id' => 'exists:projets,id',
            'hours' => 'required|numeric',
            'somme' => '',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $projet = Projet::find($materielProjet->projet_id);

        $hourlyRate = Materiel::find($materielProjet->materiel_id)->hourly_rate;
//        somme,  charges, balance
        $newSomme = $request->hours * $hourlyRate;

        $materielProjet->update(array_merge(
            [
                'somme' => $newSomme,
                'hours'=> $request->hours
            ],

        ));

        $diff = $newSomme - $oldSomme;
        $charges = $projet->charges + $diff;

        $balance = $projet->produits - $charges;

        $projet->update([
            'balance' => $balance,
            'charges' => $charges,
        ]);

        return response()->json($materielProjet, 200);
    }

    public function destroy($id)
    {
        $materielProjet = MaterielProjet::find($id);

        if (!$materielProjet) {
            return response()->json(['message' => 'MaterielProjet not found'], 404);
        }

        $projet = Projet::find($materielProjet->projet_id);

        $charges = $projet->charges - $materielProjet->somme;
        $balance = $projet->produits - $charges;
        // Remove the worker's contribution from the project's total hours and sum
        $projet->update([
            'balance' => $balance,
            'charges' => $charges,
        ]);

        $materielProjet->delete();

        return response()->json(['message' => 'MaterielProjet deleted'], 200);
    }

    public function getByProjetId($projetId)
    {
        $materielProjets = MaterielProjet::where('projet_id', $projetId)
            ->with(['materiel' => function($query) {
                $query->select('id', 'title','hourly_rate');
            }])
            ->get();
        $materielProjets->makeHidden(['created_at', 'updated_at']);

        return response()->json($materielProjets, 200);
    }

    public function index()
    {
        $materielProjet = MaterielProjet::all();
        return response()->json($materielProjet, 200);
    }

}
