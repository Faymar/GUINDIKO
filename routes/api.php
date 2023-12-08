<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentaireController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\SousDomaineController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\RoleController;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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



// Route::middleware('auth:sanctum', 'estMentor')->get('/teste', function (Request $request) {
//     $user = Auth::user()->role()->first();
//     dd($user->nomRole);
//     // dd(Auth::check());
// });

Route::post('/register',  [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::post('/ajouterRoles', [RoleController::class, 'store']);
Route::get('/listerRoles', [RoleController::class, 'index']);
Route::get('/voirRoles/{role}', [RoleController::class, 'show']);
Route::patch('/modifierRoles/{role}', [RoleController::class, 'update']);
Route::patch('/supprimerRoles/{role}', [RoleController::class, 'destroy']);


Route::get('/listerDomaine', [DomaineController::class, 'index']);
Route::get('/voirDomaine/{domaine}', [DomaineController::class, 'show']);
Route::post('/ajouterDomaine', [DomaineController::class, 'store']);
Route::patch('/modifierDomaine/{domaine}', [DomaineController::class, 'update']);
Route::patch('/supprimerDomaine/{domaine}', [DomaineController::class, 'destroy']);

Route::get('/listerExperience', [ExperienceController::class, 'index']);
Route::get('/voirExperience/{experience}', [ExperienceController::class, 'show']);
Route::post('/ajouterExperience', [ExperienceController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/modifierExperience/{experience}', [ExperienceController::class, 'update']);
Route::patch('/supprimerExperience/{experience}', [ExperienceController::class, 'destroy']);

Route::get('/listerEvaluation', [EvaluationController::class, 'index']);
Route::get('/EvaluationMentor', [EvaluationController::class, 'EvaluationMentor'])->middleware('auth:sanctum', 'estMentor');
Route::get('/voirEvaluation/{evaluation}', [EvaluationController::class, 'show']);
Route::post('/ajouterEvaluation/{userMentor_id}', [EvaluationController::class, 'store'])->middleware('auth:sanctum', 'estMentore');

Route::post('/faireDemande/{id_mentor}', [DemandeController::class, 'store'])->middleware('auth:sanctum', 'estMentore');
Route::get('/listeDemanes', [DemandeController::class, 'index']); //admin
Route::get('/mentore/listeDemanes', [DemandeController::class, 'demaneMentore'])->middleware('auth:sanctum', 'estMentore'); //mentore
Route::get('/mentor/listeDemanes', [DemandeController::class, 'demaneMentor'])->middleware('auth:sanctum', 'estMentor'); //mentor
Route::get('/VoirDemande/{demande}', [DemandeController::class, 'show']); //mentore
Route::patch('/accepteDemande/{demande}', [DemandeController::class, 'accepteDemande']); //mentore
Route::patch('/refuserDemande/{demande}', [DemandeController::class, 'refuserDemande']); //mentore
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

//Route For SousDomaine managament

Route::post('ajouterSousDomaine',[SousDomaineController::class,'store']);
Route::get('listerSousDomaine', [SousDomaineController::class,'index']);
Route::get('afficherSousDomaine/{sousdomaine}',[SousDomaineController::class,'show']);
Route::patch('modifierSousDomaine/{sousdomaine}', [SousDomaineController::class,'update']);
Route::patch('supprimerSousDomaine/{sousdomaine}', [SousDomaineController::class,'destroy']);