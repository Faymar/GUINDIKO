<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomaineRequest;
use App\Http\Requests\UpdateDomaineRequest;
use App\Models\Domaine;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Domaine::where('estArchive', false)->get());
    }


    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Domaine $domaine)
    {
        return response()->json($domaine);
    }


    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->estArchive = true;
        $domaine->update();

        return response()->json($domaine);
    }
}
