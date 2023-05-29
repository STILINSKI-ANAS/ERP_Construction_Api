<?php

namespace App\Http\Controllers;

use App\Models\worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = worker::all();
        return response()->json($workers, 200);
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'hourly_rate'=>'required',
        ]);
        return worker::create($request->all());
    }
    public function update(Request $request, $id){
        $worker = worker::find($id);
        $worker->update($request->all());
        return $worker;
    }
    public function destroy($id){
        return worker::destroy($id);
    }
    public function show (Request $request, $id){
        $worker = worker::find($id);
        return $worker;
    }


}
