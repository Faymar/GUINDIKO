<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiplomeRequest;
use App\Http\Requests\UpdateDiplomeRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Diplome;
use Illuminate\Support\Facades\Auth;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diplome = Diplome::all();
        return response()->json($diplome);
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
    public function store(StoreDiplomeRequest $request)
    {
        // user_id
        $request->validated($request->all());
        $diplome = new Diplome();

        // if ($request->file('fichier')) {
        //     $fichierPath = $request->file('fichier')->store('fichiers/diplome', 'public');
        //     $diplome->fichier = $fichierPath;
        // }
        $diplome->libele =  $request->get('libele');
        $diplome->description = $request->get('description');
        $diplome->fichier = $request->get('fichier');
        $diplome->dateObtention = $request->get('dateObtention');
        $diplome->user_id = Auth::user()->id;
        $diplome->save();
        return response()->json($diplome);
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(UpdateDiplomeRequest $request, Diplome $diplome)
    {
        $request->validated($request->all());

        // if ($request->file('fichier')) {
        //     $fichierPath = $request->file('fichier')->store('fichiers/diplome', 'public');
        //     $diplome->fichier = $fichierPath;
        // }
        $diplome->libele =  $request->get('libele');
        $diplome->description = $request->get('description');
        $diplome->fichier = $request->get('fichier');
        $diplome->dateObtention = $request->get('dateObtention');
        $diplome->update();
        // $diplome->update($request->all());
        return response()->json($diplome);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diplome $diplome)
    {
        $diplome->estArchive = true;
        $diplome->update();

        return response()->json($diplome);
    }
}
