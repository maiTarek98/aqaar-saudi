<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\GeneralSettings;
trait FcmFirebase {

    public function sendFcmNotification($user_token= null , $data = [])
    {
                //old integration
        // // $SERVER_API_KEY = env('FIREBASEAPIKEY');
        // $SERVER_API_KEY = 'AAAAMcBBEMk:';
        // $send_data = [
        //         "to" => '/topics/alerts',
        //         "notification"     => [
        //             "title"        => $data['title'],
        //             "body"         => $data['text'],
        //             "sound"        => true,
        //         ],
        //         "data"             => $data['data']
        // ];

        // $dataEncode = json_encode($send_data);
        // $headers = [
        //     'Authorization: key=' . $SERVER_API_KEY,
        //     'Content-Type: application/json',
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncode);
        // $response = curl_exec($ch);


        $fcm = $user_token;
        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }
         $setting=app(GeneralSettings::class); 
        $title = $data['title'];
        $description = $data['text'];
        $account_type = null;
        $notification_type = (string) $data['data']['notification_type'];
        $projectId = config('services.fcm.project_id'); # INSERT COPIED PROJECT ID

        $credentialsFilePath = public_path('firebase_credentials.json');
    //   dd($credentialsFilePath);
// dd($data['data']['account_type'],$data);
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $sound ="default";
        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];
        $data = [
            "message" => [
                "token" => $fcm,
                "notification" => [
                    "title" => $title,
                    "body" => $description,
                   
                    
                ],
                'android' => [
                    'notification' => [ 'sound' => 'default'  ,   "icon"=>url('/storage/').$setting->logo, ] ,
                    "data" => [
                        "click_action" => "https://faskhangy.com/admin/dashboard" // Click action for Android
                    ]
                ],
                'apns' => [ 'payload' => [ 'aps' => [ 'sound' => 'default'  ,   "icon"=>url('/storage/').$setting->logo, ] ] ],
                "data" => [
                    "notification_type" => $notification_type,
                    "account_type"  => $account_type,
                     "click_action"=> "https://faskhangy.com/admin/dashboard",
                     "icon"=>url('/storage/').$setting->logo,
                    ],
                
            ]
        ];
        $payload = json_encode($data);
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
    //  dd($response);
        curl_close($ch);

        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
     }
}