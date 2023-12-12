<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as SWG;


/**
 * @SWG\Info(title="Commentaire", version="0.1")
 */
class CommentaireController extends Controller
{
               /**
 * @SWG\Get(
 * path="/listerCommentaire",
 *summary="cette route permet de lister ses commentaires",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Commentaire::where('estArchive', false)->get());
    }
    
      /**
 * @SWG\Get(
 * path="/article/listerCommentaire/{id}",
 *summary="cette route permet de liste tous ses commentaires sur un article",
 *@OA\Parameter(
*name="id",
*in="path",
*required=true,
*description="id de l'article qu'on veut lister ses commentaires",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function ArticleListeCommt($id)
    {
        return response()->json(
            Commentaire::where('estArchive', false)
                ->where('article_id', $id)
                ->get()
        );
    }

    
     /**
 * @SWG\Post(
 * path="/commentaire/ajouter/{id}",
 *summary="cette route permet d'envoyer un commentaire sur un article",
 *@OA\Parameter(
*name="id",
*in="path",
*required=true,
*description="id de l'article qu'on veut envoyer un commentaire",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store(StoreCommentaireRequest $request, $id)
    {
        $request->validated($request->all());

        $commentaire = new Commentaire();
        $commentaire->contenu = $request->contenu;
        $commentaire->article_id = $id;
        $commentaire->user_id = Auth::user()->id;

        $commentaire->save();
        return response()->json($commentaire);
    }

      /**
 * @SWG\Get(
 * path="/voirCommentaire/{commentaire}",
 *summary="cette route permet d'afficher un commentaire (detail)",
 *@OA\Parameter(
*name="commentaire",
*in="path",
*required=true,
*description="commentaire qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show(Commentaire $commentaire)
    {
        return response()->json($commentaire);
    }


   
      /**
 * @SWG\Post(
 * path="/modifierCommentaire/{commentaire}",
 *summary="cette route permet de modifier un commentaire ",
 *@OA\Parameter(
*name="commentaire",
*in="path",
*required=true,
*description="commentaire qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
        $request->validated($request->all());

        $commentaire->update($request->all());
        return response()->json($commentaire);
    }

    
     /**
 * @SWG\Get(
 * path="/supprimerCommentaire/{commentaire}",
 *summary="cette route permet de supprimer (archiver) un commentaire ",
 *@OA\Parameter(
*name="commentaire",
*in="path",
*required=true,
*description="commentaire qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->estArchive = true;
        $commentaire->update();
        return response()->json('Commentaire supprimé');
    }
}
