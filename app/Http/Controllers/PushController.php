<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePushNotification;
use Illuminate\Http\Request;
use App\Notifications\WebPushNotification;
use App\User;
use Auth;
use Notification;

class PushController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store the PushSubscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePushNotification $request)
    {
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Auth::user();

        $res = $user->updatePushSubscription($endpoint, $key, $token);
        return response()->json(['success' => true, 'data' => $res], 200);
    }


    /**
     * Send Push Notifications to all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function push(Request $request)
    {
//        dd($request->all(), $id);
        $webPushNotification = new WebPushNotification($request);
//        return $webPushNotification;
        $user = \Users\Models\User::find(1);
//        if ($user)
            $res = $user->notify($webPushNotification);
        return response()->json(['success' => true, 'data' => $user, 'res' => $res], 200);
    }

}
