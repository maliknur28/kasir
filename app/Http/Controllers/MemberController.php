<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(5);

        return view('pages.member', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:12|max:12',
            'address' => 'required'
        ]);

        Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        Alert::toast('Anggota berhasil disimpan', 'success');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:12|max:12',
            'address' => 'required'
        ]);

        $member = Member::findOrFail($id);
        $member->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        Alert::toast('Anggota berhasil diubah', 'success');
        return back();
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        Alert::toast('Anggota berhasil dihapus', 'success');
        return back();
    }
}
