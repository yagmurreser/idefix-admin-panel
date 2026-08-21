<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
        
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|alpha_num|unique:users,username',
        'user_title' => 'required',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'username' => $validated['username'],
        'user_title' => $validated['user_title'],
        'password' => Hash::make($validated['password']),
    ]);

    return response()->json($user, 201);
}
    

}