<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/TripsHistory';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $riders = $firebase->get($DEFAULT_PATH);
        $hist = json_decode($riders,true);
        $title = "All Trips";
        // return $riders;
        $riders = new RiderController;
        $riders = $riders::data();
        $drivers = new DriverController;
        $drivers = $drivers::drivers();
        return view('Admin.trips.index', compact('hist','title', 'user', 'riders', 'drivers'));
    }

    public function show(Request $request)
    {
        $user = auth()->user();
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/TripsHistory';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $trips = $firebase->get($DEFAULT_PATH.'/'.$request->key);
        $trip = json_decode($trips,true);
        return $trip;
    }

    public function update(Request $request)
    {
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/TripsHistory';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $data = [
            "driver"=> $request->driver,
            "rider" => $request->rider,
            "date"     => $request->date,
            // "otherRiderPhone"    => $request->otherRiderPhone,
            "distance" => $request->distance,
            "totalPaymentValue" => (double) $request->totalPaymentValue,
            "walletPaymentValue"    => (double) $request->walletPaymentValue,
            // "newCost"    => (double)$request->newCost,
            "time"    => $request->time,
            // "estimatedPayout"    => $request->estimatedPayout,
            "from"    => $request->from,
            "to"    => $request->to,
            // "rates"    => $request->rates,
            // "comments"    => $request->comments,
        ];
        $firebase->update($DEFAULT_PATH.'/'.$key, $data);
        return redirect()->back()->with('success', 'Trip updated successfully');
    }
}
