<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bid;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin == 'admin') {
            $users = User::where('is_admin', 'admin')->get();
            return view('dashboard.admins.index', [
                'title' => 'Admins List',
                'users' => $users,
            ]);
        }
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if (request()->hasFile('avatar')) {
            $filename = request()->avatar->store('avatar');
        }
        $user =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'avatar' => $filename ?? '',
            'is_admin' => 'admin'

        ]);

        return redirect('/dashboard/admins')->with('success', 'Admin Added!!!');
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('dashboard.admins.edit', [
            'user' => $user,

        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => '',
        ]);
        $data = $request->except('password');
        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        }

        //$users = User::update($data);
        $user->update($data);
        // $user->update([
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     //'password' => Hash::make($request['password']),
        //     'is_admin' => 'admin'
        // ]);
        return redirect('/dashboard/admins')->with('success', 'Admin updated!!!');
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/dashboard/admins')->with('success', 'Admin Deleted!!!');
    }
}
