<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public static function trips(){
        $user = auth()->user();
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/TripsHistory';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $riders = $firebase->get($DEFAULT_PATH);
        $hist = json_decode($riders,true);
        return $hist;
    }

    public static function data(){
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/Governorates';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $cities = $firebase->get($DEFAULT_PATH);
        $cities = json_decode($cities,true);
        $title = "System Agents";
        return $cities;
    }

    public static function drivers(){
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/DriversInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $cities = $firebase->get($DEFAULT_PATH);
        $cities = json_decode($cities,true);
        $title = "System Agents";
        return $cities;
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user->able(1)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        // create curl resource
        $ch = curl_init();

        // set url
        // curl_setopt($ch, CURLOPT_URL, "https://wasalni-225100.firebaseio.com/DriversInformation.json");
        curl_setopt($ch, CURLOPT_URL, "https://taxi-c503a.firebaseio.com/DriversInformation.json");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        $drivers = json_decode($output,true);
        $title = "System Drivers";
        $cities = static::data();

        return view('Admin.drivers.index', compact('drivers','title', 'user', 'cities'));
    }

    public function add()
    {
        $user = auth()->user();
        if (!$user->able(2)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $cities = self::data();

        return view('Admin.drivers.add', compact('user', 'cities'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(2)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/DriversInformation/'.$request->phone;
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $image = "";
        if (!empty($request->driver_image)) {
            $image = $request->driver_image;
        }
        $data = [
            "car_Color" => $request->car_Color,
            "car_Model" => $request->car_Model,
            "car_Number"=> $request->car_Number,
            "first_Name"=> $request->first_Name,
            "last_Name" => $request->last_Name,
            "password"  => $request->password,
            "phone"     => $request->phone,
            "image_url" => $image,
            "rates" => $request->rate,
            'city' => $request->city,
            'carType' => $request->car_type,
            "wallet_balance" => (float) $request->wallet_balance,
        ];
        if ($user->is_agent){
            $log = new Log;
            $log->agent = $user->name;
            $log->action = "Added new Driver with name : $request->first_name and phone : $request->phone";
            $log->save();
        }
        $firebase->set($DEFAULT_PATH.'/'.$key, $data);
        return redirect()->route('drivers')->with('success', 'Driver updated successfully');
    }

    public function delete(Request $request, $key)
    {
        $user = auth()->user();
        if (!$user->able(4)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/DriversInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $firebase->delete($DEFAULT_PATH.'/'.$key);
        if ($user->is_agent){
            $log = new Log;
            $log->agent = $user->name;
            $log->action = "Deleted Driver";
            $log->save();
        }
        return response()->json('success');
    }

    public function driver(Request $request)
    {
        $key = $request->key;
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://taxi-c503a.firebaseio.com/DriversInformation.json");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        $drivers = json_decode($output,true);
        foreach ($drivers as $driver) {
            if ($driver['phone'] == $key) {
                $driver = $driver;
                break;
            }
        }
        return $driver;
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(3)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/DriversInformation';
        $image = "";
        $driver = $this->driver($request);
        $current_wallet_balance = $driver['wallet_balance'];
        $new_wb = $current_wallet_balance + (float) $request->wb_new;
        if (!empty($request->driver_image)) {
            $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

            $data = [
                "car_Color" => $request->color,
                "car_Model" => $request->model,
                "car_Number"=> $request->number,
                "first_Name"=> $request->first_name,
                "last_Name" => $request->last_name,
                "password"  => $request->password,
                "phone"     => $request->phone,
                "image_url" => $request->driver_image,
                "rates" => $request->rate,
                'city' => $request->city,
                'carType' => $request->car_type,
                'last_payment' => $request->last_payment,
                'last_payment_date' => $request->last_payment_date,
                'remaining' => $request->remaining,
                "wallet_balance" => $new_wb,
            ];
            $firebase->update($DEFAULT_PATH.'/'.$key, $data);
        }else{
            $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
            $data = [
                "car_Color" => $request->color,
                "car_Model" => $request->model,
                "car_Number"=> $request->number,
                "first_Name"=> $request->first_name,
                "last_Name" => $request->last_name,
                "password"  => $request->password,
                "phone"     => $request->phone,
                "rates" => $request->rate,
                "city" => $request->city,
                'carType' => $request->car_type,
                'last_payment' => $request->last_payment,
                'last_payment_date' => $request->last_payment_date,
                'remaining' => $request->remaining,
                "wallet_balance" => $new_wb,
            ];
            $firebase->update($DEFAULT_PATH.'/'.$key, $data);
        }
        if ($user->is_agent){
            $log = new Log;
            $log->agent = $user->name;
            $log->action = "updated Driver, name : $request->first_name and phone : $request->phone";
            $log->save();
        }
        return redirect()->back()->with('success', 'Driver updated successfully');
    }
    
    public function updateDeserved(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(3)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $key = $request->key;
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/DriversInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $data = [
            "deserved" => (double) $request->deserved,
        ];
        $firebase->update($DEFAULT_PATH.'/'.$key, $data);
        return redirect()->back()->with('success', 'Driver updated successfully');
    }

    public function show($key)
    {
        $user = auth()->user();
        if (!$user->able(1)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
        $DEFAULT_URL = 'https://taxi-c503a.firebaseio.com/';
        $DEFAULT_TOKEN = 'QJsf6NkBs2bCRrN15pkt7TI5NK8p4trQXnFOGjxq';
        $DEFAULT_PATH = '/DriversInformation';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $earnings = $this->earnings($key);
        // return $earnings;
        $drivers = $firebase->get($DEFAULT_PATH.'/'.$key);
        $driver = json_decode($drivers,true);
        $firstname = $driver['first_Name'];
        $lastname = $driver['last_Name'];
        $image = $driver['image_url'];
        $phone = $driver['phone'];
        $rate = $driver['rates'];
        $color = $driver['car_Color'];
        $model = $driver['car_Model'];
        $number = $driver['car_Number'];
        $wallet_balance = $driver['wallet_balance'];
        $DEFAULT_PATH = '/TripsHistory';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $hist = [];
        $counter = 0;
        $history = $firebase->get($DEFAULT_PATH);
        $trips = json_decode($history,true);
        // return $trips;
        $DEFAULT_PATH = '/RateDetails';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
        $rates = $firebase->get($DEFAULT_PATH.'/'.$key);
        $rates = json_decode($rates,true);
        $riders = new RiderController;
        $riders = $riders::data();
        // return $rates;
        $money = 0;
        $keys = [];
        $tr = [];
        $money += $driver['remaining'] ?? 0;
        // if(isset($rates)){
            foreach ($trips as $k => $trip) {
//                return $trip;
                if (isset($trip['driver'])) {
                    if ($trip['driver'] == $key) {
                        $substring = substr($trip['date'], strrpos($trip['date'],' ')+1, strpos($trip['date'],'/'));
                        $substring = substr($substring, 0, strpos($substring, ','));
                        $substring = str_replace('/', '-', $substring);
                        $tripdate = date('Y-m-d', strtotime($substring));

                        if (isset($driver['last_payment_date'])){
                            $lastPay = date('Y-m-d', strtotime($driver['last_payment_date']));
                            if ($lastPay < $tripdate){
                                array_push($keys, $k);
//                                return [$lastPay, $tripdate];
//                                array_push($tr, $trip);
                                if (isset($trip['cashPaymentValue'])){
                                    $money += $trip['cashPaymentValue'] - $trip['walletPaymentValue'] ?? 0;
                                }else{
//                                    $money += 0;
                                }
                            }
                        }else{
                            if (isset($trip['cashPaymentValue'])){
                                $money += $trip['cashPaymentValue'] - $trip['walletPaymentValue'] ?? 0;
                            }elseif (isset($trip['walletPaymentValue'])){
                                $money -= $trip['walletPaymentValue'];
                            }else{
                                $money += 0;
                            }
                        }
                        $trip['key'] = $k;
                        $hist[$counter] = $trip;
                        if(isset($rates)){
                            foreach ($rates as $ratee) {
                                if (!empty($ratee['trip_id'])) {
                                    if ($ratee['trip_id'] == $k) {
                                        $hist[$counter]['trip_rate'] = $ratee;
                                    }
                                }
                            }
                        }
                        
                        $counter++;
                    }
                }
            }
        // }
        if (sizeof($hist) < 1) {
            foreach ($trips as $k => $value) {
                // return $value;
                if (isset($value['driver'])) {
                    if ($value['driver'] == $key) {
                        // $value['key'] = $k;
                        $hist[$k] = $value;
                    }
                }
                // $hist[$key] = $value;
            }
        }
        // return ($hist);
        $drivers = new DriverController;
        $drivers = $drivers::drivers();
        return view('Admin.drivers.show', compact('keys','firstname','riders','drivers',  'lastname','image','phone','rate','color','model','number','hist','earnings', 'user', 'money','wallet_balance'));
    }

    public function earnings($driverKey)
    {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://taxi-c503a.firebaseio.com/TripsHistory.json");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        $trips = json_decode($output,true);
//        dd($trips);
        $today = date('j/n');
        $thisMonth = date('m');
        $thisYear = date('Y');

        $moneyToday = 0;
        $moneyMonth = 0;
        $moneyYear = 0;
        $moneyWeek = 0;

        $cashToday = 0;
        $cashMonth = 0;
        $cashYear = 0;
        $cashWeek = 0;

        $outstandingToday = 0;
        $outstandingMonth = 0;
        $outstandingYear = 0;
        $outstandingWeek = 0;

        $format = "d/m";
        $monthFormat = "m";
        $date1  = \DateTime::createFromFormat($format, $today);
        $dateMonth = \DateTime::createFromFormat($monthFormat, $today);
        foreach ($trips as $driver) {
            if (isset($driver['driver'])) {
                if ($driver['driver'] == $driverKey) {
                    $date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
                    $date = trim(substr($date, 0,strpos($date, ",")-5));
                    if ($today == $date) {
                        // dd($date);

                        $moneyToday += trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1));
                        $cashToday += $driver['cashPaymentValue'] ?? 0;
                        if (isset($driver['walletPaymentValue'])){
                            $wVal = $driver['walletPaymentValue'];
                        }else{
                            $wVal = 0;
                        }
                        // $outstandingToday  += ($wVal - round(((trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1))*15)/100),2)) - $driver['cashPaymentValue'] ?? 0;
                        $outstandingToday += floor(($driver['totalPaymentValue'] - $driver['cashPaymentValue'] ?: $driver['totalPaymentValue']) - (($driver['totalPaymentValue']*15)/100));
                    }
                }
            }

        }
        foreach ($trips as $key => $driver) {
            if (isset($driver['driver'])) {
                if ($driver['driver'] == $driverKey) {
                    $date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
                    $date = trim(substr($driver['date'], strpos($driver['date'], "/") + 1));
                    $date = trim(substr($date, 0,strpos($date, '/')));
                    $date2  = \DateTime::createFromFormat($monthFormat, $date);
                    if ($date == ltrim($thisMonth)) {
                        $moneyMonth += trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1));
                        $cashMonth += $driver['cashPaymentValue'] ?? 0;
                        if (isset($driver['walletPaymentValue'])){
                            $wVal = $driver['walletPaymentValue'];
                        }else{
                            $wVal = 0;
                        }
                        // $outstandingMonth  += ($wVal - round(((trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1))*15)/100),2)) - $driver['cashPaymentValue'] ?? 0;
                        $outstandingMonth += floor(($driver['totalPaymentValue'] - $driver['cashPaymentValue'] ?: $driver['totalPaymentValue']) - (($driver['totalPaymentValue']*15)/100));
                    }
                }
            }
        }
        foreach ($trips as $key => $driver) {
            if (isset($driver['driver'])) {
                if ($driver['driver'] == $driverKey) {
                    // $date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
                    // $date = trim(substr($driver['date'], strpos($driver['date'], "/") + 1));
                    // $date = trim(substr($date, strpos($date, '/')+1));
                    // $date = substr($date, 0, strpos($date, ','));

                    $date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
                    $date = substr($date, 0, strpos($date, ','));
                    $dateEntered = \DateTime::createFromFormat('d/m/Y', $date);

                    // dd($date);
                    $todaysDate = new \DateTime();
                    $maxBookingDate = new \DateTime('-1 year');
                                        
                    if ($dateEntered < $todaysDate && $dateEntered > $maxBookingDate) {
                        try {
                            $moneyYear += trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1));
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                        $cashYear += $driver['cashPaymentValue'] ?? 0;
                        if (isset($driver['walletPaymentValue'])){
                            $wVal = $driver['walletPaymentValue'];
                        }else{
                            $wVal = 0;
                        }
                        if (isset($driver['cashPaymentValue'])){
                            $cP = $driver['cashPaymentValue'];
                        }else{
                            $cP = 0;
                        }
                        // $outstandingYear  += ($wVal - round(((trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1))*15)/100),2)) - $cP;
                        $outstandingYear += floor(($driver['totalPaymentValue'] - $cP ?: $driver['totalPaymentValue']) - (($driver['totalPaymentValue']*15)/100));;
                    }
                }
            }
        }
        $todaysDate = new \DateTime();
        $maxBookingDate = new \DateTime('-1 weeks');

        foreach ($trips as $key => $driver) {
            if (isset($driver['driver'])) {
                if ($driver['driver'] == $driverKey) {
                    $date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
                    $date = trim(substr($driver['date'], strpos($driver['date'], ",") + 1));
                    $date = substr($date, 0, strpos($date, ','));
                    $dateEntered = \DateTime::createFromFormat('d/m/Y', $date);
                    // dd($dateEntered);
                    if ($dateEntered < $todaysDate && $dateEntered > $maxBookingDate){
                        $moneyWeek += trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1));
                        $cashWeek += $driver['cashPaymentValue'] ?? 0;
                        if (isset($driver['walletPaymentValue'])){
                            $wVal = $driver['walletPaymentValue'];
                        }else{
                            $wVal = 0;
                        }
                        // $outstandingWeek += ($wVal - round(((trim(substr($driver['estimatedPayout'],0, strpos($driver['estimatedPayout'], " ") + 1))*15)/100),2)) - $driver['cashPaymentValue'] ?? 0;
                        $outstandingWeek += floor(($driver['totalPaymentValue'] - $driver['cashPaymentValue'] ?: $driver['totalPaymentValue']) - (($driver['totalPaymentValue']*15)/100));;
                    }
                }
            }
        }
        return ['today' => $moneyToday, 'month' => $moneyMonth, 'year' => $moneyYear, 'week' => $moneyWeek, 'cashToday' => $cashToday,
            'cashWeek' => $cashWeek, 'cashYear' => $cashYear, 'cashMonth' => $cashMonth, 'outstandingToday' => $outstandingToday,
            'outstandingWeek' => $outstandingWeek, 'outstandingYear' => $outstandingYear, 'outstandingMonth' => $outstandingMonth];
    }
}
