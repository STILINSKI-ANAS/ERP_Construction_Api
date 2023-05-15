<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{
    public function add_company(Request $request){
        $company = new Company();

        $company->name = $request->company_name;
        $company->addresse = $request->company_addresse;
        $company->capital = $request->company_capital;
        $company->RC = $request->company_RC;
        $company->ICE = $request->company_ICE;
        $company->description = $request->company_description;
        $company->phoneNumber = $request->company_phoneNumber;
        $company->email = $request->company_email;


        $company->save();

    }
    public function get_all_companies(){
        $companies = Company::all();
        return response()->json([
            'companies' => $companies
        ],200);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'addresse'=>'required',
            'capital'=>'required',
            'RC'=>'required',
            'ICE'=>'required',
            'description'=>'required',
            'email'=>'required',
            'phoneNumber'=>'required'
        ]);
        return Company::create($request->all());
    }

    public function show (Request $request, $id){
        $stock = Company::find($id);
        return $stock;
    }
    public function index (){
        $stock = Company::all();
        return $stock;
    }
    public function update(Request $request, $id){
        $stock = Company::find($id);
        $stock->update($request->all());
        return $stock;
    }

    public function destroy($id){
        return Company::destroy($id);
    }

    public function search($name){
        return Company::where('name', 'like','%'.$name.'%')->get();
    }
}
