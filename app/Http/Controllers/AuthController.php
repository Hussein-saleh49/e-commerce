<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterationForm()
    {
        return view("pages.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            "fullname" => "required",
            "email"    => "required|email|unique:users,email",
            "password" => "required|min:6"
        ]);

        $data["fullname"] = $request->fullname;
        $data["email"]    = $request->email;
        $data["password"] = Hash::make($request->password);

        $user = User::create($data);

        // اعمل تسجيل دخول مباشر بعد التسجيل
        Auth::login($user);

        return redirect()->route("dashboard")->with("success","Registration is successful");
    }

    public function showLoginForm()
    {
        return view("pages.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email"    => "required|email",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("dashboard")->with("success","Login is successful");
        } else {
            return redirect()->route("login.show")->with("error","Login failed, please try again.");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with("success","You have been logged out.");
    }
}
