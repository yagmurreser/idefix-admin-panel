<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('customer.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username',
            ],

            'user_title' => [
                'required',
                'string',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'user_title' => $validated['user_title'],
            'password' => $validated['password'],
            'role' => 'customer',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('customer.shop');
    }
}