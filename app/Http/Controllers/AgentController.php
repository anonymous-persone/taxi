<?php

namespace App\Http\Controllers;

use App\Log;
use App\User;
use App\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public static function data(){
        $DEFAULT_URL = 'https://wasalni-225100.firebaseio.com/';
        $DEFAULT_TOKEN = 'xLUBPXPGMt1oOs4RD0AH72riFfdewYnmqPteB26z';
        $DEFAULT_PATH = '/Governorates';
        $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

        $cities = $firebase->get($DEFAULT_PATH);
        $cities = json_decode($cities,true);
        $title = "System Agents";
        return $cities;
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function addAgent()
    {
    	$user = auth()->user();
//        if (!$user->able(27)) {
//            session()->flash('success', 'Sorry you do not have this permission.');
//            return redirect()->back();
//        }
        $cities = self::data();
//        foreach ($cities as $key => $city){
//            foreach ($city as $k => $c){
//                return $c;
//            }
//        }
//        return $cities;
    	return view('Admin.agents.add', compact('user', 'cities'));
    }

    public function save(Request $request)
    {
    	$user = auth()->user();
//        if (!$user->able(27)) {
//            session()->flash('success', 'Sorry you do not have this permission.');
//            return redirect()->back();
//        }
    	$user = new User;
    	$user->name = $request->name;
    	$user->password = Hash::make($request->password);
    	$user->email = $request->email;
    	$user->is_agent = 1;
    	$user->city = $request->city;
    	if ($user->save()) {
			$user_permissions = new UserPermission;
			$user_permissions->permission_id = 1;
			$user_permissions->user_id = $user->id;
			$user_permissions->save();

			$user_permissions = new UserPermission;
			$user_permissions->permission_id = 2;
			$user_permissions->user_id = $user->id;
			$user_permissions->save();

			$user_permissions = new UserPermission;
			$user_permissions->permission_id = 3;
			$user_permissions->user_id = $user->id;
			$user_permissions->save();

			$user_permissions = new UserPermission;
			$user_permissions->permission_id = 4;
			$user_permissions->user_id = $user->id;
			$user_permissions->save();

			$user_permissions = new UserPermission;
			$user_permissions->permission_id = 8;
			$user_permissions->user_id = $user->id;
			$user_permissions->save();

    		session()->flash('success', 'Added successfully.');
    		return redirect()->back();
    	}
    }

    public function agents()
    {
    	$user = auth()->user();
//        if (!$user->able(28)) {
//            session()->flash('success', 'Sorry you do not have this permission.');
//            return redirect()->back();
//        }
        $cities = self::data();
//        return $cities;
    	$admins = User::where('is_agent', 1)->get();
    	$title = 'Agents';
    	return view('Admin.agents.index', compact('admins', 'title', 'user', 'cities'));
    }

    public function delete($id)
    {
    	$user = auth()->user();
        if (!$user->able(30)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$user = User::where('id', $id)->delete();
    }

    public function findAgent(Request $request)
    {
    	$user = auth()->user();
//        if (!$user->able(28)) {
//            session()->flash('success', 'Sorry you do not have this permission.');
//            return redirect()->back();
//        }
    	$id = $request->key;
    	$user = User::find($id);
    	return $user;
    }

    public function update(Request $request)
    {
    	$user = auth()->user();
//        if (!$user->able(29)) {
//            session()->flash('success', 'Sorry you do not have this permission.');
//            return redirect()->back();
//        }
    	$user = User::find($request->id);
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->city = $request->city;
    	if ($request->has('password')) {
    		$user->password = Hash::make($request->password);
    	}
    	$user->save();
    	session()->flash('success', 'Updated successfully');
    	return redirect()->back();
    }

    public function logs(){
        $logs = Log::get();
        $title = "Logs";
        $user = auth()->user();
        return view('Admin.agents.log', compact('logs', 'title', 'user'));
    }
}
