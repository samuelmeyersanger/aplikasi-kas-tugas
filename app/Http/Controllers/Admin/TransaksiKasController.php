<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiKas;
use Illuminate\Http\Request;

class TransaksiKasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index()
    {
        $transaksiKas = TransaksiKas::latest()->paginate(15);
        return view('admin.kas.index', compact('transaksiKas'));
    }

    public function create()
    {
        return view('admin.kas.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
        ]);

        TransaksiKas::create($request->all());
        return redirect()->route('admin.kas.index')->with('success', 'Transaksi kas berhasil ditambahkan.');
    }

    public function edit(TransaksiKas $transaksiKas)
    {
        // Ubah nama variabel $transaksiKas menjadi $kas untuk konsistensi di view
        return view('admin.kas.form', ['kas' => $transaksiKas]);
    }

    public function update(Request $request, TransaksiKas $transaksiKas)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
        ]);

        $transaksiKas->update($request->all());
        return redirect()->route('admin.kas.index')->with('success', 'Transaksi kas berhasil diperbarui.');
    }

    public function destroy(TransaksiKas $transaksiKas)
    {
        $transaksiKas->delete();
        return redirect()->route('admin.kas.index')->with('success', 'Transaksi kas berhasil dihapus.');
    }
}