<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        try {

            // dd($request->all());
            $request->validate([
                'name' => 'required|string',
                'role' => 'required|string',
                'password'=> 'required|string',
                'email' => 'required|email|unique:users,email'
            ]);

            User::create([
                'name' => $request->name,
                'role' => $request->role,
                'password' => $request->password,
                'email' => $request->email,
            ]);

            return redirect()->route('users')->with('success','Berhasil Menambah User');

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $request->validate([
                'name' => 'required|string',
                'role' => 'required|string',
                'password'=> 'nullable',
                'email' => 'required|email|unique:users,email,' .$id
            ]);

            if(!$request->password) {
                $request->password = $user->password;
            }

            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return redirect()->route('users')->with('success','Berhasil Mengupdate User');

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();
            return redirect()->route('users')->with('success','Berhasil Menghapus User');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
