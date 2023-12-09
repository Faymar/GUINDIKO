<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="API Commentaire", version="0.1")
 */

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     */

    /**
     * @OA\Post(
     *     path="/api/comment/ajouter",
     *     summary="pour enregistrer un commentaire",
     *     @OA\Response(response="201", description="succes")
     * )
     */
    public function store(StoreCommentaireRequest $request)
    {
        $commentaire = new Commentaire();
        ($request->validated($request->all()));
        $commentaire->contenu = $request->contenu;
        $commentaire->save();
        return response()->json($commentaire);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * @OA\Put(
     *     path="/api/comment/modif/{commentaire}",
     *     summary="pour modifier un commentaire",
     *     @OA\Response(response="201", description="succes")
     * )
     */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
        ($request->validated($request->all()));
        $commentaire->update($request->all());
        return response()->json($commentaire);
    }

    /**
     * Remove the specified resource from storage.
     */



    /**
     * @OA\Put(
     *     path="/api/comment/delete/{commentaire}",
     *     summary="pour supprimer un commentaire",
     *     @OA\Response(response="201", description="succes")
     * )
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->estArchive = true;
        $commentaire->update();
        return response()->json('Commentaire supprimé');
    }
}
