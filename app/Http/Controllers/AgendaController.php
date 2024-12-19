<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin')->except(['index', 'show']);
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('agendas.show', compact('agenda'));
    }

    public function index()
    {
        $agendas = Agenda::orderBy('start_date', 'asc')
            ->paginate(10);

        return view('agendas.calendar', compact('agendas'));
    }

    public function calendar()
    {
        $agendas = Agenda::select('id', 'title', 'start_date as start', 'end_date as end', 'type')
            ->get()
            ->map(function ($agenda) {
                $colors = [
                    'gotong_royong' => '#4CAF50',
                    'arisan' => '#2196F3',
                    'perayaan' => '#FF9800',
                ];

                return [
                    'id' => $agenda->id,
                    'title' => $agenda->title,
                    'start' => $agenda->start,
                    'end' => $agenda->end,
                    'color' => $colors[$agenda->type] ?? '#9E9E9E',
                ];
            });

        return view('agendas.calendar', compact('agendas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type' => 'required|in:gotong_royong,arisan,perayaan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|max:255',
        ]);

        $validated['created_by'] = Auth::user()->id;

        Agenda::create($validated);

        return redirect()->route('agendas.calendar')
            ->with('success', 'Agenda berhasil dibuat.');
    }

    public function create()
    {
        return view('agendas.create');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('agendas.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'type' => 'required|in:gotong_royong,arisan,perayaan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|max:255',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($validated);

        return redirect()->route('agendas.calendar')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agendas.calendar')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}
