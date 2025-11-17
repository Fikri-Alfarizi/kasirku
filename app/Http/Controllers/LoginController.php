<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;



class LoginController extends Controller {

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // Auto login setelah register
        Session::put('kasir_logged_in', true);
        Session::put('kasir_id', $user->id);
        Session::put('kasir_name', $user->name);
        return redirect('/dashboard');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('kasir_logged_in', true);
            Session::put('kasir_id', $user->id);
            Session::put('kasir_name', $user->name);
            return redirect('/dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout()
    {
        Session::forget(['kasir_logged_in', 'kasir_id', 'kasir_name']);
        return redirect('/login');
    }
}
