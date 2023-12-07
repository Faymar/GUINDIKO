<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;


class NotificationController extends Controller
{

    public function CreerNotification(Request $request, $id)
    {

       // dd($request);
        $request->validate([
            'contenu' => 'required',
        ]);
       
        $Notification= new Notification([
            'contenu' => $request->input('contenu'),
            'user_id' => $id
        ]);
      
        $Notification->save();
        return response()->json(['success', 'Votre Notification a été bien envoyer']);
    }

    public function ListeNotification()
    {
        
        $user_id = auth()->user()->id;
        $Notifications = Notification::where('user_id', $user_id)->get();
        return response()->json($Notifications);
    }


    public function NombreNotifications()
    {
        $unreadNotificationsCount = count(Notification::where('user_id', auth()->user()->id)
            ->where('estlu', false)->get());
            return response()->json($unreadNotificationsCount);

        }


        public function destroy(Notification $notification)
        {
            $notification->estArchive = true;
            $notification->update();
            return response()->json('notification supprimée');
        }



}
