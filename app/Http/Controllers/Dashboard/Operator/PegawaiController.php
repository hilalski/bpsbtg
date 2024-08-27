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
        $roles = Role::all();
    
        return view('dashboard.operator.pegawai.index', [
            'menu' => $menu,
            'users' => $users,
            'roles' => $roles,
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
        'password' => 'required|confirmed',
        'password_confirmation' => 'required_with:password|same:password',
        'role' => 'required',
        'phone_number' => 'required',
    ]);

    $validatedData['password'] = Hash::make($request->password);

    // Create new user
    $user = User::create($validatedData);

    // Assuming $request->role contains the role name
    $role = Role::where('name', $request->role)->first();

    // Link the user with the selected role
    $user->roles()->attach($role->id);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:16',
            'role' => 'required|string|exists:roles,name',
        ]);

        // Update user data
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        
        // Get the selected role
        $role = Role::where('name', $request->role)->first();

        // Detach all roles except role with ID 3 (pegawai)
        $user->roles()->detach();

        // Attach the new role
        $user->roles()->attach($role->id);

        // Save user changes
        $user->save();

        return redirect()->route('operator.pegawai.index')->with('success', 'Berhasil memperbarui data Pegawai!');
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

        // Hapus semua izin yang terkait dengan user
        DB::table('izins')->where('user_id', $user->id)->delete();

        // Hapus data di tabel users_role
        DB::table('users_role')->where('user_id', $user->id)->delete();

        // Hapus user
        $user->delete();

        return redirect('/dashboard/operator/pegawai')->with('success', 'User berhasil dihapus');
    }

}
