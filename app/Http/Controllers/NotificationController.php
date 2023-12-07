<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

class NotificationController extends Controller
{

    public function CreerNotification(HttpRequest $request, $id)
    {

        // dd($request);
        $request->validate([
            'contenue' => 'required',
        ]);
       
        $Notification= new Notification([
            'contenue' => $request->input('contenue'),
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
            ->where('lu', false)->get());
            return response()->json($unreadNotificationsCount);

        }






}
