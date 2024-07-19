<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME)->with('status.success', 'Berhasil Login, Selamat Datang ' . Auth::user()->name . '!');

        try {
            $request->authenticate();
    
            $request->session()->regenerate();

            $user = auth()->user();
    
            // Tampilkan pesan sukses sebelum berpindah halaman

            $namaUser = $user->name;

            // Pesan selamat datang yang sesuai
            $pesanSelamatDatang = 'Berhasil Login, Selamat Datang ' . $namaUser . '!';

            // Log pesan selamat datang
            Log::info($pesanSelamatDatang);
    
            return redirect()->intended(RouteServiceProvider::HOME)->with('status.success', $pesanSelamatDatang);
        } catch (Exception $e) {
            // Log pesan error
            Log::error($e->getMessage());
            return redirect()->back()->with('status.error', 'NIP atau Password tidak valid');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
