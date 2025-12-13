<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tugas = Tugas::latest()->paginate(10);
        return view('admin.tugas.index', compact('tugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'batas_waktu' => 'required|date',
        ]);

        Tugas::create($request->all());
        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tugas)
    {
        return view('admin.tugas.edit', compact('tugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas $tugas)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'batas_waktu' => 'required|date',
        ]);

        $tugas->update($request->all());
        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        // Hapus relasi di tabel pivot sebelum menghapus tugas
        $tugas->users()->detach();
        $tugas->delete();
        
        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }
}