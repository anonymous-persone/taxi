<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    	$DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/TripsHistory/';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $drivers = $firebase->get($DEFAULT_PATH);
        $drivers = json_decode($drivers,true);
        $today = date('d/m');
        $thisMonth = date('m');
        $moneyToday = 0;
        $moneyMonth = 0;
        $format = "d/m";
        $monthFormat = "m";
        $date1  = \DateTime::createFromFormat($format, $today);
        $dateMonth = \DateTime::createFromFormat($monthFormat, $today);
        
        foreach ($drivers as $key => $driver) {
        	$date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
        	$date2  = \DateTime::createFromFormat($format, $date);
        	if ($date1 == $date2) {
        		$moneyToday += trim(substr($driver['fee'],0, strpos($driver['fee'], " ") + 1));
        	}
        }
        foreach ($drivers as $key => $driver) {
        	$date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
        	$date = trim(substr($driver['date'], strpos($driver['date'], "/") + 1));
        	$date2  = \DateTime::createFromFormat($monthFormat, $date);
        	if ($date == ltrim($thisMonth)) {
        		$moneyMonth += trim(substr($driver['fee'],0, strpos($driver['fee'], " ") + 1));
        	}
        }
        // return redirect()->route('drivers');
        
        return view('Admin.dashboard', compact('moneyToday','moneyMonth','user'));
    }

    public function language($lang)
    {
        app()->setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
