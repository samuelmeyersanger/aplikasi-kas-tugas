<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Mahasiswa']);
    }

    public function index()
    {
        // Ambil semua tugas dan cek status penyelesaian untuk user yang login
        $tugas = Tugas::with(['users' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->latest()->get();

        return view('mahasiswa.tugas.index', compact('tugas'));
    }

    public function complete(Request $request, Tugas $tugas)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'submission_link' => 'nullable|url'
        ]);

        $user = Auth::user();
        $filePath = null;
        $submissionLink = $request->input('submission_link');

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('task_submissions', 'public');
        }

        // Gunakan syncWithoutDetaching untuk mencegah duplikasi
        // PERHATIKAN: Kita menggunakan variabel $tugas->id, bukan $t->id
        $user->tugas()->syncWithoutDetaching([$tugas->id => [
            'waktu_selesai' => now(),
            'file_path' => $filePath,
            'submission_link' => $submissionLink,
        ]]);

        return redirect()->back()->with('success', 'Tugas ditandai sebagai selesai.');
    }
}