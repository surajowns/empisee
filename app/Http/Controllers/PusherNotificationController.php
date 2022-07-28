<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\User;
use Auth;

class PusherNotificationController extends Controller
{
    public function  __construct() {
          $this->middleware('CheckSession');

       }

    public function sendNotification(Request $request ){
        auth()->user()->update(['fcm_token'=>$request->token]);
        return response()->json(['token saved successfully.']);

    }
     
    public function sendNotifications(Request $request)
    {  
        $url='https://fcm.googleapis.com/fcm/send';
        $firebaseToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
          
        $SERVER_API_KEY ='AAAA7MRnEiQ:APA91bGKhmneJd6KOut7t2pFQxQubAWVglh5tYEE81TL2KI8Va3SPlftjWt5G4UmkKLoI8H4PsfkLmVx8fPu_eFMxgwrgALnXC4xn72t_-HQmqQiIpih1CWWPyFPFjFd2GUn_LevGPzw';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" =>'Notification Send',
                "body" => 'Login Successfully',  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        curl_close($ch);

        // FCM response
        dd($response);  
    }

    
}
