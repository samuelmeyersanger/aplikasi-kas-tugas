<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index()
    {
        $mahasiswas = User::role('Mahasiswa')->latest()->paginate(10);
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('admin.mahasiswa.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nim' => 'required|string|max:20|unique:users,nim',
            'jurusan' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
        ]);

        $user->assignRole('Mahasiswa');

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(User $mahasiswa)
    {
        // Pastikan yang diedit adalah mahasiswa
        if (!$mahasiswa->hasRole('Mahasiswa')) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'User bukan mahasiswa.');
        }
        return view('admin.mahasiswa.form', compact('mahasiswa'));
    }

    public function update(Request $request, User $mahasiswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $mahasiswa->id,
            'nim' => 'required|string|max:20|unique:users,nim,' . $mahasiswa->id,
            'jurusan' => 'required|string|max:255',
        ]);

        $mahasiswa->update($request->only('name', 'email', 'nim', 'jurusan'));

        if ($request->filled('password')) {
            $request->validate(['password' => 'required|string|min:8|confirmed']);
            $mahasiswa->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(User $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}