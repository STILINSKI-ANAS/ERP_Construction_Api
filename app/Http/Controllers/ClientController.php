<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;

class ClientController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'adress'=>'required',
            'CIN'=>'required',
            'balance'=>'required',
            'email'=>'required',
            'phoneNumber'=>'required'
        ]);
        return Client::create($request->all());
    }

    public function show (Request $request, $id){
        $client = Client::find($id);
        return $client;
    }
    public function index (){
        $client = Client::all();
        return $client;
    }
    public function update(Request $request, $id){
        $client = Client::find($id);
        $client->update($request->all());
        return $client; 
    }

    public function destroy($id){
        return Client::destroy($id); 
    }

    public function search($name){
        return Client::where('name', 'like','%'.$name.'%')->get(); 
    }
}
