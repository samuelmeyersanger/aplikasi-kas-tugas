<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Menggunakan validated() dari Form Request untuk keamanan
        $validatedData = $request->validated();

        // Jika email tidak berubah, kita perlu menghilangkan aturan unique dari validasi
        // karena Laravel akan selalu memvalidasi unikness, bahkan jika nilainya sama.
        if ($request->user()->email === $validatedData['email']) {
            unset($validatedData['email']);
        }

        // Logika khusus untuk Mahasiswa
        if ($request->user()->hasRole('Mahasiswa')) {
            // Jika NIM tidak berubah, hapus dari validasi untuk masalah yang sama seperti email
            if ($request->user()->nim === $validatedData['nim']) {
                unset($validatedData['nim']);
            }
        }

        // Mengisi dan menyimpan data
        $request->user()->fill($validatedData);

        // Reset email_verified_at jika email berubah
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}