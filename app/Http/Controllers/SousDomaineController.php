<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSousDomaineRequest;
use App\Http\Requests\UpdateSousDomaineRequest;
use App\Models\Diplome;
use App\Models\Sousdomaine;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="SousDomaine", version="0.1")
 */
class SousDomaineController extends Controller
{
         /**
 * @OA\Get(
 * path="/listerSousDomaine",
 *summary="cette route permet de voir la liste des sous_domaines",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        $sousDomaine = SousDomaine::all();
        return response()->json($sousDomaine);
    }
  /**
 * @OA\Get(
 * path="/domaine/listerSousDomaine/{id}",
 *summary="cette route permet de lister tous les sous_domaines d'un domaine donne",
 *@OA\Parameter(
*name="id",
*in="path",
*required=true,
*description="id du domaine qu'on veut lister ses sous_domaines",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function listeSoudomain($id)
    {
        $sousDomaine = SousDomaine::where('domaine_id', $id)->get();
        return response()->json($sousDomaine);
    }



   /**
 * @OA\Post(
 * path="/ajouterSousDomaine/{id}",
 *summary="cette route permet d'ajouter un sous_domaine à un domaine donne",
 *@OA\Parameter(
*name="id",
*in="path",
*required=true,
*description="id du domaine qu'on veut ajouter un sous_domaine",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function store(StoreSousDomaineRequest $request, $id)
    {
        $request->validated($request->all());

        $sousDomaine = new Sousdomaine();

        if ($request->file('image')) {
            $fichierPath = $request->file('image')->store('fichiers/sousDomaine', 'public');
            $sousDomaine->image = $fichierPath;
        }
        $sousDomaine->nomSousDomaine = $request->input('nomSousDomaine');
        $sousDomaine->description = $request->input('description');
        $sousDomaine->image = $request->get('image');
        $sousDomaine->domaine_id = $id;
        $sousDomaine->save();
        return response()->json($sousDomaine);
    }

     
    /**
 * @OA\Get(
 * path="/afficherSousDomaine/{sousdomaine}",
 *summary="cette route permet d'afficher un sous-domaine (detail)",
 *@OA\Parameter(
*name="sousdomaine",
*in="path",
*required=true,
*description="sousdomaine qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function show(Sousdomaine $sousdomaine)
    {
        return response()->json($sousdomaine);
    }

    /**
 * @OA\Post(
 * path="/modifierSousDomaine/{sousdomaine}",
 *summary="cette route permet de modifier un sous-domaine ",
 *@OA\Parameter(
*name="sousdomaine",
*in="path",
*required=true,
*description="sousdomaine qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateSousDomaineRequest $request,   Sousdomaine $sousdomaine)
    {
        $request->validated($request->all());
        if ($request->file('image')) {
            $fichierPath = $request->file('image')->store('fichiers/sousDomaine', 'public');
            $sousdomaine->image = $fichierPath;
        }
        $sousdomaine->nomSousDomaine = $request->input('nomSousDomaine');
        $sousdomaine->description = $request->input('description');
        $sousdomaine->update();
        // $sousdomaine->update($request->all());
        return response()->json($sousdomaine);
    }

    /**
 * @OA\Get(
 * path="/supprimerSousDomaine/{sousdomaine}",
 *summary="cette route permet de supprimer (archiver) un sous-domaine ",
 *@OA\Parameter(
*name="sousdomaine",
*in="path",
*required=true,
*description="sousdomaine qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function destroy(Sousdomaine $sousdomaine)
    {
        $sousdomaine->estArchive = true;
        $sousdomaine->update();

        return response()->json($sousdomaine);
    }
}
