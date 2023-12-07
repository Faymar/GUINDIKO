<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiplomeRequest;
use App\Http\Requests\UpdateDiplomeRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Diplome;

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
        
        $request->validated($request->all());
        $diplome = Diplome::create($request->all());
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
        $diplome= Diplome::store($request->all());
        return response()->json($diplome);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diplome = Diplome::findOrfail($id);
        $diplome->delete();
    }
}
