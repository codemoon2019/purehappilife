<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Events\NotificationMessage;

class NotificationController extends Controller
{
    
    public static function createNotification($recipient, $title, $description, $type){


        $data = array([

            'recipient' => $recipient,
            'title' => $title,
            'description' => $description
        
        ]);

        Notification::create([

            'recipient' => $recipient,
            'title' => $title,
            'description' => $description,
            'type' => $type

        ]);

        event(new NotificationMessage($data));

    }

    public function notificationList(){

        $data = Notification::paginate(5);

        return view('incs.notifications', compact('data'));

    }

    public function notificationHeaderList(){

        $data = Notification::orderBy('id', 'DESC')->limit(7)->get();

        return view('incs.notification-header', compact('data'));

    }

}
