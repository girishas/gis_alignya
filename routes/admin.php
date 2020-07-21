<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::any('/', array('as'=>'users.login', 'uses'=>'UserController@login'));
Route::any('page-not-found',array('uses'=>'PageController@page_not_found'));
Route::any('/login', array('as'=>'users.login', 'uses'=>'UserController@login'));
Route::any('/register', array('as'=>'users.login', 'uses'=>'UserController@register'));
Route::any('/forgot-password', array('as'=>'users.forgot_password', 'uses'=>'UserController@forgot_password'));
Route::any('/dashboard', array('as'=>'users.dashboard', 'uses'=>'UserController@dashboard'));
Route::any('/account', array('as'=>'users.account', 'uses'=>'UserController@account'));
Route::any('/logout', array('as'=>'users.logout', 'uses'=>'UserController@logout'));
Route::any('search', array('as'=>'users.search', 'uses'=>'UserController@search'));
Route::any('follow-user/{username?}', array('as'=>'users.follow_user', 'uses'=>'UserController@follow_user'));
Route::any('unfollow-user/{username?}', array('as'=>'users.unfollow_user', 'uses'=>'UserController@unfollow_user'));
Route::any('/messages/{username?}', array('as'=>'messages.index', 'uses'=>'ConversationController@messages'));
Route::any('/groups/{slug?}', array('as'=>'messages.groups', 'uses'=>'ConversationController@groups'));
Route::any('/discover-groups/{slug?}', array('as'=>'messages.groups', 'uses'=>'ConversationController@discover_groups'));
Route::any('/group-request', array('as'=>'messages.all_group_requests', 'uses'=>'ConversationController@all_group_requests'));
Route::any('subscription-plans', array('as'=>'users.subscription_plans', 'uses'=>'DepartmentController@subscription_plans'));
Route::any('perspective', array('as'=>'users.perspective', 'uses'=>'DepartmentController@perspective'));
Route::any('subscription-plan/update/{id?}', array('as'=>'users.subscription_plan_update', 'uses'=>'DepartmentController@subscription_plan_update'));
Route::any('perspective/update/{id?}', array('as'=>'users.perspective_update', 'uses'=>'DepartmentController@perspective_update'));
Route::any('/perspective/add', array('as'=>'users.perspective_add', 'uses'=>'DepartmentController@perspective_add'));
Route::any('/perspective/remove/{id?}', array('as'=>'users.perspective_remove', 'uses'=>'DepartmentController@perspective_remove'));

Route::get('notifications', array('as'=>'posts.notifications', 'uses'=>'PostController@notifications'));


Route::any('companies', array('as'=>'users.companies', 'uses'=>'UserController@companies'));
Route::any('company/update/{id?}', array('as'=>'users.company_update', 'uses'=>'UserController@company_update'));
Route::any('company/view/{id?}', array('as'=>'users.company_view', 'uses'=>'UserController@company_view'));
Route::any('company/add', array('as'=>'users.company_add', 'uses'=>'UserController@company_add'));

Route::any('members/changepassword/{role_id?}/{user_id?}', array('as'=>'users.admin_changepassword', 'uses'=>'UserController@admin_changepassword'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+');

Route::any('members/new', array('as'=>'users.admin_add', 'uses'=>'UserController@admin_add'));
Route::any('members/remove/{role_id?}/{user_id?}', array('as'=>'users.admin_remove', 'uses'=>'UserController@admin_remove'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+'); 
Route::any('members/status/{role_id?}/{user_id?}', array('as'=>'users.admin_status', 'uses'=>'UserController@admin_status'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+');
Route::any('members/update/{user_id?}', array('as'=>'users.admin_edit', 'uses'=>'UserController@admin_edit'))->where('user_id', '[0-9]+');
Route::any('delete-members-photo', array('as'=>'users.admin_delete_photo', 'uses'=>'UserController@admin_delete_photo'));
Route::any('/{username?}/profile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('/{username?}/update-profile', array('as'=>'users.update_profile', 'uses'=>'UserController@update_profile'));
Route::any('/{username?}/change-password', array('as'=>'users.change_password', 'uses'=>'UserController@change_password'));
Route::any('/members-chnagepassword/{username?}', array('as'=>'users.admin_changepassword', 'uses'=>'UserController@admin_changepassword'));


//Teams
Route::any('teams', array('as'=>'admin.users', function(){ 
							return App::make('App\Http\Controllers\TeamController')->admin_index(2); }));
Route::any('members/changepassword/{role_id?}/{user_id?}', array('as'=>'users.admin_changepassword', 'uses'=>'UserController@admin_changepassword'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+');

Route::any('teams/new', array('as'=>'users.admin_add', 'uses'=>'TeamController@admin_add'));
Route::any('members/remove/{role_id?}/{user_id?}', array('as'=>'users.admin_remove', 'uses'=>'UserController@admin_remove'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+'); 
Route::any('members/status/{role_id?}/{user_id?}', array('as'=>'users.admin_status', 'uses'=>'UserController@admin_status'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+');
Route::any('teams/update/{id?}', array('as'=>'users.admin_edit', 'uses'=>'TeamController@admin_edit'))->where('id', '[0-9]+');
Route::any('delete-members-photo', array('as'=>'users.admin_delete_photo', 'uses'=>'UserController@admin_delete_photo'));
Route::any('/{username?}/profile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('/{username?}/update-profile', array('as'=>'users.update_profile', 'uses'=>'UserController@update_profile'));
Route::any('/{username?}/change-password', array('as'=>'users.change_password', 'uses'=>'UserController@change_password'));
Route::any('/members-chnagepassword/{username?}', array('as'=>'users.admin_changepassword', 'uses'=>'UserController@admin_changepassword'));



Route::any('/badges', array('as'=>'pages.admin_badges', 'uses' => 'PageController@admin_badges'));

Route::any('/pages', array('as'=>'pages.admin_index', 'uses' => 'PageController@admin_index'));
Route::any('/page-status/{id?}', array('as'=>'pages.admin_status', 'uses' => 'PageController@admin_status'));
Route::any('/page-remove/{id?}', array('as'=>'pages.admin_remove', 'uses' => 'PageController@admin_remove'));
Route::any('/add-new-page', array('as'=>'pages.admin_add', 'uses' => 'PageController@admin_add'));
Route::any('/update-page/{slug?}/{l_id?}', array('as'=>'pages.admin_edit', 'uses' => 'PageController@admin_edit'));



//Templates
Route::any('templates/add', array('as'=>'templates.admin_add', 'uses'=>'TemplateController@admin_add'));
Route::any('templates', array('as'=>'templates.admin_index', 'uses'=>'TemplateController@admin_index'));
Route::any('templates/edit/{slug?}', array('as'=>'templates.admin_edit', 'uses'=>'TemplateController@admin_edit'));
Route::any('templates/view/{slug?}', array('as'=>'templates.admin_view', 'uses'=>'TemplateController@admin_view'));
//End Templates



//NOTE : This route should be last don't put anything below this route. All the other route should be defined above this Line
Route::any('/{username}', array('as'=>'users.profile', 'uses'=>'UserController@profile'));