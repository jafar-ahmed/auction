<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {

        $users = User::whereNull('is_admin')->get();
        return view('dashboard.users.index', [
            'title' => 'Users List',
            'users' => $users,
        ]);
    }
    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        //unique:users
        $request->merge([
            'contacts' => $request->input('contacts'),
            'avatar' => $request->input('photo'),

        ]);
        $user = User::create($request->all());
        //

        return redirect('/dashboard/users')->with('success', 'User Added!!!');
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view('dashboard.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // $user->name = $request->input('name');
        // $user->save();

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contacts' => $request->input('contacts'),
            'avatar' => $request->input('photo'),
        ]);
        return redirect('/dashboard/users')->with('success', 'User updated!!!');
    }
    public function destroy($id)
    {

        // $user = User::findOrFail($id);
        // $user->delete();

        User::destroy($id);

        return redirect('/dashboard/users')->with('success', 'User Deleted!!!');
    }
}
