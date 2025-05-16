<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAttendees;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //shows all upcoming events//
    public function index(Request $request)
    {
        $events = Event::all();

        return Inertia::render(
            'User/Events/Index',      ///shows all available events
            [
                'events' => $events
            ]
        );
    }

    /**
     * Shows the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return Inertia::render(
            'User/Events/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //stores events//
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'date_of_event' => 'required|date|after_or_equal:today|before:' . Carbon::now()->addYears(10)->format('Y-m-d'), 
            'time_start' => 'required|date_format:H:i|check_past_time:' . $request->date_of_event,
            'time_end' => 'required|date_format:H:i|after:time_start',
            'venue' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    
        $messages = [
            'image.mimes' => 'Only JPG, PNG, JPEG, GIF, or SVG formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
            'date_of_event.after_or_equal' => 'The event date must be today or a future date.', 
            'date_of_event.before' => 'The event date cannot be more than 10 years in the future.', 
            'time_start.date_format' => 'The time start must be in HH:MM format (e.g., 11:30).',
            'time_end.date_format' => 'The time end must be in HH:MM format (e.g., 12:30).',
            'time_end.after' => 'The time end must be after the time start.',
            'time_start.check_past_time' => 'The event time cannot be in the past for today\'s date.',

        ];
    
        // applying image validation if a new image is being uploaded
        if ($request->hasFile('image')) {
            $rules['image'] = 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048';
            $messages['image.image'] = 'The file must be a valid JPG, PNG, JPEG, GIF, or SVG image.';
        }
    
        $request->validate($rules, $messages);
    
    
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images', 'public');
        }
    
        $user = auth()->user()->id;
    
        Event::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'description' => $request->description,
            'date_of_event' => $request->date_of_event,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'venue' => $request->venue,
            'image' => $image_path,
            'user_id' => $user
        ]);
    
        return redirect()->route('events.index')->with('message', 'Event Created Successfully');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //shows details of an event and the attendees//
    public function show(Event $event)
    {
        $eventId = $event->id;  

        $eventAttendees = EventAttendees::where('event_id', '=', $eventId)->count();

        return Inertia::render(
            'User/Events/Show',
            
            [
                'event' => $event,
                'eventAttendees' => $eventAttendees,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //editing the event details//
    public function edit(Event $event)
    {
        return Inertia::render(
            'User/Events/Edit',
            [
                'event' => $event
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //updates the event details//
    public function update(Request $request, Event $event)
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'date_of_event' => 'required|date|after_or_equal:today|before:' . Carbon::now()->addYears(10)->format('Y-m-d'), 
            'time_start' => 'required|date_format:H:i|check_past_time:' . $request->date_of_event, 
            'time_end' => 'required|date_format:H:i|after:time_start',
            'venue' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    
        $messages = [
            'image.mimes' => 'Only JPG, PNG, JPEG, GIF, or SVG formats are allowed.',
            'image.max' => 'The image must not be larger than 2MB.',
            'date_of_event.after_or_equal' => 'The event date must be today or a future date.', 
            'date_of_event.before' => 'The event date cannot be more than 10 years in the future.',
            'time_start.date_format' => 'The time start must be in HH:MM format (e.g., 11:30).',
            'time_end.date_format' => 'The time end must be in HH:MM format (e.g., 12:30).',
            'time_end.after' => 'The time end must be after the time start.',
            'time_start.check_past_time' => 'The event time cannot be in the past for today\'s date.',
        ];
    
        // Applying image validation if a new image is being uploaded
        if ($request->hasFile('image')) {
            $rules['image'] = 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048';
            $messages['image.image'] = 'The file must be a valid JPG, PNG, JPEG, GIF, or SVG image.';
        }
    
        $request->validate($rules, $messages);
    
    
        $event->title = $request->title;
        $event->slug = \Str::slug($request->slug);
        $event->description = $request->description;
        $event->date_of_event = $request->date_of_event;
        $event->time_start = $request->time_start;
        $event->time_end = $request->time_end;
        $event->venue = $request->venue;
    
        if ($request->hasFile('image')) {
            // Deletes old image if it exists
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }
            $event->image = $request->file('image')->store('image', 'public'); 
        }
    
        $event->save();
        sleep(1);
    
        return redirect()->route('events.index')->with('message', 'Event Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    //
    public function destroy(Event $event): \Illuminate\Http\RedirectResponse
    {
        // Check if the authenticated user is the event owner
        if (auth()->id() !== $event->user_id) {
            return back()->withErrors(['message' => 'You are not authorized to delete this event.']);
        }

        // Deletes the associated image if it exists
        if ($event->image) {
            Storage::delete('public/' . $event->image);
        }

        
        $event->delete();
        sleep(1); 

       
        return redirect()->route('events.index')->with('message', 'Event Deleted Successfully');
    }

//reserving ticket function is called ///
    public function eventAttendees(Request $request, Event $event)
    {
        $event = new EventAttendees();
        $event->title = $request->title;
        $event->event_id = $request->id;
        $event->user_id = auth()->user()->id;    
        $event->save();

        return redirect()->route('events.index')->with('message', 'Event Booked Successfully');
    }
//reserving/display the tickets for event/
    public function tickets(Request $request)
    {
        $user = auth()->user()->id;

        $eventAttendees = EventAttendees::where('user_id', '=', $user)->get();

        return Inertia::render(
            'User/Events/MyTickets',
            [
                'eventAttendees' => $eventAttendees,
            ]
        );
    }

    

}
