<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    public function registered()
    {
        $members = User::all();
        //return view('admin.register')->with('members', $members);
        return view('admin.auth.register', compact('members'));
    }

    public function edit(Request $request, $id)
    {
        $members = User::findOrFail($id);
        return view('admin.auth.edit', compact('members'));
    }

    public function update(Request $request, $id)
    {
        $members = User::findOrFail($id);
        $members->name = $request->input('username');
        $members->usertype = $request->input('usertype');
        $members->update();

        return redirect('/role-register')->with('successMsg', 'Your Data Was Successfully Updated ):');
    }

    public function delete($id)
    {
        $member = User::findOrFail($id);
        $member->delete();

        return redirect('/role-register')->with('successMsg', 'Your Data Was Successfully Deleted ):');
    }
}
