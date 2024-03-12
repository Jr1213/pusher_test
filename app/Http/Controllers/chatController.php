<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Chat;
use Illuminate\Http\Request;

class chatController extends Controller
{
    public function index()
    {
        $messages = Chat::with('user')->get();
        return view('chat', compact('messages'));
    }

    public function create(Request $request)
    {
        Chat::create([
            'user_id' => $request->user_id,
            'message' => $request->message
        ]);
        broadcast(new ChatEvent($request->message));
        return redirect()->route('chat.index');
    }
}
