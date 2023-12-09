<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

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

    public function ListeNotification()
    {
        $Notifications = Notification::where('user_id', Auth::user()->id)->get();
        return response()->json($Notifications);
    }


    public function NombreNotifications()
    {
        $unreadNotificationsCount = count(Notification::where('user_id', Auth::user()->id)
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
