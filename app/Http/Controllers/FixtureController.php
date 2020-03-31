<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Division;
use App\Player;
use App\Match;

class FixtureController extends Controller
{
    public function __construct() {}

	public function index()
	{
		$matches = Match::all();
		$weeks = [];
		foreach ($matches as $match) {
			$w = $match['match_week'];
			$d = $match['division_id'];
			if (!isset($weeks[$w])) {
				$weeks[$w] = [
					'week' => 'Week ' . $w,
					'divisions' => [],
				];
			}
			if (!isset($weeks[$w]['divisions'][$d])) {
				$weeks[$w]['divisions'][$d] = [
					'name' => $match->division->name,
					'matches' => [],
				];
			}
			$weeks[$w]['divisions'][$d]['matches'][] = $match;
		}
		ksort($weeks);
		$keys = array_keys($weeks);
		foreach ($keys as $key) {
			ksort($weeks[$key]['divisions']);
			$divs = array_keys($weeks[$key]['divisions']);
			foreach ($divs as $div) {
				usort($weeks[$key]['divisions'][$div]['matches'], function($a, $b) {
				    return strcmp(strtolower($a['homePlayer']['psn']), strtolower($b['homePlayer']['psn']));
				});
			}
		}
		return view('fixtures.all', [
			'weeks' => $weeks,
			'title' => 'Fixtures'
		]);
	}

	public function player($id)
	{
		$player = Player::findOrFail($id);
		$matches = Match::where('home_player_id', '=', $id)
			->orWhere('away_player_id', '=', $id)
			->get();
		$weeks = [];
		foreach ($matches as $match) {
			$w = $match['match_week'];
			$d = $match['division_id'];
			if (!isset($weeks[$w])) {
				$weeks[$w] = [
					'week' => 'Week ' . $w,
					'divisions' => [],
				];
			}
			if (!isset($weeks[$w]['divisions'][$d])) {
				$weeks[$w]['divisions'][$d] = [
					'name' => $match->division->name,
					'matches' => [],
				];
			}
			$weeks[$w]['divisions'][$d]['matches'][] = $match;
		}
		ksort($weeks);
		$keys = array_keys($weeks);
		foreach ($keys as $key) {
			ksort($weeks[$key]['divisions']);
			$divs = array_keys($weeks[$key]['divisions']);
			foreach ($divs as $div) {
				usort($weeks[$key]['divisions'][$div]['matches'], function($a, $b) {
				    return strcmp(strtolower($a['homePlayer']['psn']), strtolower($b['homePlayer']['psn']));
				});
			}
		}
		return view('fixtures.all', [
			'title' => $player->psn,
			'weeks' => $weeks
		]);
	}
}
