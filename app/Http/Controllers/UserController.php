<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showImportForm()
    {
        return view('users.import');
    }
    public function processImport(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt|max:10240'
    ]);

    $file = $request->file('csv_file');
    $path = $file->getRealPath();

    $csv = \League\Csv\Reader::createFromPath($path, 'r');
    $csv->setHeaderOffset(0); // Set baris pertama sebagai header

    $successCount = 0;
    $failedRows = [];

    foreach ($csv->getRecords() as $i => $record) {
        try {
            $user = User::create([
                'name' => $record['name'],
                'email' => $record['email'],
                'NIM' => $record['NIM'],
                'prodi' => $record['prodi'],
                'password' => Hash::make($record['password']),
                'email_verified_at' => now(),
            ]);
            $successCount++;
        } catch (\Exception $e) {
            $failedRows[] = [
                'row' => $i + 2,
                'data' => $record,
                'errors' => [$e->getMessage()]
            ];
        }
    }

    return redirect()->back()->with([
        'success' => "Import selesai! $successCount user berhasil diimport.",
        'failedRows' => $failedRows,
        'totalFailed' => count($failedRows)
    ]);
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'NIM' => 'required|string|max:50|unique:users,NIM',
            'phone' => 'required|string|max:20',
            'prodi' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin', // Misal cuma 'user' atau 'admin'
        ]);

        User::create([
            'name' => $request->name,
            'NIM' => $request->NIM,
            'phone' => $request->phone,
            'prodi' => $request->prodi,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'has_voted' => false,
            'current_team_id' => null,
            'profile_photo_path' => null,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'NIM' => 'required|string|max:50|unique:users,NIM,' . $user->id,
            'phone' => 'required|string|max:20',
            'prodi' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $user->name = $request->name;
        $user->NIM = $request->NIM;
        $user->phone = $request->phone;
        $user->prodi = $request->prodi;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
