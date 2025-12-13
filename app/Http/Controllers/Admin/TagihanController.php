<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index()
    {
        $tagihans = Tagihan::latest()->paginate(10);
        return view('admin.tagihan.index', compact('tagihans'));
    }

    public function create()
    {
        return view('admin.tagihan.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_tagihan' => 'required|date',
            'batas_pembayaran' => 'required|date|after_or_equal:tanggal_tagihan',
        ]);

        Tagihan::create($request->all());
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dibuat.');
    }

    public function edit(Tagihan $tagihan)
    {
        return view('admin.tagihan.form', compact('tagihan'));
    }

    public function update(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_tagihan' => 'required|date',
            'batas_pembayaran' => 'required|date|after_or_equal:tanggal_tagihan',
        ]);

        $tagihan->update($request->all());
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}