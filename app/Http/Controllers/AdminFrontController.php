<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Team;
use Storage;
use App\Feature;
use App\Screen;

class AdminFrontController extends Controller
{
    public function settings()
    {
        $user = auth()->user();
        if (!$user->able(9)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$settings = Setting::first();
    	return view('Admin.front.settings', compact('settings', 'user'));
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(10)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$main_title = $request->main_title;
    	$main_title_extend = $request->main_title_extend;
    	$main_description = $request->main_description;
    	$google_play_url = $request->google_play_url;
    	$description_title = $request->description_title;
    	$description = $request->description;
        $street = $request->street;
        $country = $request->country;
        $gov = $request->gov;
        $mobile = $request->mobile;
        $email = $request->email;
        $about = $request->about;
        $facebook = $request->facebook;
        $linkedin = $request->linkedin;
        $twitter = $request->twitter;
        $github = $request->github;
        $cover_image = $request->cover_image;

    	$settings = Setting::first();
    	$settings->main_title = $main_title; 
    	$settings->main_title_extend = $main_title_extend; 
    	$settings->main_description = $main_description; 
    	$settings->google_play_url = $google_play_url; 
    	$settings->description_title = $description_title; 
    	$settings->description = $description; 
        $settings->street = $street;
        $settings->country = $country;
        $settings->gov = $gov;
        $settings->mobile = $mobile;
        $settings->email = $email;
        $settings->about = $about;
        $settings->facebook = $facebook;
        $settings->linkedin = $linkedin;
        $settings->twitter = $twitter;
        $settings->github = $github;
        if($request->has('cover_image')){
            $url = env('APP_LIVE');
       	    $path = Storage::putFile('cover', $request->file('cover_image'));
            $settings->cover_image= $url.$path;
        }
    	$settings->save();
    	return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function team()
    {
        $user = auth()->user();
        if (!$user->able(11)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$team = Team::get();
    	$title = "Team members";
    	return view('Admin.front.team.index', compact('team','title', 'user'));
    }
    public function deleteTeamMember(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(13)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$id = $request->key;
    	Team::where('id', $id)->delete();
    	return "Team member deleted successfully.";
    }

    public function getMember(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(11)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$id = $request->key;
    	$member = Team::where('id', $id)->first();
    	return $member;
    }

    public function updateMember(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(14)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$name = $request->name;
    	$description = $request->description;
    	$fb_url = $request->fb_url;
    	$tw_url = $request->tw_url;
    	$photo = $request->photo;
    	$member = $request->id;
    	$url = env('APP_LIVE');
    	$path = Storage::putFile('members', $request->file('mem-image'));
    	$mem = Team::where('id', $member)->first();
    	$mem->name = $name;
    	$mem->description = $description;
    	$mem->fb_url = $fb_url;
    	$mem->tw_url = $tw_url;
    	if ($request->has('photo')) {
    		$mem->image = $url.$path;
    	}
    	
    	$mem->save();
    	return redirect()->back()->with('success', "Team member updated successfully.");
    }

    public function addMember()
    {
        $user = auth()->user();
        if (!$user->able(12)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	return view('Admin.front.team.add', compact('user'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(12)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$member = new Team;
    	$name = $request->name;
    	$fb_url = $request->fb_url;
    	$tw_url = $request->tw_url;
    	$description = $request->description;
    	$image = $request->image;
    	$url = env('APP_LIVE');
    	if ($request->has('image')) {
    		$path = Storage::putFile('members', $request->file('image'));
    		$member->image = $url.$path;
    	}
    	if ($request->has('fb_url')) {
    		$member->fb_url = $fb_url;
    	}
    	if ($request->has('tw_url')) {
    		$member->tw_url = $tw_url;
    	}
    	$member->name = $name;
    	$member->description = $description;

    	$member->save();
    	return redirect()->route('team')->with('success', 'Team member added successfully.');
    }

    public function features()
    {
        $user = auth()->user();
        if (!$user->able(15)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$features = Feature::get();
    	$title = "Features";
    	return view('Admin.front.features.index', compact('features','title', 'user'));
    }

    public function feature(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(15)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$feature = Feature::where('id', $request->key)->first();
    	return $feature;
    }

    public function addFeature()
    {
        $user = auth()->user();
        if (!$user->able(16)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	return view('Admin.front.features.add', compact('user'));
    }

    public function createFeature(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(16)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$title = $request->title;
    	$description = $request->description;
    	$feature = new Feature;
    	$feature->title = $title;
    	$feature->description = $description;
    	$feature->save();
    	return redirect()->route('features')->with('success', 'New Feature added successfully.');
    }

    public function updateFeature(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(17)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$id = $request->id;
    	$feature = Feature::find($id);
    	$feature->title = $request->title;
    	$feature->description = $request->description;
    	$feature->save();
    	return redirect()->back()->with('success', 'Feature updated successfully.');
    }

    public function deleteFeature(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(18)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$key = $request->key;
    	Feature::where('id', $key)->delete();
    	return "Feature Deleted successfully.";
    }

    public function screens()
    {
        $user = auth()->user();
        if (!$user->able(19)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$screens = Screen::get();
    	$title = "Screens";
    	return view('Admin.front.screens.index', compact('screens', 'title', 'user'));
    }

    public function addScreen()
    {
        $user = auth()->user();
        if (!$user->able(21)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	return view('Admin.front.screens.add', compact('user'));
    }

    public function createScreen(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(21)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$image = $request->image;
    	$url = env('APP_LIVE');
    	$path = Storage::putFile('screens', $request->file('image'));
    	$screen = new Screen;
    	$screen->image = $url.$path;
    	$screen->save();
    	return redirect()->route('screens')->with('success', "Screen added successfully.");
    }

    public function deleteScreen(Request $request)
    {
        $user = auth()->user();
        if (!$user->able(20)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$key = $request->key;
    	Screen::where('id', $key)->delete();
    	return "Deleted successfully.";
    }
}
