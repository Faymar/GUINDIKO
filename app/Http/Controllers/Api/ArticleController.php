<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Article::where('estArchive', false)->get());
    }

    public function articleMentore()
    {
        return response()->json(
            Article::where('estArchive', false)
                ->where('user_id', Auth::user()->id)
                ->get()
        );
    }


    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $nombreClique = $article->nombreClique + 1;
        $article->nombreClique = $nombreClique;
        $article->update();

        return response()->json($article);
    }


    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->estArchive = true;
        $article->update();
        return response()->json('Donnée supprimées');
    }
}
