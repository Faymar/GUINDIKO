<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="Messagerie (chat)", version="0.1")
 */
class MessageController extends Controller
{  
    /**
    * @OA\Post(
    * path="/envoyerMesage/{id}",
   *summary="cette route permet d'envoyer un message",
   *@OA\Parameter(
   *name="id",
   *in="path",
   *required=true,
   *description="ID de l'utilisateur qu'on envoie le message (destinataire)",
   *@OA\Schema(type="integer")
   *),
    *     @OA\Response(response="200", description="success",)
    * )
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
    * @OA\Post(
    * path="/coversation/{id}",
   *summary="cette route permet de lister toutes les conversations ",
   *@OA\Parameter(
   *name="id",
   *in="path",
   *required=true,
   *description="ID de l'utilisateur a qui on a discuté",
   *@OA\Schema(type="integer")
   *),
    *     @OA\Response(response="200", description="success",)
    * )
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
