<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomaineRequest;
use App\Http\Requests\UpdateDomaineRequest;
use App\Models\Domaine;
use OpenApi\Annotations as SWG;

/**
 * @SWG\Info(title="Domaine", version="0.1")
 */
class DomaineController extends Controller
{
   
       /**
 * @SWG\Get(
 * path="/listerDomaine",
 *summary="cette route permet de lister tous les domaines qui ne sont pas archivés (supprimer)",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Domaine::where('estArchive', false)->get());
    }

     /**
 * @SWG\Post(
 * path="/ajouterDomaine",
 *summary="cette route permet d'ajouter un domaine",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store(StoreDomaineRequest $request)
    {
        $request->validated($request->all());
        $domaine = new Domaine();
        $domaine->nomDomaine = $request->input('nomDomaine');
        $domaine->image = $request->input('image');
        $domaine->description = $request->input('description');
        $domaine->save();

        return response()->json($domaine);
    }

      /**
 * @SWG\Get(
 * path="/voirDomaine/{domaine}",
 *summary="cette route permet d'afficher une domaine (detail)",
 *@OA\Parameter(
*name="domaine",
*in="path",
*required=true,
*description="domaine qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show(Domaine $domaine)
    {
        return response()->json($domaine);
    }


      /**
 * @SWG\Post(
 * path="/modifierDomaine/{domaine}",
 *summary="cette route permet de modifier une domaine ",
 *@OA\Parameter(
*name="domaine",
*in="path",
*required=true,
*description="domaine qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateDomaineRequest $request, Domaine $domaine)
    {
        $request->validated($request->all());
        $domaine->nomDomaine = $request->input('nomDomaine');
        $domaine->image = $request->input('image');
        $domaine->description = $request->input('description');
        $domaine->update();

        return response()->json($domaine);
    }
  /**
 * @SWG\Get(
 * path="/supprimerDomaine/{domaine}",
 *summary="cette route permet de supprimer (archiver) une domaine ",
 *@OA\Parameter(
*name="domaine",
*in="path",
*required=true,
*description="domaine qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function destroy(Domaine $domaine)
    {
        $domaine->estArchive = true;
        $domaine->update();

        return response()->json($domaine);
    }
}
