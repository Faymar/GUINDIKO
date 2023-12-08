<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Experience::where('estArchive', false)->get());
    }

    /**
     * Store a newly created resource in storage.
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
        $experience->dateDebut = $request->input('dateDebut');
        $experience->dateFin = $request->input('dateFin');
        $experience->user_id = Auth::user()->id;
        $experience->save();

        return response()->json($experience);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        return response()->json($experience);
    }


    /**
     * Update the specified resource in storage.
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
        $experience->dateDebut = $request->input('dateDebut');
        $experience->dateFin = $request->input('dateFin');
        $experience->update();

        return response()->json($experience);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->estArchive = true;
        $experience->update();

        return response()->json($experience);
    }
}
