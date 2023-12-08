<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemandeRequest;
use App\Http\Requests\UpdateDemandeRequest;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Demande::where('estArchive', false)->get());
    }

    public function demaneMentor()
    {
        return response()->json(Demande::where('userMentor_id',  Auth::user()->id)->get());
    }
    public function demaneMentore()
    {
        return response()->json(Demande::where('userMentore_id', Auth::user()->id)->get());
    }
    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Demande $demande)
    {
        return response()->json($demande);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function accepteDemande(Demande $demande)
    {
        $demande->statut = 'accepter';
        $demande->update();

        return response()->json($demande);
    }
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
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        //
    }
}
