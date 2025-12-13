<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Mahasiswa']);
    }

    public function index()
    {
        // Ambil semua tagihan, lalu muat pembayaran yang terkait dengan user yang login
        $tagihans = Tagihan::with(['pembayarans' => function($query) {
            $query->where('user_id', Auth::id());
        }])->latest()->get();

        return view('mahasiswa.pembayaran.index', compact('tagihans'));
    }

    public function store(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:dana,gopay,transfer',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maks 2MB
        ]);

        // Cek apakah user sudah pernah bayar tagihan ini dan statusnya 'terverifikasi'
        $sudahBayar = Pembayaran::where('user_id', Auth::id())
                                ->where('tagihan_id', $tagihan->id)
                                ->where('status', 'terverifikasi')
                                ->exists();

        if ($sudahBayar) {
            return redirect()->back()->with('error', 'Anda sudah melakukan pembayaran untuk tagihan ini.');
        }

        // Simpan file bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('payments', 'public');

        Pembayaran::create([
            'user_id' => Auth::id(),
            'tagihan_id' => $tagihan->id,
            'jumlah_dibayar' => $tagihan->jumlah,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            'status' => 'menunggu',
        ]);

        // **Trigger Notifikasi Real-time ke Admin**
        // broadcast(new \App\Events\NewPaymentReceived($pembayaran))->toOthers();

        return redirect()->route('mahasiswa.pembayaran.index')->with('success', 'Bukti pembayaran berhasil diunggah dan menunggu verifikasi.');
    }
}