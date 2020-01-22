<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Team;
use App\Screen;
use App\Feature;

class FrontController extends Controller
{
    public function index()
    {
    	$settings = Setting::first();
    	$team = Team::get();
    	$screens = Screen::get();
    	$features = Feature::get();
    	return view('Front.index', compact('settings','team','screens','features'));
    }
}
