<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;
use OpenApi\Annotations as SWG;



/**
 * @SWG\Info(title="Article", version="0.1")
 */
class ArticleController extends Controller
{
    /**
 * @SWG\Get(
 * path="/listerArticles",
 *summary="cette route permet de lister ses aticles",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Article::where('estArchive', false)->get());
    }

      /**
 * @SWG\Get(
 * path="/mentor/listerArticles",
 *summary="cette route permet à un mentor de lister tous ses aticles",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function articleMentore()
    {
        return response()->json(
            Article::where('estArchive', false)
                ->where('user_id', Auth::user()->id)
                ->get()
        );
    }


       /**
 * @SWG\Post(
 * path="/ajouterArticle",
 *summary="cette route permet d'ajouter un article",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store(StoreArticleRequest $request)
    {
        $request->validated($request->all());
        $article = new Article();

        $imagePath = $request->file('image')->store('images/diplome', 'public');
        $article->image = $imagePath;

        $article->titre = $request->titre;
        $article->contenu = $request->contenu;
        $article->domaine = $request->domaine;
        $article->user_id = Auth::user()->id;
        $article->save();

        return response()->json('Article ajouté!!!', $article);
    }

         /**
 * @SWG\Get(
 * path="/voirArticles/{article}",
 *summary="cette route permet d'afficher un article (detail)",
 *@OA\Parameter(
*name="article",
*in="path",
*required=true,
*description="id de l'article qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show(Article $article)
    {
        $nombreClique = $article->nombreClique + 1;
        $article->nombreClique = $nombreClique;
        $article->update();

        return response()->json($article);
    }


   
        /**
 * @SWG\Post(
 * path="/modifierArticles/{article}",
 *summary="cette route permet de modifier un article ",
 *@OA\Parameter(
*name="article",
*in="path",
*required=true,
*description="id de l'article qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated($request->all());
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images/diplome', 'public');
            $article->image = $imagePath;
        }
        $article->titre = $request->titre;
        $article->contenu = $request->contenu;
        $article->domaine = $request->domaine;
        $article->update();
        return response()->json($article);
    }

       /**
 * @SWG\Get(
 * path="/supprimerArticles/{article}",
 *summary="cette route permet de supprimer (archiver) un article ",
 *@OA\Parameter(
*name="article",
*in="path",
*required=true,
*description="article qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function destroy(Article $article)
    {
        $article->estArchive = true;
        $article->update();
        return response()->json('Donnée supprimées');
    }
}
