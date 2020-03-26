<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_score', 'away_score', 'outcome', 'has_result', 'match_week'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

	public function division()
	{
		return $this->belongsTo('App\Division');
	}

	public function homePlayer()
	{
		return $this->hasOne('App\Player', 'id', 'home_player_id');
	}

	public function awayPlayer()
	{
		return $this->hasOne('App\Player', 'id', 'away_player_id');
	}
}
