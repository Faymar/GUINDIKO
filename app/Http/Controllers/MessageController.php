<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request, $id)
    {
        $request->validated($request->all());

        $message = new Message();

        if ($request->file('fichier')) {
            $fichierPath = $request->file('fichier')->store('fichiers/message', 'public');
            $message->fichier = $fichierPath;
        }

        $message->contenu = $request->input('contenu');
        $message->userRec_id  = $id;
        $message->userEnv_id =  Auth::user()->id;
        $message->save();
        return response()->json(['Message success', $message]);
    }

    /**
     * Display the specified resource.
     */
    public function coversation($id)
    {
        $user = User::findOrFail($id);
        $conversation = Message::where(function ($query) use ($id) {
            $query->where('userEnv_id', Auth::user()->id)
                ->where('userRec_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('userEnv_id', $id)
                ->where('userRec_id', Auth::user()->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([$conversation, $user]);
    }
}
