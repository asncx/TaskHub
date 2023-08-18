<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingField = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $incomingField['email'], 'password' => $incomingField['password']]))
        {
            $request->session()->regenerate();
        }
        
        return redirect('/');
    }

    public function logout() {
        auth()->logout();

        return redirect()->route('dashboard');
    }
    public function register(Request $request)
    {
           $incomingField = $request->validate([
                'name' => ['required', 'min:3', 'max:20'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:5', 'max:20'],
            ]);

         $incomingField['password'] = bcrypt($incomingField['password']);
         $user = User::create($incomingField);
         auth()->login($user);
         return redirect()->route('dashboard');
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:3', 'max:20'],
        ]);

        $user = Auth::user();
        $user->name = $request->input('username');
        $user->save();

        return redirect()->route('settings')->with('success', 'Username successfully updated!');
    }
    
    public function deleteAccount()
    {
        $user = Auth::user();
        $user->delete();
        auth()->logout();

        return redirect()->route('dashboard')->with('success', 'Your account has been deleted.');
    }
}
