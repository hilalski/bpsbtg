<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Models\Menu;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('submenu')->get();
        
        $users = User::all();
    
        return view('dashboard.operator.pegawai.index', [
            'menu' => $menu,
            'users' => $users,
        ]);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::with('submenu')->get();
        
        $users = User::all();
        $roles = Role::all();
    
        return view('dashboard.operator.pegawai.add', [
            'menu' => $menu,
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nip' => 'required|unique:users,nip',
            'username' => 'required|unique:users,username',
            // 'address' => 'nullable',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'role' => 'required',
            'phone_number' => 'required',
            //'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_kepala_unit' => 'nullable',
            'is_tim_keuangan' => 'nullable',
            'is_unit' => 'nullable',
            'is_operator' => 'nullable',
            'is_pbj' => 'nullable',
            'is_ppk' => 'nullable',
        ]);

        // if ($request->hasFile('picture')) {
        //     $filename = $request->file('picture')->hashName();
        //     $request->file('picture')->storeAs('profile_pictures', $filename, 'public');
        //     $validatedData['picture'] = $filename;
        // }

        if ($request->is_kepala_unit == 'on') {
            $validatedData['is_kepala_unit'] = true;
        } else {
            $validatedData['is_kepala_unit'] = false;
        }
    
        if ($request->is_tim_keuangan == 'on') {
            $validatedData['is_tim_keuangan'] = true;
        } else {
            $validatedData['is_tim_keuangan'] = false;
        }

        if ($request->is_unit == 'on') {
            $validatedData['is_unit'] = true;
        } else {
            $validatedData['is_unit'] = false;
        }

        if ($request->is_operator == 'on') {
            $validatedData['is_operator'] = true;
        } else {
            $validatedData['is_operator'] = false;
        }

        if ($request->is_pbj == 'on') {
            $validatedData['is_pbj'] = true;
        } else {
            $validatedData['is_pbj'] = false;
        }

        if ($request->is_ppk == 'on') {
            $validatedData['is_ppk'] = true;
        } else {
            $validatedData['is_ppk'] = false;
        }

        if ($request->is_admin == 'on') {
            $validatedData['is_admin'] = true;
        } else {
            $validatedData['is_admin'] = false;
        }

        $validatedData['password'] = Hash::make($request->password);

         User::create($validatedData);

        //dd($validatedData);
        // if ($request->has('roles')) {
        //     foreach ($request->roles as $role) {
                
        //         $user->assignRole($role);
        //     }
        // }
        
    
        return redirect()->route('operator.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            $menu = Menu::with('submenu')->get();
            $roles = Role::all();
            
            return view('dashboard.operator.pegawai.edit', [
                'menu' => $menu,
                'user' => $user,
                'roles' => $roles
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        {
            $request->validate([
                'phone_number' => 'required|string|max:16',
                'role' => 'required|string|exists:roles,name',
            ]);
    
            $user->phone_number = $request->phone_number;
            $user->role = $request->role;
            $user->save();
    
            return redirect()->route('operator.pegawai.index')->with('success', 'Berhasil memperbarui data Pegawai!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::findOrFail($user);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Delete related records in the users_role table
        DB::table('users_role')->where('user_id', $user->id)->delete();

        // Now delete the user
        $user->delete();

        return redirect('/dashboard/operator/pegawai')->with('success', 'User berhasil dihapus');
    }

}
