<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rooms = Room::all();
        return view('chat', ['rooms' => $rooms]);
    }

    public function show(Room $room)
    {
        $messages = $room->messages()->with(['user'])->latest()->get();
        return view('chat.room', ['room' => $room, 'messages' => $messages]);
    }
}
