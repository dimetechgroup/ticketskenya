<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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

    //edit a user
    public function edit(User $user)
    {
        return view('admins.users.edit', compact('user'));
    }

    //update a user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'phone_number' => 'required',

        ]);

        //hash password
        $request['password'] = bcrypt($request->password);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }






    //show a user by id
    public function show(User $user)
    {
        return view('admins.users.show', compact('user'));
    }

    //delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    //logout a user

}
