<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //show all users
    public function index()
    {
        $users = User::all();
        return view('admins.users.index', compact('users'));
    }

    //create a user
    public function create()
    {
        return view('admins.users.create');
    }

    //store a user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required',
            'role' => 'required'
        ]);

        $user = User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    //show a user by id
    public function show(User $user)
    {
        return view('admins.users.show', compact('user'));
    }

    //edit a user
    public function edit(User $user)
    {
        return view('admins.users.edit', compact('user'));
    }
}
