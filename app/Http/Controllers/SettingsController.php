<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function prices(){
        $user = auth()->user();
        if (!$user->able(1)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $user = auth()->user();
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/SystemSettings';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $prices = $firebase->get($DEFAULT_PATH);
        $prices = json_decode($prices);
        // $title = "System Prices";

        return view('Admin.settings.prices.index', compact('prices','user'));
    }

    public function updatePrices(Request $request){
        $user = auth()->user();
        if (!$user->able(23)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/SystemSettings';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $data = [
            "commissionPercentage" => $request->commissionPercentage,
            "initialTripCost" => $request->initialTripCost,
            "tripPerMeterCost"=> $request->tripPerMeterCost,
            "tripPerSecondCost"=> $request->tripPerSecondCost,
        ];
        try{
            $firebase->update($DEFAULT_PATH, $data);
            return redirect()->back()->with('success', 'Driver updated successfully');
        }catch(Exception $e){
            echo $e->getMessage();   // insert query
        }
    }

    public function cards(){
        $user = auth()->user();
        if (!$user->able(1)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/PrepaidCommissionCards';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $cards = $firebase->get($DEFAULT_PATH);
        $cards = json_decode($cards);
        $title = "System Cards";

        return view('Admin.settings.cards.index', compact('cards','user','title'));
    }

    public function addCards(){
        $user = auth()->user();
        if (!$user->able(23)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        return view('Admin.settings.cards.add', compact('user', 'cities'));
    }

    public function storeCards(Request $request){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $cardsQuantity = $request->quantity;
        $random_number='';
        $count=0;
        $allNumbers = [];
        
        for($i=0; $i < $cardsQuantity; $i++){
            loop:
            while ( $count < 16 ) {
                // $random_digit = mt_rand(0, 9);
                $random_number .= $characters[rand(0, $charactersLength - 1)];;
                $count++;
            }
            if(array_search($random_number,$allNumbers)){
                $random_number='';
                $count=0;
                goto loop;
            }
            array_push($allNumbers, $random_number);
            $random_number='';
            $count=0;
        }
        echo'<pre>';
        var_dump($allNumbers);
    }

}
