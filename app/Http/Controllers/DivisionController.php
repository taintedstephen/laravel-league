<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Division;
use App\Player;

class DivisionController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }

	public function index()
	{
		$divisions = Division::all()->sortBy('sort_order');
		return view('divisions.all', [
			'divisions' => $divisions,
			'title' => 'Divisions'
		]);
	}

	public function new()
	{
		return view('divisions.new', [
			'title' => 'New Division'
		]);
	}

	public function create(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
		]);

		$division = new Division;
        $division->name = $request->name;
        $division->save();

		return redirect('/divisions')->with('status', 'Division Created');
	}

	public function edit($id)
	{
		$division = Division::findOrFail($id);
		return view('divisions.edit', [
			'division' => $division,
			'title' => 'Edit Division'
		]);
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
		]);

		$division = Division::findOrFail($request->id);
		$division->name = $request->name;
		$division->save();

		return redirect('/divisions')->with('status', 'Division Updated');
	}

	public function remove(Request $request)
	{
		$division = Division::findOrFail($request->id);
		$division->delete();
		return redirect('/divisions')->with('status', 'Division Deleted');
	}

	public function players()
	{
		$divisions = Division::all()->sortBy('sort_order');
		$unassignedPlayers = Player::where('division_id', null)->get();
		return view('divisions.players', [
			'divisions' => $divisions,
			'unassignedPlayers' => $unassignedPlayers,
			'title' => 'Manage Players'
		]);
	}

	public function savePlayers(Request $request)
	{
		$data = json_decode($request->data, true);
		$divisions = Division::all();
		foreach ($divisions as $division) {
			$playerIds = $data[$division->id];

			if (count($playerIds) > 0) {
				foreach ($playerIds as $id) {
					$player = Player::findOrFail($id);
					$player->division()->associate($division);
					$player->save();
				};
			}
		};
		$playerIds = $data['unassigned'];
		foreach ($playerIds as $id) {
			$player = Player::find($id);
			$player->division()->dissociate();
			$player->save();
		};
		return redirect('/divisions')->with('status', 'Divisions Updated');
	}
}
