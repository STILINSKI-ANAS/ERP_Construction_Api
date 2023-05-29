<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\utilisation;
use App\Models\Worker;
use App\Models\WorkerProjet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WorkerProjetController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projet_id' => 'required|exists:projets,id',
            'worker_id' => 'required|exists:workers,id',
            'hours' => 'required|numeric',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $worker = Worker::find($request->worker_id);
        $somme = $worker->hourly_rate* $request->hours;
        $sommeO = DB::table('projet_workers')->where('projet_id', $request->projet_id)->sum('somme');
        $workerProjetData = [
            'projet_id' => $request->projet_id, // replace with the actual projet_id value
            'worker_id' => $request->worker_id,
            'somme' => $somme,
            'hours' => $request->hours,
        ];
        //        return response()->json($sommeO, 201);
        $workerProjet = WorkerProjet::create($workerProjetData);

        $projet = Projet::find($request->projet_id);
        $sommeN = DB::table('projet_workers')->where('projet_id', $request->projet_id)->sum('somme');
        $charges = $projet->charges + $somme;
        $balance = $projet->produits - $charges;
        $projet->update([
            'balance' => $balance,
            'charges' => $charges,
        ]);

        return response()->json($workerProjet, 201);
    }

    public function show(Request $request, $id)
    {
        $workerProjet = WorkerProjet::find($id);
        $workerProjet->makeHidden(['created_at', 'updated_at']);
        $workerProjet->projet->makeHidden(['created_at', 'updated_at']);
        $workerProjet->worker->makeHidden(['created_at', 'updated_at']);
        return $workerProjet;
    }

    public function update(Request $request, $id)
    {
        $workerProjet = WorkerProjet::find($id);
        $oldSomme = $workerProjet->somme;
        if (!$workerProjet) {
            return response()->json(['error' => 'WorkerProjet not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'projet_id' => 'exists:projets,id',
            'hours' => 'required|numeric',
            'somme' => '',
            // add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $projet = Projet::find($workerProjet->projet_id);

        $hourlyRate = Worker::find($workerProjet->worker_id)->hourly_rate;
//        somme,  charges, balance
        $newSomme = $request->hours * $hourlyRate;

        $workerProjet->update(array_merge(
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

        return response()->json($workerProjet, 200);
    }

    public function destroy($id)
    {
        $workerProjet = WorkerProjet::find($id);

        if (!$workerProjet) {
            return response()->json(['message' => 'WorkerProjet not found.'], 404);
        }

        $projet = Projet::find($workerProjet->projet_id);

        $charges = $projet->charges - $workerProjet->somme;
        $balance = $projet->produits - $charges;
        // Remove the worker's contribution from the project's total hours and sum
        $projet->update([
            'balance' => $balance,
            'charges' => $charges,
        ]);

        $workerProjet->delete();

        return response()->json(['message' => 'WorkerProjet deleted.'], 200);
    }

    public function getByProjetId($projetId)
    {
        $workerProjets = WorkerProjet::where('projet_id', $projetId)
            ->with(['worker' => function($query) {
                $query->select('id', 'title', 'hourly_rate');
            }])
            ->get();
        $workerProjets->makeHidden(['created_at', 'updated_at']);

        return response()->json($workerProjets, 200);
    }

    public function index()
    {
        $workerProjet = WorkerProjet::all();
        return response()->json($workerProjet, 200);
    }

}
