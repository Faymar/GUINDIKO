<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemandeRequest;
use App\Http\Requests\UpdateDemandeRequest;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as SWG;

/**
 * @SWG\Info(title="Demande", version="0.1")
 */
class DemandeController extends Controller
{
             /**
 * @SWG\Get(
 * path="/listeDemanes",
 *summary="cette route permet de lister toutes les demandes",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function index()
    {
        return response()->json(Demande::where('estArchive', false)->get());
    }

         /**
 * @SWG\Get(
 * path="/mentor/listeDemanes",
 *summary="cette route permet de lister toutes les demandes d'un mentor",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function demaneMentor()
    {
        $demandes = Demande::join('users', 'demandes.userMentore_id', '=', 'users.id')
            ->where('userMentor_id', Auth::user()->id)
            ->get();

        return response()->json($demandes);
    }

           /**
 * @SWG\Get(
 * path="/mentore/listeDemanes",
 *summary="cette route permet de lister toutes les demandes qu'un mentoré a fait",

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function demaneMentore()
    {
        $demandes = Demande::join('users', 'demandes.userMentor_id', '=', 'users.id')
            ->where('userMentore_id', Auth::user()->id)
            ->get();

        return response()->json($demandes);
    }
   
      /**
 * @SWG\Post(
 * path="/faireDemande/{id_mentor}",
 *summary="cette route permet d'envoyer une demande à un mentor",
 *@OA\Parameter(
*name="id_mentor",
*in="path",
*required=true,
*description="id_mentor qu'on veut envoyer la demande",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function store($id_mentor)
    {
        $demande = new Demande();
        $demande->userMentor_id = $id_mentor;
        $demande->userMentore_id = Auth::user()->id;
        $demande->save();

        return response()->json($demande);
    }

    /**
 * @SWG\Get(
 * path="/VoirDemande/{demande}",
 *summary="cette route permet d'afficher une demande (detail)",
 *@OA\Parameter(
*name="demande",
*in="path",
*required=true,
*description="demande qu'on veut afficher",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function show(Demande $demande)
    {
        return response()->json($demande);
    }

   
       /**
 * @SWG\Get(
 * path="/accepteDemande/{demande}",
 *summary="cette route permet d'accepter une demande",
 *@OA\Parameter(
*name="demande",
*in="path",
*required=true,
*description="demande qu'on veut accepter",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function accepteDemande(Demande $demande)
    {
        $demande->statut = 'accepter';
        $demande->update();

        return response()->json($demande);
    }


         /**
 * @SWG\Get(
 * path="/refuserDemande/{demande}",
 *summary="cette route permet de refuser une demande ",
 *@OA\Parameter(
*name="demande",
*in="path",
*required=true,
*description="demande qu'on veut refuser",
*@OA\Schema(type="integer")
*),

 *     @SWG\Response(response="200", description="success",)
 * )
 */
    public function refuserDemande(Demande $demande)
    {
        $demande->statut = 'refuser';
        $demande->update();

        return response()->json($demande);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeRequest $request, Demande $demande)
    {
        //
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
    public function destroy(Demande $demande)
    {

        $demande->estArchive = true;
        $demande->update();

        return response()->json("votre demande est annulee avec success");
    }
}
