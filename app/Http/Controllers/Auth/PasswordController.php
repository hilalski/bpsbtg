<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    // public function update(Request $request): RedirectResponse
    // {
    //     $validated = $request->validateWithBag('updatePassword', [
    //         'current_password' => ['required', 'current_password'],
    //         'password' => ['required', Password::defaults(), 'confirmed'],
    //         'password_confirmation' => 'required_with:password|same:password'
    //     ]);

        
    //     $request->user()->update([
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     dd($request->user());

    //     return back()->with('status.success', 'Password Berhasil Diubah!');
    // }

    public function update(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:4|confirmed',
    ]);

    $user = auth()->user();

    // Verifikasi password lama
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama tidak cocok']);
    }

    // Update password baru
    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('status', 'Password berhasil diubah');
}
}
