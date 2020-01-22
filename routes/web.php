<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', 'FrontController@index');
Route::group(['middleware' => ['auth', 'setlocale']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/drivers', 'DriverController@index')->name('drivers');
	Route::get('/driver/show/{key}', 'DriverController@show')->name('driver.show');
	Route::get('/drivers/add', 'DriverController@add')->name('drivers.new');
	Route::post('/drivers/create', 'DriverController@create')->name('driver.create');
	Route::post('/drivers/delete/{key}', 'DriverController@delete')->name('driver.delete');
	Route::post('/drivers/driver', 'DriverController@driver')->name('driver.get');
	Route::post('/drivers/update', 'DriverController@update')->name('driver.update');
	
	Route::get('/update-deserved', 'DriverController@updateDeserved')->name('driver.update-deserved');

	Route::get('/riders', 'RiderController@index')->name('riders');
	Route::get('/rider/show/{key}', 'RiderController@show')->name('rider.show');
	Route::get('/riders/add', 'RiderController@add')->name('rider.new');
	Route::post('/riders/create', 'RiderController@create')->name('rider.create');
	Route::post('/riders/delete', 'RiderController@delete')->name('rider.delete');
	Route::post('/riders/rider', 'RiderController@rider')->name('rider.get');
	Route::post('/riders/update', 'RiderController@update')->name('rider.update');
	Route::get('test', 'DriverController@earnings');
	Route::get('logout', 'AdminController@logout');

	Route::get('settings', 'AdminFrontController@settings')->name('settings');
	Route::post('settings/update', 'AdminFrontController@updateSettings')->name('settings.update');

	Route::get('team', 'AdminFrontController@team')->name('team');
	Route::POST('team/delete', 'AdminFrontController@deleteTeamMember')->name('team.deleteTeamMember');
	Route::get('team/member', 'AdminFrontController@getMember')->name('team.member');
	Route::POST('member/update', 'AdminFrontController@updateMember')->name('member.update');

	Route::get('team/add', 'AdminFrontController@addMember')->name('member.add');
	Route::post('team/create', 'AdminFrontController@create')->name('member.create');

	Route::get('features', 'AdminFrontController@features')->name('features');
	Route::get('features/add', 'AdminFrontController@addFeature')->name('features.add');
	Route::post('features/create', 'AdminFrontController@createFeature')->name('feature.create');
	Route::get('features/feature', 'AdminFrontController@feature')->name('features.feature');
	Route::POST('feature/update', 'AdminFrontController@updateFeature')->name('feature.update');
	Route::POST('feature/delete', 'AdminFrontController@deleteFeature')->name('feature.delete');

	Route::get('screens', 'AdminFrontController@screens')->name('screens');
	Route::get('screens/add', 'AdminFrontController@addScreen')->name('screens.add');
	Route::post('screens/create', 'AdminFrontController@createScreen')->name('screens.create');
	Route::POST('screen/delete', 'AdminFrontController@deleteScreen')->name('screen.delete');

	Route::get('admins', 'AdminController@admins')->name('admins');
	Route::get('admins/new', 'AdminController@addAdmin')->name('admins.new');
	Route::post('admin/new', 'AdminController@save')->name('admin.create');
	Route::post('admin/delete/{id}', 'AdminController@delete')->name('admin.delete');
	Route::post('admin', 'AdminController@findAdmin')->name('admin.get');
	Route::post('admin/update', 'AdminController@update')->name('admin.update');

	Route::get('agents', 'AgentController@agents')->name('agents');
	Route::get('agents/new', 'AgentController@addAgent')->name('agents.new');
	Route::post('agent/new', 'AgentController@save')->name('agent.create');
	Route::post('agent/delete/{id}', 'AgentController@delete')->name('agent.delete');
	Route::post('agent', 'AgentController@findAgent')->name('agent.get');
	Route::post('agent/update', 'AgentController@update')->name('agent.update');

	Route::get('agents/log', 'AgentController@logs')->name('log');

	Route::get('trips', 'TripsController@index')->name('trips');
	Route::post('trip/update', 'TripsController@update')->name('trip.update');
	Route::post('trip/show/', 'TripsController@show')->name('trip.get');

	Route::get('change-language/{lang}', 'DashboardController@language')->name('change-language');
});
