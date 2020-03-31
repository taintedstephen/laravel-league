<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{

    public function __construct() {}

    public function rules()
    {
        return view('static/rules', [
			'title' => 'Rules'
		]);
    }
}
