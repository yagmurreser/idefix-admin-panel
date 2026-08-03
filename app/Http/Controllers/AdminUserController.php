<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|alpha_num|unique:users,username',
            'user_title' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $validated['username'],
            'user_title' => $validated['user_title'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla eklendi.');
    }

    public function bulkDelete(Request $request)
    {
        $userIds = $request->input('user_ids', []);

        if (empty($userIds)) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Silinecek kullanıcılar seçilmedi.');
        }

        User::whereIn('id', $userIds)->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Seçilen kullanıcılar başarıyla silindi.');
    }
}