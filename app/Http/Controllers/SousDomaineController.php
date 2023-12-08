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
    public function store(StoreSousDomaineRequest $request)
    {
        $request->validated($request->all());
        $sousDomaine = new Sousdomaine();
        $sousDomaine->nomSousDomaine = $request->input('nomSousDomaine');
        $sousDomaine->image = $request->input('image');
        $sousDomaine->description = $request->input('description');
        $sousDomaine-> save();
        return response()->json($sousDomaine);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sousDomaine = SousDomaine::find($id);

        return response()->json($sousDomaine);
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
        $sousdomaine->nomSousDomaine = $request->input('nomSousDomaine');
        $sousdomaine->image = $request->input('image');
        $sousdomaine->description = $request->input('description');
        $sousdomaine->update();
        // $sousdomaine->update($request->all());
        return response()->json($sousdomaine);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diplome = SousDomaine::findOrfail($id);
        $diplome->delete();
    }
}
