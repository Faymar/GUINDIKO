<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use OpenApi\Annotations as OA;
use Symfony\Contracts\Service\Attribute\Required;

/**
 * @OA\Info(title="API Article", version="0.1")
 */

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('articles.liste');
    }


    public function create()
    {
        return view('articles.article');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * @OA\Post(
     *     path="/api/posts/ajout",
     *     summary="pour enregistrer un article",
     *     @OA\Response(response="201", description="succes")
     * )
     */
    public function store(StoreArticleRequest $request)
    {
        // $request->validate([

        //     'titre' => 'required',
        //     'contenu' => 'required',
        //     'image' => 'required',
        //     'nombreClique' => 'required',
        //     'estArchive' => 'required',
        // ]);

        $article = new Article();
        ($request->validated($request->all()));
        $article->titre = $request->titre;
        $article->contenu = $request->contenu;
        $article->domaine = $request->domaine;
        // $article->image = $request->image;
        // $article->nombreClique = $request->nombreClique;
        // $article->estArchive = $request->estArchive;
        $article->save();
        return response()->json('Article ajouté!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/put/update/{article}",
     *     summary="pour modifier un article",
     *     @OA\Response(response="201", description="succes")
     * )
     */

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated($request->all());

        $article->update($request->all());
        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Put(
     *     path="/api/delete/{article}",
     *     summary="pour supprimer un article",
     *     @OA\Response(response="201", description="succes")
     * )
     */

    public function destroy(Article $article)
    {
        $article->estArchive = true;
        $article->update();
        return response()->json('Donnée supprimées');
    }
}
