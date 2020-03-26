<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Division;
use App\Player;
use App\Match;

class TableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
		$tables = [];
		$divisions = Division::all();
		$matches = Match::all();
		foreach ($divisions as $division) {
			$players = $division->players->toArray();
			if (count($players) > 0) {
				$table = $this->parseResults($players, $matches);
				$tables[] = [
					"id" => $division["id"],
					'name' => $division["name"],
					'table' => $table,
				];
			}
		}
		return view('tables', [
			'tables' => $tables
		]);
    }

	private function parseResults($players, $matches)
	{
		$players = $this->setupPlayers($players);
		$keyedPlayers = $this->keyPlayers($players);

		foreach ($matches as $match):
			if (
				$match["has_result"]
				&& isset($keyedPlayers[$match["home_player_id"]])
				&& isset($keyedPlayers[$match["away_player_id"]])
			) {

				$keyedPlayers[$match["home_player_id"]]["played"] += 1;
				$keyedPlayers[$match["home_player_id"]]["kills"] += $match["home_score"];
				$keyedPlayers[$match["home_player_id"]]["deaths"] += $match["away_score"];

				$keyedPlayers[$match["away_player_id"]]["played"] += 1;
				$keyedPlayers[$match["away_player_id"]]["kills"] += $match["away_score"];
				$keyedPlayers[$match["away_player_id"]]["deaths"] += $match["home_score"];

				if (
					$match["outcome"] === 'normal_result'
					&& $match["home_score"] > $match["away_score"]
				) {
					$keyedPlayers[$match["home_player_id"]]["wins"] += 1;
					$keyedPlayers[$match["away_player_id"]]["losses"] += 1;
				} else if (
					$match["outcome"] === 'normal_result'
					&& $match["home_score"] < $match["away_score"]
				) {
					$keyedPlayers[$match["home_player_id"]]["losses"] += 1;
					$keyedPlayers[$match["away_player_id"]]["wins"] += 1;
				} else if (
					$match["outcome"] === 'normal_result'
					&& $match["home_score"] === $match["away_score"]
				) {
					$keyedPlayers[$match["home_player_id"]]["draws"] += 1;
					$keyedPlayers[$match["away_player_id"]]["draws"] += 1;
				} else if ($match["outcome"] === 'home_forfeit') {
					$keyedPlayers[$match["home_player_id"]]["losses"] += 1;
					$keyedPlayers[$match["away_player_id"]]["wins"] += 1;
				} else if ($match["outcome"] === 'away_forfeit') {
					$keyedPlayers[$match["home_player_id"]]["wins"] += 1;
					$keyedPlayers[$match["away_player_id"]]["losses"] += 1;
				} else if ($match["outcome"] === 'both_forfeit') {
					$keyedPlayers[$match["home_player_id"]]["draws"] += 1;
					$keyedPlayers[$match["away_player_id"]]["draws"] += 1;
				};
			}
		endforeach;

		$players = $this->unKeyPlayers($keyedPlayers);
		$players = $this->calculateStats($players);
		$players = $this->assignPositions($players);
		return $players;
	}

	private function setupPlayers($players)
	{
		return array_map(function($p) {
			$p["played"] = 0;
			$p["wins"] = 0;
			$p["losses"] = 0;
			$p["draws"] = 0;
			$p["kills"] = 0;
			$p["deaths"] = 0;
			$p["position"] = 0;
			$p["kd"] = 0;
			$p["kdratio"] = 0;
			$p["points"] = 0;
			return $p;
		}, $players);
	}

	private function keyPlayers($players)
	{
		$response = [];
		foreach ($players as $player) {
			$response[$player["id"]] = $player;
		}
		return $response;
	}

	private function unKeyPlayers($players)
	{
		$response = [];
		$keys = array_keys($players);
		foreach ($keys as $key) {
			$response[] = $players[$key];
		};
		return $response;
	}

	private function calculateStats($players)
	{
		$data = array_map(function($p) {
			$p["points"] = ($p["wins"] * 3) + $p["draws"];
			$p["kd"] = $p["kills"] - $p["deaths"];
			$d = ($p["deaths"] === 0) ? 1 : $p["deaths"];
			$p["kdratio"] = round($p["kills"] / $d * 100) / 100;
			return $p;
		}, $players);
		return $data;
	}

	private function assignPositions($players)
	{
		$points = array_column($players, 'points');
		$kd = array_column($players, 'kd');
		$wins = array_column($players, 'wins');
		$name = array_column($players, 'name');
		array_multisort(
			$points, SORT_NUMERIC, SORT_DESC,
			$kd, SORT_NUMERIC, SORT_DESC,
			$wins, SORT_NUMERIC, SORT_DESC,
			$name, SORT_STRING, SORT_ASC,
			$players
		);
		for ($i = 1; $i <= count($players); $i++) {
			$players[$i - 1]["position"] = $i;
		}
		return $players;
	}
}
