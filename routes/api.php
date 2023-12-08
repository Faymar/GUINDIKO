<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentaireController;
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

Route::get('/ajouter', [ArticleController::class, 'create']);
Route::get('/api', [ArticleController::class, 'index']);
Route::post('/posts/ajout', [ArticleController::class, 'store']);
Route::put('/put/update/{article}', [ArticleController::class, 'store']);
Route::put('/delete/{article}', [ArticleController::class, 'destroy']);

Route::post('/comment/ajouter', [CommentaireController::class, 'store']);
Route::put('/comment/modif/{commentaire}', [CommentaireController::class, 'update']);
Route::put('/comment/delete/{commentaire}', [CommentaireController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route for Diplomes
Route::post('ajouterDiplome', [DiplomeController::class, 'store']);
Route::get('listerDiplomes', [DiplomeController::class, 'index']);
Route::get('afficherDiplome/{id}', [DiplomeController::class, 'show']);
Route::patch('modifierDiplome/{id}', [DiplomeController::class, 'update']);
Route::patch('supprimerDiplome/{id}', [DiplomeController::class, 'destroy']);

Route::post('/notifications/create/{id}', [NotificationController::class, 'CreerNotification']);

Route::get('/notifications', [NotificationController::class, 'ListeNotification']);

Route::get('/notifications/count', [NotificationController::class, 'NombreNotifications']);

Route::get('/SupprimeNotification', [NotificationController::class, 'destroy']);
