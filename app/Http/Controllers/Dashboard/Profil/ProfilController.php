<?php

namespace App\Http\Controllers\Dashboard\Profil;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfilController extends Controller
{
    /**
     * Display the user's profile form.
     * 
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $menu = Menu::with('submenu')->get();
        return view('dashboard.profil.index', [
            'menu' => $menu,
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * 
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('picture')) {
            $filename = $request->file('picture')->hashName();
            $request->file('picture')->storeAs('profile_pictures', $filename, 'public');
            $user->picture = $filename;
            $user->save();
        }

        $user->save();

        return Redirect::route('profil.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
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
