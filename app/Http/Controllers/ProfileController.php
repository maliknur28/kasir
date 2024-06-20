<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [];

        if ($request->has('name') && $request->input('name') != $user->name) {
            $rules['name'] = 'required';
        }

        if ($request->has('phone') && $request->input('phone') != $user->phone) {
            $rules['phone'] = 'required|min:12|max:12';
        }

        if ($request->has('username') && $request->input('username') != $user->username) {
            $rules['username'] = 'required|unique:users,username';
        }

        if ($request->has('password') && !empty($request->input('password'))) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        if (!empty($rules)) {
            $request->validate($rules);

            if (isset($rules['name'])) {
                $user->update(['name' => $request->name]);
            }

            if (isset($rules['phone'])) {
                $user->update(['phone' => $request->phone]);
            }

            if (isset($rules['username'])) {
                $user->update(['username' => $request->username]);
            }

            if (isset($rules['password'])) {
                $user->update(['password' => Hash::make($request->password)]);
            }
        }

        Alert::toast('Profil berhasil diubah', 'success');
        return back();
    }
}
