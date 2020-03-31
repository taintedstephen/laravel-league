<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Division;

class ResultController extends Controller
{

    public function __construct() {
		$this->middleware('auth');
	}

    public function index()
    {
        $matches = Match::all()->sortBy('match_week');;
		return view('matches.all', [
			'matches' => $matches,
			'title' => 'Matches'
		]);
    }

	public function generate()
	{
		$fixtures = $this->generateFixtures();
		return view('matches.generated', [
			'fixtures' => $fixtures,
			'json' => json_encode($fixtures),
			'title' => 'Generated Matches'
		]);
	}

	public function saveGenerated(Request $request)
	{
		$fixtures = json_decode($request->fixtures, true);
		foreach ($fixtures as $division) {
			foreach ($division["fixtures"] as $weeks) {
				foreach ($weeks["fixtures"] as $fixture) {
					$match = new Match;
					$match->home_player_id = $fixture["homePlayer"]["id"];
					$match->away_player_id = $fixture["awayPlayer"]["id"];
					$match->division_id = $division["division"];
					$match->match_week = $weeks["week"];
					$match->save();
				}
			}
		}
		return redirect('/results')->with('status', 'Matches Scheduled');
	}

	public function emptyAll()
	{
		Match::truncate();
		return redirect('/results')->with('status', 'Matches Deleted');
	}

	public function edit($id)
	{
		$match = Match::findOrFail($id);
		return view('matches.edit', [
			'match' => $match,
			'title' => 'Edit Matche'
		]);
	}

	public function update(Request $request)
	{
		$id = $request->id;

		$request->validate([
			'home_score' => 'required|integer|gte:0|lte:25',
			'away_score' => 'required|integer|gte:0|lte:25',
			'outcome' => 'required|string|in:normal_result,home_forfeit,away_forfeit,both_forfeit',
		]);

		$match = Match::findOrFail($id);
		$match->home_score = $request->home_score;
		$match->away_score = $request->away_score;
		$match->outcome = $request->outcome;
		$match->has_result = true;
		$match->save();
		return redirect('/results')->with('status', 'Match Updated');
	}

	private function generateFixtures()
	{
		$divisions = Division::all();
		$fixtures = [];

		foreach ($divisions as $division):
			$players = $division->players->toArray();
			shuffle($players);
			if (count($players) % 2 === 0) {
				$players[] = [
					'id' => '__blank__',
					'psn' => '__blank__',
				];
			};
			$offset = 1;
			$playerCount = count($players);
			$weeks = [];
			while ($offset < $playerCount) {
				$weekFixtures = [];
				for ($home = 0; $home < $playerCount; $home++) {
					$away = ($home + $offset) % $playerCount;
					if (
						$players[$home]['psn'] !== '__blank__'
						&& $players[$away]['psn'] !== '__blank__'
					) {
						$weekFixtures[] = [
							'homePlayer' => [
								'id' => $players[$home]['id'],
								'psn' => $players[$home]['psn'],
							],
							'awayPlayer' => [
								'id' => $players[$away]['id'],
								'psn' => $players[$away]['psn'],
							],
						];
					};
				}
				usort($weekFixtures, function($a, $b) {
				    return strcmp(strtolower($a['homePlayer']['psn']), strtolower($b['homePlayer']['psn']));
				});
				$weeks[] = [
					'week' => $offset,
					'fixtures' => $weekFixtures,
				];
				$offset++;
			}

			$fixtures[] = [
				'division' => $division['id'],
				'name' => $division['name'],
				'fixtures' => $weeks,
			];

		endforeach;

		return $fixtures;
	}
}

/*
home player ID,
away player ID,
week
division
*/
