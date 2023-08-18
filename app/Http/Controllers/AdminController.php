<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();

        return view('admin', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.main')->with('success', 'User successfully deleted.');
    }

    public function show(User $user)
    {
        $selected_user = $user;

        return view('layouts.admin_update', compact('selected_user'));
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->permission = $request->input('permission');
        $user->save();

        return redirect()->route('admin.main')->with('success', 'User information updated successfully!');
    }

    public function show_p(User $user)
    {
        $selected_user = $user;
        
        return view('layouts.admin_edit', compact('selected_user'));
    }
}
