<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\projet;

class ProjetController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name'=>'',
            'addresse'=>'',
        ]);
        return projet::create(array_merge($request->all(),
            ['name' => 'noName'],
            ['charges'=>0],
            ['produits'=>0],
            ['balance'=>0]));
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
    public function generatePDF()
    {
//        $data = [1,2,3];
        Pdf::setOption(['dpi' => 10, 'defaultFont' => 'Inter', 'debugCss' =>true]);
        $pdf = Pdf::loadView('pdf.facture')->setWarnings(false);
        return $pdf->download('Hi.pdf');
//        return 1;
    }
}
