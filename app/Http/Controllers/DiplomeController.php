<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiplomeRequest;
use App\Http\Requests\UpdateDiplomeRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Diplome;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as SWG;


/**
 * @SWG\Info(title="Diplome", version="0.1")
 */
class DiplomeController extends Controller
{
          /**
 * @SWG\Get(
 * path="/listerDiplomes",
 *summary="cette route permet de lister tous les diplomes",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        $diplome = Diplome::all();
        return response()->json($diplome);
    }

     /**
 * @SWG\Post(
 * path="/ajouterDiplome",
 *summary="cette route permet d'ajouter un diplome",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store(StoreDiplomeRequest $request)
    {
        // user_id
        $request->validated($request->all());
        $diplome = new Diplome();

        if ($request->file('fichier')) {
            $fichierPath = $request->file('fichier')->store('fichiers/diplome', 'public');
            $diplome->fichier = $fichierPath;
        }
        $diplome->libele =  $request->get('libele');
        $diplome->description = $request->get('description');
        $diplome->dateObtention = $request->get('dateObtention');
        $diplome->user_id = Auth::user()->id;
        $diplome->save();
        return response()->json($diplome);
    }

      /**
 * @SWG\Get(
 * path="/afficherDiplome/{id}",
 *summary="cette route permet d'afficher un diplome (detail)",
 *@OA\Parameter(
*name="id",
*in="path",
*required=true,
*description="id du diplome qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show($id)
    {
        $diplome = Diplome::find($id);

        return response()->json($diplome);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diplome $diplome)
    {
        //
    }

       /**
 * @SWG\Post(
 * path="/modifierDiplome/{diplome}",
 *summary="cette route permet de modifier une diplome ",
 *@OA\Parameter(
*name="diplome",
*in="path",
*required=true,
*description="diplome qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateDiplomeRequest $request, Diplome $diplome)
    {
        $request->validated($request->all());

        if ($request->file('fichier')) {
            $fichierPath = $request->file('fichier')->store('fichiers/diplome', 'public');
            $diplome->fichier = $fichierPath;
        }
        $diplome->libele =  $request->get('libele');
        $diplome->description = $request->get('description');
        $diplome->dateObtention = $request->get('dateObtention');
        $diplome->update();
        // $diplome->update($request->all());
        return response()->json($diplome);
    }

    /**
 * @SWG\Get(
 * path="/supprimerDiplome/{diplome}",
 *summary="cette route permet de supprimer (archiver) un diplome ",
 *@OA\Parameter(
*name="diplome",
*in="path",
*required=true,
*description="diplome qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function destroy(Diplome $diplome)
    {
        $diplome->estArchive = true;
        $diplome->update();

        return response()->json($diplome);
    }
}
