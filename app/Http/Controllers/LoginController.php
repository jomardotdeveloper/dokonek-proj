<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $validated = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();
            return redirect()->intended("/panel/dashboard");
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }

    public function register () {
        return view("register");
    }

    public function store (Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $values = $request->all();

        $path = Storage::putFile("public/profiles" , $request->file("image_src"));
        $path = Storage::url($path);
        $values['image_src'] =  $path;

        $user = User::create([
            'name' => $values['first_name'] . ' ' . $values['last_name'],
            'email' => $values['email'],
            'password' => Hash::make($request->password),
        ]);
        

        $values['user_id'] = $user->id;

        Patient::create($values);

        return redirect()->route('login');
    }
}
