<?php

namespace App\Http\Controllers;

use App\Models\CandidatesTeam;
use App\Models\CandidatesTeamMember;
use App\Models\Election;
use App\Models\Elections;
use Illuminate\Http\Request;

class ElectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemilus = Elections::all();
        return view('elections.index', compact(['pemilus']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('elections.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        Elections::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('pemilu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $pemilu = Elections::with('candidates.members.user')->findOrFail($id);

        // dd($pemilu->members);
        return view('elections.show', compact('pemilu'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemilu = Elections::findOrFail($id);
        return view('elections.edit', compact('pemilu'));
    }


    public function update(Request $request, string $id)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pemilu = Elections::findOrFail($id);
        $pemilu->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('pemilu.index')->with('success', 'Pemilu berhasil diperbarui!');
    }
    public function destroy(string $id)
    {
        $pemilu = Elections::findOrFail($id);
        $pemilu->delete();
        return redirect()->route('pemilu.index')->with('success', 'Pemilu berhasil dihapus!');
    }
}
