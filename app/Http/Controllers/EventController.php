<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->where('is_active', true)
            ->orderBy('event_date')
            ->paginate(6);

        $pastEvents = Event::where('event_date', '<', now())
            ->orderByDesc('event_date')
            ->paginate(6);

        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function show(Event $event)
    {
        $event->load('department', 'registrations');
        $isRegistered = auth()->check() && $event->userIsRegistered(auth()->user());

        return view('events.show', compact('event', 'isRegistered'));
    }

    public function create()
    {
        $this->authorize('create', Event::class);
        $departments = Department::all();
        return view('events.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'required|string|max:50',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string',
            'registration_deadline' => 'nullable|date',
            'max_participants' => 'nullable|integer|min:1',
            'image' => 'nullable|image|max:2048',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $departments = Department::all();
        return view('events.edit', compact('event', 'departments'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'required|string|max:50',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string',
            'registration_deadline' => 'nullable|date',
            'max_participants' => 'nullable|integer|min:1',
            'image' => 'nullable|image|max:2048',
            'is_public' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function register(Event $event)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to register for events.');
        }

        if (!$event->isRegistrationOpen()) {
            return back()->with('error', 'Registration deadline has passed.');
        }

        if (!$event->hasAvailableSlots()) {
            return back()->with('error', 'Event is fully booked.');
        }

        if ($event->userIsRegistered(auth()->user())) {
            return back()->with('info', 'You are already registered for this event.');
        }

        $event->registrations()->attach(auth()->id());

        return back()->with('success', 'Successfully registered for the event.');
    }

    public function unregister(Event $event)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $event->registrations()->detach(auth()->id());

        return back()->with('success', 'Successfully unregistered from the event.');
    }
}
