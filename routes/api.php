<?php

use App\Http\Controllers\DiplomeController;
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
//Route for Diplomes
Route::post('ajouterDiplome',[DiplomeController::class,'store']);
Route::get('listerDiplomes', [DiplomeController::class,'index']);
Route::get('afficherDiplome/{id}',[DiplomeController::class,'show']);
Route::patch('modifierDiplome/{id}', [DiplomeController::class,'update']);
Route::patch('supprimerDiplome/{id}', [DiplomeController::class,'destroy']);
