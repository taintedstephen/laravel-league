<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Player;

class PlayerController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }

	public function index()
	{
		$players = Player::all();
		return view('players.all', [
			'players' => $players,
			'title' => 'Players'
		]);
	}

	public function new()
	{
		return view('players.new', [
			'title' => 'New Player'
		]);
	}

	public function create(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'psn' => 'required|string|max:255',
		]);

		$player = new Player;
        $player->name = $request->name;
        $player->psn = $request->psn;
        $player->save();

		return redirect('/players')->with('status', 'Player Created');
	}

	public function edit($id)
	{
		$player = Player::findOrFail($id);
		return view('players.edit', [
			'player' => $player,
			'title' => 'Edit Player'
		]);
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'psn' => 'required|string|max:255',
		]);

		$player = Player::findOrFail($request->id);
		$player->name = $request->name;
        $player->psn = $request->psn;
		$player->save();

		return redirect('/players')->with('status', 'Player Updated');
	}

	public function remove(Request $request)
	{
		$player = Player::findOrFail($request->id);
		$player->delete();
		return redirect('/players')->with('status', 'Player Deleted');
	}
}
