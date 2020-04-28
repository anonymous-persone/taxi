<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiderController extends Controller
{
    public static function data(){
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $cities = $firebase->get($DEFAULT_PATH);
        $cities = json_decode($cities,true);
        $title = "System Agents";
        return $cities;
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user->able(8)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $riders = $firebase->get($DEFAULT_PATH);
        $riders = json_decode($riders,true);
        $title = "System Riders";
        $driverController = new DriverController();
        $cities = $driverController::data();
//         return $riders;
        return view('Admin.riders.index', compact('riders','title', 'user', 'cities'));
    }

    public function add()
    {
        $user = auth()->user();
        if (!$user->able(7)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        return view('Admin.riders.add', compact('user'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(7)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation/'.$request->phone;
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $data = [
            "first_Name"=> $request->first_Name,
            "last_Name" => $request->last_Name,
            "phone"     => $request->phone
        ];
        $firebase->set($DEFAULT_PATH.'/'.$key, $data);
        return redirect()->route('riders')->with('success', 'Rider updated successfully');
    }

    public function delete(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(6)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $firebase->delete($DEFAULT_PATH.'/'.$key);
        return response()->json('success');
    }

    public function rider(Request $request)
    {
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $drivers = $firebase->get($DEFAULT_PATH.'/'.$key);
        $driver = json_decode($drivers,true);
        return $driver;
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(5)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $rider = $this->rider($request);
        $current_walletBalance = 0;
        if(isset($rider['walletBalance'])){$current_walletBalance = $rider['walletBalance'];}
        $new_wb = $current_walletBalance + (double) $request->wb_new;
        $data = [
            "first_Name"=> $request->first_name,
            "last_Name" => $request->last_name,
            "phone"     => $request->phone,
            // "gender"    => $request->gender,
            // "governorate" => $request->governorate,
            // "markaz"    => $request->markaz
            "walletBalance" => $new_wb,
            "id_Number" => $request->id_Number,

        ];
        $firebase->update($DEFAULT_PATH.'/'.$key, $data);
        return redirect()->back()->with('success', 'Rider updated successfully');
    }

    public function show($key)
    {
        $user = auth()->user();
        if (!$user->able(8)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/RidersInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        // $earnings = $this->earnings($key);
        // return $earnings;
        $riders = $firebase->get($DEFAULT_PATH);
        $riders = json_decode($riders,true);
        foreach ($riders as $dr) {
            if ($dr['phone'] == $key) {
                $rider = $dr;
                break;
            }
        }
        $firstname = $rider['first_Name'];
        $lastname = $rider['last_Name'];
        $image = $rider['image_url'];
        $phone = $rider['phone'];
        // $id_Number = $rider['id_Number'];
        if(isset($rider['email']) && !empty($rider['email'])) $email = $rider['email']; else{$email = '';}
        $walletBalance = $rider['walletBalance'];

        $drivers = new DriverController();
        $drivers = $drivers::drivers();


        $DEFAULT_PATH = '/TripsHistory';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $hist = [];
        $counter = 0;
        $history = $firebase->get($DEFAULT_PATH);
        $trips = json_decode($history,true);
        // return $key;
        $DEFAULT_PATH = '/RateDetails';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $rates = $firebase->get($DEFAULT_PATH);
        $rates = json_decode($rates,true);

        // return $rates;
        foreach ($trips as $k => $trip) {
            if (isset($trip['rider'])) {
                if ($trip['rider'] == $key) {
                    $trip['key'] = $k;
                    $hist[$counter] = $trip;
                    foreach ($rates as $ratee) {
                        foreach ($ratee as $myRate) {
                            if (isset($myRate['trip_id'])) {
                                if ($myRate['trip_id'] == $k) {
                                    $hist[$counter]['trip_rate'] = $myRate;
                                }
                            }
                        }
                    }
                    $counter++;
                }
            }

        }
        // dd($hist);
        return view('Admin.riders.show', compact('riders','drivers','firstname','lastname','image','phone','email','walletBalance','hist', 'user'));
    }
}
