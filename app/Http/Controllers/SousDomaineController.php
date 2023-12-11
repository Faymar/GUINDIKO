<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSousDomaineRequest;
use App\Http\Requests\UpdateSousDomaineRequest;
use App\Models\Diplome;
use App\Models\Sousdomaine;

class SousDomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sousDomaine = SousDomaine::all();
        return response()->json($sousDomaine);
    }
    public function listeSoudomain($id)
    {
        $sousDomaine = SousDomaine::where('domaine_id', $id);
        return response()->json($sousDomaine);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
        $sousDomaine->domaine_id = $id;
        $sousDomaine->save();
        return response()->json($sousDomaine);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sousdomaine $sousdomaine)
    {
        return response()->json($sousdomaine);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SousDomaine $sousDomaine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Sousdomaine $sousdomaine)
    {
        $sousdomaine->estArchive = true;
        $sousdomaine->update();

        return response()->json($sousdomaine);
    }
}
