<?php

use App\Http\Controllers\SousDomaineController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route For SousDomaine managament

Route::post('ajouterSousDomaine',[SousDomaineController::class,'store']);
Route::get('listerSousDomaine', [SousDomaineController::class,'index']);
Route::get('afficherSousDomaine/{sousdomaine}',[SousDomaineController::class,'show']);
Route::patch('modifierSousDomaine/{sousdomaine}', [SousDomaineController::class,'update']);
Route::patch('supprimerSousDomaine/{sousdomaine}', [SousDomaineController::class,'destroy']);