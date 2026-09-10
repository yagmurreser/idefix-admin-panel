<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'username' => 'Kullanıcı adı veya şifre hatalı.',
                ])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        if ($user->isCustomer()) {
            return redirect()->route('customer.shop');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()
            ->withErrors([
                'username' => 'Bu kullanıcı için geçerli bir rol bulunamadı.',
            ])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}