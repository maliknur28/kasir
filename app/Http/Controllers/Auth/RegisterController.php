<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Petugas')->paginate(5);

        return view('pages.auth.register', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:12|max:12',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'status' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status
        ]);

        Alert::toast('Petugas berhasil disimpan', 'success');
        return back();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->filled('password')) {

            $request->validate([
                'password' => 'required|min:6|confirmed',
                'status' => 'required'
            ]);
    
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
    
            $user->save();
            
        } else {
            
            $user->status = $request->status;
            $user->save();

        }

        Alert::toast('Petugas berhasil diubah', 'success');
        return back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Alert::toast('Petugas berhasil dihapus', 'success');
        return back();
    }
}
