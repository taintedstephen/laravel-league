<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }

	public function index()
	{
		$users = User::all();
		return view('users.all', [
			'users' => $users,
			'title' => 'Users'
		]);
	}

	public function new()
	{
		return view('users.new', [
			'title' => 'New User'
		]);
	}

	public function create(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);

		$user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

		return redirect('/users')->with('status', 'User Created');
	}

	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('users.edit', [
			'user' => $user,
			'title' => 'Edit User'
		]);
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
		]);

		if (!empty($request->password)) {
			$request->validate([
				'password' => 'required|string|min:6|confirmed'
			]);
		};

		$user = User::findOrFail($request->id);
		$user->name = $request->name;
        $user->email = $request->email;
		if (!empty($request->password)) {
        	$user->password = bcrypt($request->password);
		};
		$user->save();

		return redirect('/users')->with('status', 'User Updated');
	}

	public function remove(Request $request)
	{
		$user = User::findOrFail($request->id);
		$user->delete();
		return redirect('/users')->with('status', 'User Deleted');
	}
}
