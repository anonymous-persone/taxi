<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\CardsExport;
use Maatwebsite\Excel\Facades\Excel;


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
            "commissionPercentage" => (double) $request->commissionPercentage,
            "initialTripCost" => (double) $request->initialTripCost,
            "tripPerMeterCost"=> (double) $request->tripPerMeterCost,
            "tripPerSecondCost"=> (double) $request->tripPerSecondCost,
            "addCost"=> (double) $request->addCost,
            "cancelCost"=> (double) $request->cancelCost,
            "cancelRatio"=> (double) $request->cancelRatio,
        ];
        try{
            $firebase->update($DEFAULT_PATH, $data);
            return redirect()->back()->with('success', 'Prices updated successfully');
        }catch(Exception $e){
            echo $e->getMessage();   // insert query
        }        
    }

    public function cards(Request $request){

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
        
        if($request->session()->exists('allNumbers')){
            $allNumbers = $request->session()->get('allNumbers');
            // $export = new CardsExport($allNumbers);
            return view('Admin.settings.cards.index', compact('cards','user','title','allNumbers'));
        }
        return view('Admin.settings.cards.index', compact('cards','user','title'));
    }

    public function addCards(){
        $user = auth()->user();
        if (!$user->able(23)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        return view('Admin.settings.cards.add', compact('user'));
    }

    //     return Excel::download(new CardsExport, 'cards.xlsx');

    public function storeCards(Request $request){

        $characters = '123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $cardsQuantity = $request->quantity;
        $cardValue = $request->value;
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
            // echo'<pre>';
            // echo 'Random Number: '. $random_number; echo'<br>';
            // echo 'All Numbers: '; print_r($allNumbers);
            // echo 'Array Search: '. array_search($random_number, array_column($allNumbers, 'Card Number'),true);
            // echo'<hr>';
            if(array_search($random_number, array_column($allNumbers, 'Card Number')) !== false ){
                $random_number='';
                $count=0;
                goto loop;
            }
            $random_number = ['Card Number' => $random_number, 'Value' => $cardValue ];
            array_push($allNumbers, $random_number);
            $random_number='';
            $count=0;
        }

        $user = auth()->user();
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/PrepaidCommissionCards';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        
        // dd($allNumbers);
        // dd($request);
        try {

            foreach ($allNumbers as $key => $number) {
                
                $data = [
                    "cardNumber" => $number['Card Number'],
                    "value" => (double) $cardValue,
                ];
                $firebase->push($DEFAULT_PATH, $data);
            }
            // if ($user->is_agent){
            //     $log = new Log;
            //     $log->agent = $user->name;
            //     $log->action = "Added new $cardsQuantity Card Numbers of $request->value";
            //     $log->save();
            // }
        }
        catch (\Exception $th) {
            echo $th->getMessage();
        }
        // session()->now('success', 'Cards created successfully');
        
        $export = new CardsExport($allNumbers);
        return Excel::download($export, 'cards-'.time().'.xlsx');
        // return redirect()->route('cards.index')->with('allNumbers', $allNumbers);

    }

}