<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Role;
use DB;
use Session;

class MyUsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->take(10)->get();
        return view('admin.userlist.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.userlist.create', compact('roles'));
    }

    public function edit($id)
    {
        $roles = Role::all()->pluck('title', 'id');
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.userlist.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->update(request()->except(['_token']));
        return redirect()->route('myusers.index')->with('updated', 'User updated successfully!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'unique:users'],
        ]);
        $user = User::create($request->all());
        return redirect()->route('myusers.index');
    }

    public function destroy($id)
    {
        $users = DB::table('users')->where('id', $id)->delete();
        return back()->with('success','Record deleted successfully!');
    }
}