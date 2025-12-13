<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Mahasiswa']);
    }

    public function index()
    {
        $user = Auth::user();

        // Hitung tugas yang belum selesai
        $tugasBelumSelesai = $user->tugas()->wherePivotNull('waktu_selesai')->count();
        
        // Hitung pembayaran yang sedang menunggu verifikasi
        $pembayaranMenunggu = $user->pembayarans()->where('status', 'menunggu')->count();

        // Ambil tagihan yang belum dibayar atau statusnya menunggu
        $tagihanList = \App\Models\Tagihan::with(['pembayarans' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();
        
        $tagihanBelumBayar = $tagihanList->filter(function($tagihan) {
            // Dianggap belum bayar jika tidak ada pembayaran sama sekali, atau pembayarannya masih 'menunggu'/'ditolak'
            return $tagihan->pembayarans->isEmpty() || !$tagihan->pembayarans->contains('status', 'terverifikasi');
        })->count();

        return view('mahasiswa.dashboard', compact('tugasBelumSelesai', 'pembayaranMenunggu', 'tagihanBelumBayar'));
    }
}