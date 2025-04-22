<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "password" => "required|string|min:6",
            "no_hp" => "required|string|min:11",
            "alamat" => "required|string",
            "roles" => "required|in:user,admin"
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->poin = 0;
        $user->roles = $request->roles;
        $user->save();

        //return redirect()->route()->with("success", "User Created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users,email,$id",
            "password" => "nullable|string|min:6",
            "no_hp" => "required|string|min:11",
            "alamat" => "required|string",
            "roles" => "required|in:user,admin"
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled("password")) {
            $user->password = bcrypt($request->password);
        }
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->save();

        //return redirect()->route()->with("success", "User updated!");



        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        //
    }
}
