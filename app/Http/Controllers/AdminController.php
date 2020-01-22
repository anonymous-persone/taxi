<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserPermission;
use Hash;
use App\Http\Requests\CreateAdminRequest;

class AdminController extends Controller
{
    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function addAdmin()
    {
    	$user = auth()->user();
        if (!$user->able(23)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	return view('Admin.Admins.add', compact('user'));
    }

    public function save(CreateAdminRequest $request)
    {
    	$user = auth()->user();
        if (!$user->able(23)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$user = new User;
    	$user->name = $request->name;
    	$user->password = Hash::make($request->password);
    	$user->email = $request->email;
    	if ($user->save()) {
    		if (isset($request->view_drivers)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_drivers;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_driver)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_driver;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_driver)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_driver;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_driver)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_driver;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_riders)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_riders;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_rider)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_rider;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_rider)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_rider;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_rider)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_rider;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_settings)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_settings;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_settings)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_settings;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_team)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_team;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_member)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_member;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_member)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_member;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_member)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_member;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_features)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_features;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_feature)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_feature;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_feature)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_feature;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_feature)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_feature;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		session()->flash('success', 'Permissions granted successfully.');
    		return redirect()->back();
    	}
    }

    public function admins()
    {
    	$user = auth()->user();
        if (!$user->able(22)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$admins = User::get();
    	$title = 'Admins';
    	return view('Admin.Admins.index', compact('admins', 'title', 'user'));
    }

    public function delete($id)
    {
    	$user = auth()->user();
        if (!$user->able(25)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$user = User::where('id', $id)->delete();
    }

    public function findAdmin(Request $request)
    {
    	$user = auth()->user();
        if (!$user->able(22)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$id = $request->key;
    	$user = User::find($id);
    	if (isset($user)) {
    		$user->load('permissions');
    	}
    	return $user;
    }

    public function update(Request $request)
    {
    	$user = auth()->user();
        if (!$user->able(24)) {
            session()->flash('success', 'Sorry you do not have this permission.');
            return redirect()->back();
        }
    	$user = User::find($request->id);
    	UserPermission::where('user_id', $user->id)->delete();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	if ($request->has('password')) {
    		$user->password = Hash::make($request->password);
    	}
    	if ($user->save()) {
    		if (isset($request->view_drivers)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_drivers;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_driver)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_driver;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_driver)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_driver;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_driver)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_driver;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_riders)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_riders;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_rider)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_rider;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_rider)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_rider;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_rider)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_rider;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_settings)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_settings;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_settings)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_settings;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_team)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_team;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_member)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_member;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_member)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_member;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_member)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_member;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_features)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_features;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_feature)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_feature;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->edit_feature)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_feature;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_feature)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_feature;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->view_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->add_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->delete_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->delete_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->delete_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->delete_screen)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_screen;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		if (isset($request->delete_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->delete_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->edit_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->edit_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->add_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->add_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}if (isset($request->view_admin)) {
    			$user_permissions = new UserPermission;
    			$user_permissions->permission_id = $request->view_admin;
    			$user_permissions->user_id = $user->id;
    			$user_permissions->save();
    		}
    		session()->flash('success', 'Permissions granted successfully.');
    		return redirect()->back();
    	}
    }
}
