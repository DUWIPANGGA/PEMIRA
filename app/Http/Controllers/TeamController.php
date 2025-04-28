<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Elections;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CandidatesTeam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CandidatesTeamMember;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $users = User::all();
        $pemilu = Elections::find($request->query('id'))->first();
        return view('candidate.create', compact(['users', 'pemilu']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $picturePath = null;

            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $picturePath = $file->storeAs('candidate-pictures/'.$request->events_id, $filename, 'public');
            }

            $team = CandidatesTeam::create([
                'events_id' => $request->events_id,
                'name' => $request->name,
                'slogan' => $request->slogan,
                'vision' => $request->vision,
                'mission' => $request->mission,
                'picture' => $picturePath,
            ]);
            $ketua = User::find($request->ketua)->first();
            $wakilKetua = User::find($request->wakilketua)->first();
            
            // dd($ketua.$request->wakilketua);
            CandidatesTeamMember::create([
                'candidates_team_id' => $team->id,
                'user_id' => $ketua->id,
                'position' => 'ketua'
            ]);

            CandidatesTeamMember::create([
                'candidates_team_id' => $team->id,
                'user_id' => $wakilKetua->id,
                'position' => 'wakil ketua'
            ]);

            DB::commit();

            return redirect()->route('pemilu.show', $request->events_id) ->with('success', 'berhasil menambahkan data');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan data tim kandidat: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return redirect()->route('pemilu.show', $request->events_id)->with('error', 'gagal menambahkan data');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $users = User::all();
    $candidate = CandidatesTeam::with('members.user')->find($id);

    $ketua = $candidate->members->firstWhere('position', 'ketua')?->user_id;
    $wakil = $candidate->members->firstWhere('position', 'wakil ketua')?->user_id;

    return view('candidate.edit', compact('candidate', 'users', 'ketua', 'wakil'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {
        $candidate = CandidatesTeam::with('members')->findOrFail($id);

        // Cek dan simpan gambar baru jika ada
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $picturePath = $file->storeAs('candidate-pictures/' . $request->events_id, $filename, 'public');
            $candidate->picture = $picturePath;
        }

        // Update data kandidat
        $candidate->update([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'vision' => $request->vision,
            'mission' => $request->mission,
        ]);

        // Update ketua
        $candidate->members()->updateOrCreate(
            ['position' => 'ketua'],
            ['user_id' => $request->ketua]
        );

        // Update wakil ketua
        $candidate->members()->updateOrCreate(
            ['position' => 'wakil ketua'],
            ['user_id' => $request->wakilketua]
        );

        DB::commit();

        return redirect()->route('pemilu.show', $request->events_id)->with('success', 'Data kandidat berhasil diperbarui');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Gagal mengupdate data kandidat: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
