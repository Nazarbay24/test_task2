<?php

namespace App\Http\Controllers;

use App\Jobs\SendPush;
use http\Env\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    public function addUser(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'rating' => 'required|numeric'
        ]);

        if(Redis::zadd('users', $request->rating, $request->id)) {
            return response()->json([
                'message' => 'success'
            ]);
        }
    }

    public function getTop()
    {
        $list = Redis::zrevrange('users', 0, 9, 'WITHSCORES');

        return response()->json([
            'list' => $list
        ]);
    }

    public function sendPush(Request $request)
    {
        $request->validate([
            'to' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);

        SendPush::dispatch($request);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
