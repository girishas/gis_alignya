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
Route::any('members/new', array('as'=>'users.admin_add', 'uses'=>'UserController@admin_add'));
Route::any('members/update/{user_id?}', array('as'=>'users.admin_edit', 'uses'=>'UserController@admin_edit'))->where('user_id', '[0-9]+');
Route::any('members', array('as'=>'admin.users', function(){ 
							return App::make('App\Http\Controllers\UserController')->admin_index(2); }));
Route::any('teams/new', array('as'=>'users.admin_add', 'uses'=>'TeamController@admin_add'));
Route::any('teams/update/{id?}', array('as'=>'users.admin_edit', 'uses'=>'TeamController@admin_edit'))->where('id', '[0-9]+');
Route::any('teams', array('as'=>'admin.users', function(){ 
							return App::make('App\Http\Controllers\TeamController')->admin_index(2); }));
Route::any('department/new/{id?}', array('as'=>'department.admin_add', 'uses'=>'DepartmentController@admin_add'));
Route::any('department/update/{id?}', array('as'=>'department.admin_edit', 'uses'=>'DepartmentController@admin_edit'))->where('id', '[0-9]+');
Route::any('departments', array('as'=>'admin.department', function(){ 
							return App::make('App\Http\Controllers\DepartmentController')->admin_index(2); }));

Route::any('objectives', array('as'=>'admin.objectives', function(){ 
							return App::make('App\Http\Controllers\ObjectiveController')->admin_index(2); }));
Route::any('kpis', array('as'=>'admin.measures', 'uses'=>'ObjectiveController@measures' ));
Route::any('measures', array('as'=>'admin.measure', 'uses'=>'ObjectiveController@measure' ));
Route::any('initiatives', array('as'=>'admin.initiatives', 'uses'=>'ObjectiveController@initiatives'));

Route::any('reports', array('as'=>'users.reports', 'uses'=>'TeamController@reports'));
Route::any('ideas', array('as'=>'users.ideas', 'uses'=>'TeamController@ideas'));
Route::any('department/{id?}', array('as'=>'users.admin_index', 'uses'=>'DepartmentController@admin_index'));
Route::any('profile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('addDepartmentForm', array('as'=>'users.addDepartmentForm', 'uses'=>'DepartmentController@addDepartmentForm'));
Route::any('getprofiledata', array('as'=>'users.getprofiledata', 'uses'=>'UserController@getprofiledata'));
Route::any('update-profile', array('as'=>'users.update_profile', 'uses'=>'UserController@update_profile'));
Route::any('subscription', array('as'=>'users.subscription', 'uses'=>'DepartmentController@subscription'));
Route::any('invoice', array('as'=>'users.invoice', 'uses'=>'DepartmentController@invoice'));
Route::any('tree', array('as'=>'users.tree', 'uses'=>'DepartmentController@tree'));
Route::any('timemap', array('as'=>'users.timemap', 'uses'=>'DepartmentController@timemap'));
Route::any('departmental', array('as'=>'users.departmental', 'uses'=>'DepartmentController@departmental'));
Route::any('supports', array('as'=>'users.supports', 'uses'=>'DepartmentController@supports'));
Route::any('notifications', array('as'=>'users.notifications', 'uses'=>'DepartmentController@notifications'));
Route::any('team', array('as'=>'users.team', 'uses'=>'TeamController@team'));
Route::any('scorecard', array('as'=>'users.scorecard', 'uses'=>'TeamController@scorecard'));
Route::any('strategic-map', array('as'=>'users.startegic_map', 'uses'=>'TeamController@startegic_map'));

Route::any('auth/{provider?}', 'UserController@redirectToProvider');
Route::any('auth/{provider?}/callback', 'UserController@handleProviderCallback');
Route::any('/login', array('as'=>'users.login', 'uses'=>'UserController@login'));
Route::any('/register', array('as'=>'users.login', 'uses'=>'UserController@register'));
Route::any('/forgot-password', array('as'=>'users.forgot_password', 'uses'=>'UserController@forgot_password'));
Route::any('/dashboard', array('as'=>'users.dashboard', 'uses'=>'UserController@dashboard'));
Route::any('/account', array('as'=>'users.account', 'uses'=>'UserController@account'));
Route::any('/logout', array('as'=>'users.logout', 'uses'=>'UserController@logout'));
Route::any('/resetpassword/{slug?}', array('as'=>'users.resetpassword', 'uses'=>'UserController@resetpassword'));
Route::any('verify-mail/{slug?}',array('uses'=>'UserController@verifyMail'));
Route::any('search', array('as'=>'users.search', 'uses'=>'UserController@search'));
Route::any('follow-user/{username?}', array('as'=>'users.follow_user', 'uses'=>'UserController@follow_user'));
Route::any('unfollow-user/{username?}', array('as'=>'users.unfollow_user', 'uses'=>'UserController@unfollow_user'));


Route::any('/{username}', array('as'=>'users.profile', 'uses'=>'UserController@profile'));