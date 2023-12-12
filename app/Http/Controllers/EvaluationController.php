<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as SWG;


/**
 * @SWG\Info(title="Evaluation", version="0.1")
 */
class EvaluationController extends Controller
{
        /**
 * @SWG\Get(
 * path="/listerEvaluation",
 *summary="cette route permet de lister toutes les evaluations qui ne sont pas archivés (supprimer)",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Evaluation::where('estArchive', false)->get());
    }

        /**
 * @SWG\Get(
 * path="/EvaluationMentor",
 *summary="cette route permet d'evaluer un mentor (supprimer)",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function EvaluationMentor()
    {
        return response()->json(Evaluation::where('userMentor_id', Auth::user()->id)->get());
    }
   
    
       /**
 * @SWG\Post(
 * path="ajouterEvaluation/{userMentor_id}",
 *summary="cette route permet d'ajouter une evaluation pour un mentor donné'",
 *@OA\Parameter(
*name="userMentor_id",
*in="path",
*required=true,
*description="userMentor_id mentor qu'on veut evaluer",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store(StoreEvaluationRequest $request, $userMentor_id)
    {
        $request->validated($request->all());
        $evaluation = new Evaluation();
        $evaluation->note = $request->input('note');
        $evaluation->message = $request->input('message');
        $evaluation->userMentor_id = $userMentor_id;
        $evaluation->userMentore_id = Auth::user()->id;
        $evaluation->save();

        return response()->json($evaluation);
    }

    /**
 * @SWG\Get(
 * path="/voirEvaluation/{evaluation}",
 *summary="cette route permet d'afficher une evaluation (detail)",
 *@OA\Parameter(
*name="evaluation",
*in="path",
*required=true,
*description="evaluation qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show(Evaluation $evaluation)
    {
        return response()->json($evaluation);
    }

}
