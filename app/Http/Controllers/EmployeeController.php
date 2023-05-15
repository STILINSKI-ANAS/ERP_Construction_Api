<?php

namespace App\Http\Controllers;

use App\Models\employee;

use Illuminate\Http\Request;

use App\Exports\EmployeesExport;

use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class EmployeeController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'adresse'=>'required',
            'CIN'=>'required',
            'total_brut'=>'required',
            'email'=>'required',
            'phoneNumber'=>'required'
        ]);
        return employee::create($request->all());
    }

    public function show (Request $request, $id){
        $employee = employee::find($id);
        return $employee;
    }
    public function index (){
        $employee = employee::all();
        return $employee;
    }
    public function update(Request $request, $id){
        $employee = employee::find($id);
        $employee->update($request->all());
        return $employee; 
    }

    public function destroy($id){
        return employee::destroy($id); 
    }

    public function search($name){
        return employee::where('name', 'like','%'.$name.'%')->get(); 
    }
    public function export() 
    {
        // return Excel::download(new EmployeesExport, 'emp.xlsx');
        return Excel::store(new EmployeesExport, 'emp.xlsx','excel_uploads');
    }
    public function storeExcel() 
    {
        Excel::store(new EmployeesExport, 'emp.xlsx','excel_uploads');
        $file_path = public_path('uploads/excel/emp.xlsx');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];
        $file_name = 'example.xlsx';
        return response()->download($file_path, $file_name, $headers);
    }

    public function excel(){
        $companies = employee::all();
        return response()->json([
            'companies' => $companies
        ],200);
    }

}
