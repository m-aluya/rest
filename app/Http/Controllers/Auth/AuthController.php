<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginx(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->back()->with([
                'message' => 'Invalid login credentials. Please try again.',
            ]);
        }
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        // Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
