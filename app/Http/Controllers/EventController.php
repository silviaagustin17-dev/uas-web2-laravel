<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Alamat model harus ada di sini!

class EventController extends Controller
{
    public function index() {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function store(Request $request) {
        Event::create($request->all());
        return redirect()->route('event.index');
    }

    public function edit($id) {
        $event = Event::findOrFail($id); // Variabel namanya $event
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id) {
        $event = Event::findOrFail($id);
        $event->update($request->all());
        return redirect()->route('event.index');
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();
        return redirect()->route('event.index');
    }
}