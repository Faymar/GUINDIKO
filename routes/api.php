<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentaireController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\SousDomaineController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\MessageController;
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

Route::middleware('auth:sanctum')->get('/teste', function (Request $request) {
    $user = Auth::user()->id;
    dd($user);
    // dd(Auth::check());
});

Route::post('/register',  [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::patch('/ModifierProfil/{user}', [UserController::class, 'update']);
    Route::patch('/ModifierMotdePasse/{user}', [UserController::class, 'updatePassword']);
});

Route::post('/ajouterRoles', [RoleController::class, 'store']);
Route::get('/listerRoles', [RoleController::class, 'index']);
Route::get('/voirRoles/{role}', [RoleController::class, 'show']);
Route::patch('/modifierRoles/{role}', [RoleController::class, 'update']);
Route::patch('/supprimerRoles/{role}', [RoleController::class, 'destroy']);

Route::post('/ajouterDomaine', [DomaineController::class, 'store']);
Route::get('/listerDomaine', [DomaineController::class, 'index']);
Route::get('/voirDomaine/{domaine}', [DomaineController::class, 'show']);
Route::patch('/modifierDomaine/{domaine}', [DomaineController::class, 'update']);
Route::patch('/supprimerDomaine/{domaine}', [DomaineController::class, 'destroy']);

Route::post('/ajouterExperience', [ExperienceController::class, 'store'])->middleware('auth:sanctum');
Route::get('/listerExperience', [ExperienceController::class, 'index']);
Route::get('/voirExperience/{experience}', [ExperienceController::class, 'show']);
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
Route::patch('/accepteDemande/{demande}', [DemandeController::class, 'accepteDemande']); //mentor
Route::patch('/refuserDemande/{demande}', [DemandeController::class, 'refuserDemande']); //mentor
Route::patch('/supprimerDemande/{demande}', [DemandeController::class, 'destroy']); //mentore
//Route for Diplomes
Route::post('/ajouterDiplome', [DiplomeController::class, 'store'])->middleware('auth:sanctum');
Route::get('/listerDiplomes', [DiplomeController::class, 'index']);
Route::get('/afficherDiplome/{id}', [DiplomeController::class, 'show']);
Route::patch('/modifierDiplome/{diplome}', [DiplomeController::class, 'update']);
Route::patch('/supprimerDiplome/{diplome}', [DiplomeController::class, 'destroy']);

Route::post('/notifications/create/{id}', [NotificationController::class, 'CreerNotification']);
Route::get('/listeNotification', [NotificationController::class, 'ListeNotification'])->middleware('auth:sanctum');
Route::get('/notifications/count', [NotificationController::class, 'NombreNotifications'])->middleware('auth:sanctum');
Route::get('/supprimeNotification/{notification}', [NotificationController::class, 'destroy']);

//Route For SousDomaine managament
Route::post('/ajouterSousDomaine/{id}', [SousDomaineController::class, 'store']);
Route::get('/listerSousDomaine', [SousDomaineController::class, 'index']);
Route::get('/domaine/listerSousDomaine/{id}', [SousDomaineController::class, 'listeSoudomain']);
Route::get('/afficherSousDomaine/{sousdomaine}', [SousDomaineController::class, 'show']);
Route::patch('/modifierSousDomaine/{sousdomaine}', [SousDomaineController::class, 'update']);
Route::patch('/supprimerSousDomaine/{sousdomaine}', [SousDomaineController::class, 'destroy']);

Route::post('/ajouterArticle', [ArticleController::class, 'store'])->middleware('auth:sanctum');
Route::get('/listerArticles', [ArticleController::class, 'index']);
Route::get('/mentor/listerArticles', [ArticleController::class, 'articleMentore'])->middleware('auth:sanctum');
Route::get('/voirArticles/{article}', [ArticleController::class, 'show']);
Route::patch('/modifierArticles/{article}', [ArticleController::class, 'update']);
Route::patch('/supprimerArticles/{article}', [ArticleController::class, 'destroy']);

Route::get('/listerCommentaire', [CommentaireController::class, 'index']);
Route::post('/commentaire/ajouter/{id}', [CommentaireController::class, 'store'])->middleware('auth:sanctum');
Route::get('/article/listerCommentaire/{id}', [CommentaireController::class, 'ArticleListeCommt']);
Route::patch('/voirCommentaire/{commentaire}', [CommentaireController::class, 'show']);
Route::patch('/modifierCommentaire/{commentaire}', [CommentaireController::class, 'update']);
Route::patch('/supprimerCommentaire/{commentaire}', [CommentaireController::class, 'destroy']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/coversation/{id}', [MessageController::class, 'coversation']);
    Route::post('/envoyerMesage/{id}', [MessageController::class, 'store']);
});
