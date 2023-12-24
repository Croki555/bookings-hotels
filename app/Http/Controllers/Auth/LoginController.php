<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authentificate(Request $request)
    {
        $remember = $request->has('remember');
        $data = $request->only(['email', 'password']);

        if(Auth::attempt($data, $remember)) {
            session()->regenerate();
            return redirect(route('hotels.index'));
        }

        return back()->withErrors(['email' => 'Incorrect login or password'])->onlyInput('email');
    }

    public function logout()
    {
        $user = Auth::user();
        $user->remember_token = null;
        $user->save();

        Auth::logout();

        return redirect(route('hotels.index'));
    }
}
