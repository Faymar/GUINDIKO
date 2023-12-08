<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Evaluation::where('estArchive', false)->get());
    }

    public function EvaluationMentor()
    {
        return response()->json(Evaluation::where('userMentor_id', Auth::user()->id)->get());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request, $userMentor_id)
    {
        $request->validated($request->all());
        $evaluation = new Evaluation();
        $evaluation->note = $request->input('note');
        $evaluation->message = $request->input('message');
        $evaluation->userMentor_id = $userMentor_id;
        $evaluation->userMentore_id = Auth::user()->id;
        $evaluation->save();

        return response()->json($evaluation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        return response()->json($evaluation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
