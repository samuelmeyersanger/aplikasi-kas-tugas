<?php

namespace App\Http\Controllers\Admin;

// Baris ini WAJIB ada dan benar
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Pembayaran;
use App\Models\TransaksiKas;

// Nama kelas HARUS 'extends Controller'
class DashboardController extends Controller
{
    // Constructor ini sekarang akan berfungsi dengan benar
    public function __construct()
    {
        // Middleware ini akan melindungi semua method di dalam controller ini
        $this->middleware(['auth', 'verified', 'role:Admin']);
    }

    public function index()
    {
        $totalMahasiswa = User::role('Mahasiswa')->count();
        $pembayaranMenunggu = Pembayaran::where('status', 'menunggu')->count();
        $totalPemasukan = TransaksiKas::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = TransaksiKas::where('jenis', 'pengeluaran')->sum('jumlah');
        
        return view('admin.dashboard', compact('totalMahasiswa', 'pembayaranMenunggu', 'totalPemasukan', 'totalPengeluaran'));
    }
}