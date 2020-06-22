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

Route::get('notifications', array('as'=>'posts.notifications', 'uses'=>'PostController@notifications'));


Route::any('users', array('as'=>'admin.users', function(){ 
							return App::make('App\Http\Controllers\UserController')->admin_index(2); }));
Route::any('users/changepassword/{role_id?}/{user_id?}', array('as'=>'users.admin_changepassword', 'uses'=>'UserController@admin_changepassword'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+');

Route::any('users/new', array('as'=>'users.admin_add', 'uses'=>'UserController@admin_add'));
Route::any('users/remove/{role_id?}/{user_id?}', array('as'=>'users.admin_remove', 'uses'=>'UserController@admin_remove'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+'); 
Route::any('users/status/{role_id?}/{user_id?}', array('as'=>'users.admin_status', 'uses'=>'UserController@admin_status'))->where('role_id', '[0-9]+')->where('user_id', '[0-9]+');
Route::any('users/update/{user_id?}', array('as'=>'users.admin_edit', 'uses'=>'UserController@admin_edit'))->where('user_id', '[0-9]+');
Route::any('delete-user-photo', array('as'=>'users.admin_delete_photo', 'uses'=>'UserController@admin_delete_photo'));
Route::any('/{username?}/profile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('/{username?}/update-profile', array('as'=>'users.update_profile', 'uses'=>'UserController@update_profile'));
Route::any('/{username?}/change-password', array('as'=>'users.change_password', 'uses'=>'UserController@change_password'));
Route::any('/users-chnagepassword/{username?}', array('as'=>'users.admin_changepassword', 'uses'=>'UserController@admin_changepassword'));



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

//Languages
Route::any('languages/add', array('as'=>'settings.admin_add_language', 'uses'=>'SettingController@admin_add_language'));
Route::any('languages', array('as'=>'settings.admin_languages', 'uses'=>'SettingController@admin_languages'));
Route::any('languages/edit/{slug?}', array('as'=>'settings.admin_edit_language', 'uses'=>'SettingController@admin_edit_language'));
Route::any('languages/status/{id?}', array('as'=>'settings.admin_language_status', 'uses'=>'SettingController@admin_language_status'));

Route::any('settings', array('as'=>'settings.admin_update', 'uses'=>'SettingController@admin_update'));

//Badges
Route::any('badges/add', array('as'=>'badges.admin_add_badges', 'uses'=>'SettingController@admin_add_badges'));
Route::any('badges', array('as'=>'badges.admin_badges', 'uses'=>'SettingController@admin_badges'));
Route::any('badges/edit/{slug?}', array('as'=>'badges.admin_edit_badges', 'uses'=>'SettingController@admin_edit_badges'));
Route::any('badges/status/{id?}', array('as'=>'badges.admin_language_status', 'uses'=>'SettingController@admin_language_status'));

//labels
Route::any('labels/add', array('as'=>'labels.admin_add_labels', 'uses'=>'SettingController@admin_add_labels'));
Route::any('labels', array('as'=>'labels.admin_labels', 'uses'=>'SettingController@admin_labels'));
Route::any('labels/edit/{slug?}', array('as'=>'labels.admin_edit_labels', 'uses'=>'SettingController@admin_edit_labels'));
Route::any('labels/status/{id?}', array('as'=>'labels.admin_labels_status', 'uses'=>'SettingController@admin_labels_status'));


//Page Imagas
Route::any('page_images/add', array('as'=>'page_images.admin_add_page_images', 'uses'=>'SettingController@admin_add_page_images'));
Route::any('page_images', array('as'=>'page_images.admin_page_images', 'uses'=>'SettingController@admin_page_images'));
Route::any('/page_images-remove/{id?}', array('as'=>'page_images.admin_remove_page_images', 'uses' => 'SettingController@admin_remove_page_images'));
Route::any('page_images/edit/{slug?}', array('as'=>'page_images.admin_edit_page_images', 'uses'=>'SettingController@admin_edit_page_images'));
Route::any('page_images/status/{id?}', array('as'=>'page_images.admin_page_images_status', 'uses'=>'SettingController@admin_page_images_status'));

//Page Imagas
Route::any('testimonials/add', array('as'=>'testimonials.admin_add_testimonials', 'uses'=>'SettingController@admin_add_testimonials'));
Route::any('/testimonials-remove/{id?}', array('as'=>'testimonials.admin_remove_testimonials', 'uses' => 'SettingController@admin_remove_testimonials'));
Route::any('testimonials', array('as'=>'testimonials.admin_testimonials', 'uses'=>'SettingController@admin_testimonials'));
Route::any('testimonials/edit/{slug?}', array('as'=>'testimonials.admin_edit_testimonials', 'uses'=>'SettingController@admin_edit_testimonials'));
Route::any('testimonials/status/{id?}', array('as'=>'testimonials.admin_testimonials_status', 'uses'=>'SettingController@admin_testimonials_status'));

//Faqs
Route::any('faqs/add', array('as'=>'faqs.admin_add_faqs', 'uses'=>'SettingController@admin_add_faqs'));
Route::any('faqs', array('as'=>'faqs.admin_faqs', 'uses'=>'SettingController@admin_faqs'));
Route::any('/faqs-remove/{id?}', array('as'=>'faqs.admin_remove', 'uses' => 'SettingController@admin_remove'));
Route::any('faqs/edit/{slug?}', array('as'=>'faqs.admin_edit_faqs', 'uses'=>'SettingController@admin_edit_faqs'));
Route::any('faqs/status/{id?}', array('as'=>'faqs.admin_faqs_status', 'uses'=>'SettingController@admin_faqs_status'));

Route::any('ajaxfileupload',array('uses'=>'PostController@ajaxfileupload'));
Route::any('more-comments/{post_id?}',array('uses'=>'PostController@load_more_comments'));

Route::any('post-remove/{slug?}',array('uses'=>'PostController@remove_post'));
Route::any('comment-remove/{slug?}',array('uses'=>'PostController@remove_comment'));



//Subscriptions
Route::any('subscriptions/add', array('as'=>'subscriptions.admin_add_subscriptions', 'uses'=>'SubscriptionController@admin_add_subscriptions'));
Route::any('subscriptions', array('as'=>'subscriptions.admin_subscriptions', 'uses'=>'SubscriptionController@admin_subscriptions'));
Route::any('/subscriptions-remove/{id?}', array('as'=>'subscriptions.admin_remove', 'uses' => 'SubscriptionController@admin_remove'));
Route::any('subscriptions/edit/{slug?}', array('as'=>'subscriptions.admin_edit_subscriptions', 'uses'=>'SubscriptionController@admin_edit_subscriptions'));
Route::any('subscriptions/status/{id?}', array('as'=>'subscriptions.admin_subscriptions_status', 'uses'=>'SubscriptionController@admin_subscriptions_status'));

//Subscription Level
Route::any('subscriptionlevel/add', array('as'=>'subscriptionlevel.admin_add_subscriptionlevel', 'uses'=>'SubscriptionController@admin_add_subscriptionlevel'));
Route::any('subscriptionlevel', array('as'=>'subscriptionlevel.admin_subscriptionlevel', 'uses'=>'SubscriptionController@admin_subscriptionlevel'));
Route::any('/subscriptionlevel-remove/{id?}', array('as'=>'subscriptionlevel.admin_remove_subscriptionlevel', 'uses' => 'SubscriptionController@admin_remove_subscriptionlevel'));
Route::any('subscriptionlevel/edit/{slug?}', array('as'=>'subscriptionlevel.admin_edit_subscriptionlevel', 'uses'=>'SubscriptionController@admin_edit_subscriptionlevel'));
Route::any('subscriptionlevel/status/{id?}', array('as'=>'subscriptionlevel.admin_subscriptionlevel_status', 'uses'=>'SubscriptionController@admin_subscriptionlevel_status'));

//NOTE : This route should be last don't put anything below this route. All the other route should be defined above this Line
Route::any('/{username?}/myprofile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('/{username}', array('as'=>'posts.index', 'uses'=>'PostController@index'));