<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm($id){
       return redirect()->route('/login'); 
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->role) {
                case 'subscriber':
                    return redirect()->route('subscriber');
                case 'manager':
                    return redirect()->route('dashboard');
                case 'editor':
                    return redirect()->route('editor.page');
                default:
                    return redirect()->route('accueil.page');
            }
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|min:6|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:12|confirmed',
            'phone_number' => 'required',
            'profile_picture' => 'required|image',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'preferred_language' => 'required',
            'terms' => 'accepted',
        ]);

        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

        User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone_number' => $validated['phone_number'],
            'profile_picture' => $profilePicturePath,
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'preferred_language' => $validated['preferred_language'],
            'role' => 'subscriber', 
        ]);

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès.');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.'); // إعادة التوجيه إلى الصفحة الرئيسية مع رسالة نجاح
    }
}
