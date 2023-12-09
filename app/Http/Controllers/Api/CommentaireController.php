<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Commentaire::where('estArchive', false)->get());
    }
    public function ArticleListeCommt($id)
    {
        return response()->json(
            Commentaire::where('estArchive', false)
                ->where('article_id', $id)
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        return response()->json($commentaire);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
        $request->validated($request->all());

        $commentaire->update($request->all());
        return response()->json($commentaire);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->estArchive = true;
        $commentaire->update();
        return response()->json('Commentaire supprimé');
    }
}
