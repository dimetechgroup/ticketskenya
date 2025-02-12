<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Notifications\UserCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->lazyByIdDesc();
        return view('admins.users.index', compact('users'));
    }

    //create a user
    public function create()
    {
        return view('admins.users.create');
    }

    //store a user
    public function store(StoreUserRequest $request)
    {

        try {
            $data = $request->validated();
            $password = "Password";
            $data['password'] = Hash::make($password);

            // upload image if exists
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            if ($request->hasFile('image')) {
                $data['image'] = Storage::disk(config('filesystems.default'))->put('profiles', $request->file('image'));
            }

            $user = User::create($data);
            event(new Registered($user));
            // send notification to user
            $user->notify(new UserCreated($password));

            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    //edit a user
    public function edit(User $user)
    {
        return view('admins.users.edit', compact('user'));
    }

    //update a user
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            // upload image if exists
            if ($request->hasFile('image')) {
                // Delete old image
                Storage::disk(config('filesystems.default'))->delete($user->image);
                $data['image'] = Storage::disk(config('filesystems.default'))->put('profiles', $request->file('image'));
            }


            $user->update($data);
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }






    //show a user by id
    public function show(User $user)
    {
        return view('admins.users.show', compact('user'));
    }

    //delete a user
    public function destroy(User $user)
    {
        // check if the existing user is only one
        if (User::count() == 1) {
            return redirect()->route('users.index')->with('error', 'You cannot delete the only user');
        }
        // check if user as a profile image
        if ($user->image) {
            Storage::disk(config('filesystems.default'))->delete($user->image);
        }
        // delete user
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    //logout a user

}
