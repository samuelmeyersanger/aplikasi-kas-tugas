<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\TransaksiKas; // <-- TAMBAHKAN BARIS INI
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index()
    {
        // Menampilkan semua pembayaran, bisa difilter berdasarkan status
        $pembayarans = Pembayaran::with('user', 'tagihan')->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Menampilkan detail pembayaran untuk verifikasi.
     */
    public function show(Pembayaran $pembayaran)
    {
        // Load relasi user dan tagihan
        $pembayaran->load('user', 'tagihan');
        return view('admin.pembayaran.verify', compact('pembayaran'));
    }

    /**
     * Memperbarui status pembayaran (verifikasi).
     */
    public function update(Request $request, Pembayaran $pembayaran)
{
    $request->validate([
        'status' => 'required|in:terverifikasi,ditolak',
        'catatan_verifikasi' => 'nullable|string|max:255',
    ]);

    // Ambil status lama sebelum diupdate
    $statusLama = $pembayaran->status;

    // Update status pembayaran
    $pembayaran->update($request->only('status', 'catatan_verifikasi'));

    // --- LOGIKA INTEGRASI OTOMATIS ---
    // Jika status baru adalah 'terverifikasi' dan status lama BUKAN 'terverifikasi'
    if ($request->status === 'terverifikasi' && $statusLama !== 'terverifikasi') {
        // Buat transaksi kas pemasukan secara otomatis
        TransaksiKas::create([
            'jenis' => 'pemasukan',
            'jumlah' => $pembayaran->jumlah_dibayar,
            'keterangan' => 'Pembayaran kas dari ' . $pembayaran->user->name . ' untuk tagihan ' . $pembayaran->tagihan->judul,
            'tanggal_transaksi' => now()->format('Y-m-d'),
        ]);
    }

    $message = $pembayaran->status == 'terverifikasi' ? 'Pembayaran berhasil diverifikasi dan kas dicatat.' : 'Pembayaran ditolak.';
    
    return redirect()->route('admin.pembayaran.index')->with('success', $message);
}
}