<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as SWG;


/**
 * @SWG\Info(title="experience", version="0.1")
 */
class ExperienceController extends Controller
{
       /**
 * @SWG\Get(
 * path="/listerExperience",
 *summary="cette route permet de lister toutes les experiences",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Experience::where('estArchive', false)->get());
    }

     /**
 * @SWG\Post(
 * path="/ajouterExperience",
 *summary="cette route permet d'ajouter une experience",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store(StoreExperienceRequest $request)
    {
        $request->validated($request->all());

        $experience = new Experience();

        if ($request->file('fichier')) {
            $fichierPath = $request->file('fichier')->store('fichiers/experience', 'public');
            $experience->fichier = $fichierPath;
        }
        $experience->titre = $request->input('titre');
        $experience->description = $request->input('description');
        $experience->entreprise = $request->input('entreprise');
        $experience->tache = $request->input('tache');
        $experience->fichier = $request->get('fichier');
        $experience->dateDebut = $request->input('dateDebut');
        $experience->dateFin = $request->input('dateFin');
        $experience->user_id = Auth::user()->id;
        $experience->save();

        return response()->json($experience);
    }

    /**
 * @SWG\Get(
 * path="/voirExperience/{experience}",
 *summary="cette route permet d'afficher une experience (detail)",
 *@OA\Parameter(
*name="experience",
*in="path",
*required=true,
*description="experience qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show(Experience $experience)
    {
        return response()->json($experience);
    }

   /**
 * @SWG\Post(
 * path="'/modifierExperience/{experience}",
 *summary="cette route permet de modifier une experience ",
 *@OA\Parameter(
*name="experience",
*in="path",
*required=true,
*description="experience qu'on veut modifier",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $request->validated($request->all());

        if ($request->file('fichier')) {
            $fichierPath = $request->file('fichier')->store('fichiers/experience', 'public');
            $experience->fichier = $fichierPath;
        }

        $experience->titre = $request->input('titre');
        $experience->description = $request->input('description');
        $experience->entreprise = $request->input('entreprise');
        $experience->tache = $request->input('tache');
        $experience->fichier = $request->get('fichier');
        $experience->dateDebut = $request->input('dateDebut');
        $experience->dateFin = $request->input('dateFin');
        $experience->update();

        return response()->json($experience);
    }

   
    /**
 * @SWG\Get(
 * path="/supprimerExperience/{experience}",
 *summary="cette route permet de supprimer (archiver) une experience ",
 *@OA\Parameter(
*name="experience",
*in="path",
*required=true,
*description="experience qu'on veut supprimer (archiver)",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function destroy(Experience $experience)
    {
        $experience->estArchive = true;
        $experience->update();

        return response()->json($experience);
    }
}
