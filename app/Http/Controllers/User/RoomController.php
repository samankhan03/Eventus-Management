<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewChatMessageEvent;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //returns all studyrooms//
    public function index()
    {
        return Inertia::render('User/ChatRooms/Index', [      //Returning views in resources/pages
            'rooms' => Room::get()                              //Returning views in .index page with different studyrooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //creates studyroom//
    public function create()
    {
        return Inertia::render(
            'User/ChatRooms/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    //after creating the studyroom, it stores the studyroom details//
    public function store(Request $request, Room $room)
{
    $request->validate([
        'body' => 'required|string|max:1000'
    ]);

    $message = $room->messages()->create([
        'body' => $request->body,
        'user_id' => auth()->id()
    ]);

    broadcast(new NewChatMessageEvent($message, auth()->user()))->toOthers();

    return back();
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    //passing the room and the messages inside the studyrooms//
    public function show(Room $room)
    {
        $messages = Message::where('room_id', $room->id)
            ->with('user')
            ->oldest()
            ->get();          //obtains messages from the database
        return Inertia::render('User/ChatRooms/Show', [
            'room' => $room,
            'messages' => $messages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    //shows the active members in the studyroom
    public function update(Request $request, Room $room)
    {
        $user = auth()->user();
    
        // Ensures user is not already in the room before joining
        if (!$user->rooms->contains($room)) {
            $user->rooms()->attach($room);  // Adds user to the room
            $room->increment('active');  // Increments active member count
        }
    
        // Fetches the messages for the room
        $messages = Message::where('room_id', $room->id)
            ->with('user')
            ->oldest()
            ->get();
    
        return Inertia::render('User/ChatRooms/Show', [
            'room' => $room,
            'messages' => $messages,
        ]);
    }
    
    

    //if you leave the studyroom it will update the active members
    public function roomLogout(Request $request, Room $room)
    {
        $user = auth()->user();
    
        // Ensures the user is actually in the room before leaving
        if ($user->rooms->contains($room)) {
            $user->rooms()->detach($room);  // Removes user from the room
            $room->decrement('active');  // Decrements active member count
        }
    
        return redirect()->route('chat-rooms.index');
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
    //shows the room that has been created//
    public function newroom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:rooms,slug', 
        ]);

        Room::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->slug),
        ]);
        sleep(1);

        return redirect()->route('chat-rooms.index')->with('message', 'Chat Room Created Successfully');
    }
}
