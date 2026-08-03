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
        $validatedData = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_num',
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
            ],
        ]);

        User::create([
            'username' => $validatedData['username'],
            'user_title' => $validatedData['user_title'],
            'password' => bcrypt($validatedData['password']),
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

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_num',
                'unique:users,username,' . $user->id,
            ],
            'user_title' => [
                'required',
                'string',
                'max:255',
            ],
            'password' => [
                'nullable',
                'string',
                'min:6',
            ],
        ]);

        $user->username = $validatedData['username'];
        $user->user_title = $validatedData['user_title'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function delete(User $user)
    {
        return view('admin.users.delete', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla silindi.');
    }
}