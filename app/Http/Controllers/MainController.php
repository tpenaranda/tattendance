<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Guest;

class MainController extends Controller
{
    public function index(Request $request, $token)
    {
        $guest = Guest::where('token', $token)->first();

        if (!$guest) {
            $firstToken = Guest::first()->token;
            return "<pre>Invalid Token!\nA valid token is, for instance: \"$firstToken\"</pre>";
        }

        $guest->notified = true;
        $guest->save();

        return view('index', ['guest' => $guest]);
    }

    public function saveField(Request $request, $field, $userId)
    {
        $guest = Guest::where('id', $userId)->firstOrFail();

        if ($request->guesttoken != $guest->token) {
            return response()->json([
                'status' => 'error',
                'message' => 'User ID does not match User Token!'
            ], 500);
        }

        $guest->$field = ('comment' == $field) ? $request->$field : ('true' == $request->$field);
        $guest->save();

        return response()->json(['name' => $guest->name, 'going' => $guest->going]);
    }

    public function guestslist()
    {
        $guests = Guest::all();
        $viewData = [
            'guests' => $guests,
            'goingCount' => Guest::where('going', true)->count(),
            'nrCount' => Guest::where('need_a_ride', true)->where('going', true)->count(),
        ];

        return view('guestslist', $viewData);
    }

}
