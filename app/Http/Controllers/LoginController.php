<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $request->session()->regenerate();

                return redirect()->intended('/dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
            }

            throw ValidationException::withMessages([
                'username' => ['Kredensial yang diberikan tidak cocok dengan catatan kami.'],
            ]);

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput($request->except('password'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
