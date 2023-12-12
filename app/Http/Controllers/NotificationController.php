<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Notification API", version="1", description  = " notifications  ")
 */

class NotificationController extends Controller
{

 /**
 * @OA\Post(
 *   path="/notifications/create/{id}",
 *   summary="Cette route permet d'envoyer un message",
 *   @OA\Parameter(
 *      name="id",
 *      in="path",
 *      required=true,
 *      description="ID de l'utilisateur à qui envoyer le message",
 *      @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(response="200", description="success"),
 * )
 */

    public function CreerNotification(Request $request, $id)
    {


        // dd($request);
        $request->validate([
            'contenu' => 'required',
        ]);

        $Notification = new Notification([
            'contenu' => $request->input('contenu'),
            'user_id' => $id
        ]);

        $Notification->save();
        return response()->json(['success', 'Votre Notification a été bien envoyer']);
    }

       /**
 * @OA\Get(
 * path="/listeNotification",
 *summary="cette route permet de lister toutes les notification",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function ListeNotification()
    {
        $Notifications = Notification::where('user_id', Auth::user()->id)->get();
        return response()->json($Notifications);
    }

     /**
 * @OA\Get(
 * path="/notifications/count",
 *summary="cette route permet de donner le nombre de notification",

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function NombreNotifications()
    {
        $unreadNotificationsCount = count(Notification::where('user_id', Auth::user()->id)
            ->where('estlu', false)->get());
        return response()->json($unreadNotificationsCount);
    }

   /**
 * @OA\Get(
*path="/supprimeNotification/{notification}",
 *summary="cette route permet de supprimer une notification",
 *@OA\Parameter(
*name="notification",
*in="path",
*required=true,
*description="notification qu'on veut supprimer",
*@OA\Schema(type="integer")
*),

 *     @OA\Response(response="200", description="success",)
 * )
 */
    public function destroy(Notification $notification)
    {
        $notification->estArchive = true;
        $notification->update();
        return response()->json('notification supprimée');
    }
}
