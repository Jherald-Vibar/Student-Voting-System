<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login() {
        return view('auth.student-login');
    }


    public function authenticate(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);



        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }

        if (Auth::guard('student')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {

        return redirect()->route('student.home');

         } elseif (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
         ], $request->remember)) {


        return redirect()->route('admin-home');

        } else {
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
    }


    public function logout() {

        if(Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        else {
            Auth::guard('student')->logout();
        }

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('success', "Logout Successful!");
    }
}
