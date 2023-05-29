<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EntrepotController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjetController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register',[\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login',[\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user',[\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('logout',[\App\Http\Controllers\AuthController::class, 'logout']);
    Route::apiResource('entrepot', EntrepotController::class);
    Route::apiResource('client', ClientController::class);
    Route::apiResource('fournisseur', FournisseurController::class);
    Route::apiResource('employee', EmployeeController::class);
    Route::apiResource('projet', ProjetController::class);
    Route::apiResource('utilisation', \App\Http\Controllers\UtilisationController::class);
    Route::apiResource('paiement', \App\Http\Controllers\ClientProjetController::class);
    Route::apiResource('workerProjet', \App\Http\Controllers\WorkerProjetController::class);
    Route::apiResource('materielProjet', \App\Http\Controllers\MaterielProjetController::class);
    Route::apiResource('worker', \App\Http\Controllers\WorkerController::class);
    Route::apiResource('materiel', \App\Http\Controllers\MaterielController::class);
    Route::get('/utilisation/getByProjetId/{id}',[\App\Http\Controllers\UtilisationController::class,'getByProjetId'] );

});

//Route::post('/add_company',[CompanyController::class,'add_company']);
//Route::get('/get_all_companies',[CompanyController::class,'get_all_companies']);

//Route::get('/entrepot/search/{name}',[EntrepotController::class,'search'] );
//Route::resource('entrepot', EntrepotController::class);

//Route::get('/company/search/{name}',[CompanyController::class,'search'] );
//Route::resource('company', CompanyController::class);
//
//Route::get('/client/search/{name}',[ClientController::class,'search'] );
//Route::resource('client', ClientController::class);
//
//Route::get('/fournisseur/search/{name}',[FournisseurController::class,'search'] );
//Route::resource('fournisseur', FournisseurController::class);
//
//Route::get('/employee/excel',[EmployeeController::class,'storeExcel'] );
//Route::get('/employee/search/{name}',[EmployeeController::class,'search'] );
//Route::resource('employee', EmployeeController::class);
//
//Route::get('/projet/search/{name}',[ProjetController::class,'search'] );
//Route::get('/projet/generatePDF',[ProjetController::class,'generatePDF'] );
//Route::resource('projet', ProjetController::class);

//Route::get('/commande/search/{name}',[ProjetController::class,'search'] );
//Route::resource('commande', \App\Http\Controllers\CommandeController::class);
//
//Route::get('/utilisation/getOfProject/{id}',[\App\Http\Controllers\UtilisationController::class,'getOfProject'] );
//Route::get('/utilisation/getByProjetId/{id}',[\App\Http\Controllers\UtilisationController::class,'getByProjetId'] );
//Route::resource('utilisation', \App\Http\Controllers\UtilisationController::class);
//
Route::get('/paiement/getByProjetId/{id}',[\App\Http\Controllers\ClientProjetController::class,'getByProjetId'] );
//Route::resource('paiement', \App\Http\Controllers\ClientProjetController::class);
//
Route::get('/workerProjet/getByProjetId/{id}',[\App\Http\Controllers\WorkerProjetController::class,'getByProjetId'] );
//Route::resource('workerProjet', \App\Http\Controllers\WorkerProjetController::class);
//
Route::get('/materielProjet/getByProjetId/{id}',[\App\Http\Controllers\MaterielProjetController::class,'getByProjetId'] );
//Route::resource('materielProjet', \App\Http\Controllers\MaterielProjetController::class);

Route::get('/materielProjet/getByProjetId/{id}',[\App\Http\Controllers\MaterielProjetController::class,'getByProjetId'] );
//Route::resource('worker', \App\Http\Controllers\WorkerController::class);

Route::get('/materielProjet/getByProjetId/{id}',[\App\Http\Controllers\MaterielProjetController::class,'getByProjetId'] );
//Route::resource('materiel', \App\Http\Controllers\MaterielController::class);
