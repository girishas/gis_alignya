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

Route::any('/testmail', array('as'=>'pages.testmail', 'uses'=>'PageController@testmail'));
Route::any('/contactus', array('as'=>'pages.contactus', 'uses'=>'PageController@contactus'));
Route::any('/system-lang', array('as'=>'settings.system_lang', 'uses'=>'SettingController@system_lang'));
Route::any('auth/{provider?}', 'UserController@redirectToProvider');
Route::any('auth/{provider?}/callback', 'UserController@handleProviderCallback');
Route::any('/', array('as'=>'pages.index', 'uses'=>'PageController@index'));
Route::any('/login', array('as'=>'users.login', 'uses'=>'UserController@login'));
Route::any('/register', array('as'=>'users.login', 'uses'=>'UserController@register'));
Route::any('/forgot-password', array('as'=>'users.forgot_password', 'uses'=>'UserController@forgot_password'));
Route::any('/dashboard', array('as'=>'users.dashboard', 'uses'=>'UserController@dashboard'));
Route::any('/account', array('as'=>'users.account', 'uses'=>'UserController@account'));
Route::any('/logout', array('as'=>'users.logout', 'uses'=>'UserController@logout'));
Route::any('/resetpassword/{slug?}', array('as'=>'users.resetpassword', 'uses'=>'UserController@resetpassword'));
Route::any('verify-mail/{slug?}',array('uses'=>'UserController@verifyMail'));
Route::any('page-not-found',array('uses'=>'PageController@page_not_found'));
Route::any('ajaxfileupload',array('uses'=>'PostController@ajaxfileupload'));
Route::any('more-comments/{post_id?}',array('uses'=>'PostController@load_more_comments'));
Route::any('search', array('as'=>'users.search', 'uses'=>'UserController@search'));
Route::any('follow-user/{username?}', array('as'=>'users.follow_user', 'uses'=>'UserController@follow_user'));
Route::any('unfollow-user/{username?}', array('as'=>'users.unfollow_user', 'uses'=>'UserController@unfollow_user'));
Route::any('/messages/{username?}', array('as'=>'messages.index', 'uses'=>'ConversationController@messages'));
Route::any('/groups/{slug?}', array('as'=>'messages.groups', 'uses'=>'ConversationController@groups'));
Route::any('/discover-groups/{slug?}', array('as'=>'messages.groups', 'uses'=>'ConversationController@discover_groups'));
Route::any('/join-group', array('as'=>'messages.join_group', 'uses'=>'ConversationController@join_group'));
Route::any('/join-group-request', array('as'=>'messages.join_group_request', 'uses'=>'ConversationController@join_group_request'));
Route::any('/group-request', array('as'=>'messages.all_group_requests', 'uses'=>'ConversationController@all_group_requests'));
Route::any('/remove-member', array('as'=>'messages.remove_member', 'uses'=>'ConversationController@remove_member'));
Route::any('/group-actions/{slug?}', array('as'=>'messages.group_actions', 'uses'=>'ConversationController@group_actions'));
Route::any('/update-group/{slug?}', array('as'=>'messages.update_group', 'uses'=>'ConversationController@update_group'));
Route::any('/invite-frinds-mid/{slug?}', array('as'=>'messages.invite_friends_mid', 'uses'=>'ConversationController@invite_friends_mid'));


Route::get('json_posts', array('as'=>'posts.json_posts', 'uses'=>'PostController@json_posts'));
Route::get('messageheader', array('as'=>'conversations.messageheader', 'uses'=>'ConversationController@messageheader'));
Route::get('messageRequests', array('as'=>'conversations.messageRequests', 'uses'=>'ConversationController@messageRequests'));
Route::get('notifications', array('as'=>'posts.notifications', 'uses'=>'PostController@notifications'));
Route::any('marknotificationsread', array('as'=>'posts.marknotificationsread', 'uses'=>'PostController@marknotificationsread'));

/*Subscription */
Route::any('/subscription-plans', array('as'=>'subscriptions.subscription_plans', 'uses' => 'SubscriptionController@subscription_plans'));
Route::any('/add-subscription-plan/{id?}', array('as'=>'subscriptions.add_subscription_plan', 'uses' => 'SubscriptionController@add_subscription_plan'));
Route::any('/my-channel-subscriptions/{id?}', array('as'=>'subscriptions.my_channel_subscriptions', 'uses' => 'SubscriptionController@my_channel_subscriptions'));
Route::any('/my-subscriptions/{id?}', array('as'=>'subscriptions.subscription_list', 'uses' => 'SubscriptionController@subscription_list'));
Route::any('/transaction-history', array('as'=>'subscriptions.transaction_history', 'uses' => 'SubscriptionController@transaction_history'));

Route::any('post_like',array('uses'=>'PostController@post_like'));
Route::any('comment_like',array('uses'=>'PostController@comment_like'));
Route::any('post_comment',array('uses'=>'PostController@post_comment'));
Route::any('post-remove/{slug?}',array('uses'=>'PostController@remove_post'));
Route::any('comment-remove/{slug?}',array('uses'=>'PostController@remove_comment'));
Route::any('update-post/{slug?}',array('uses'=>'PostController@update_post'));
Route::any('getemojis',array('uses'=>'PageController@getemojis'));
Route::any('getgifs', array('as'=>'pages.getgifs', 'uses' => 'PageController@getgifs'));

Route::any('/{username}/unsubscribe/{id?}', array('as'=>'subscriptions.unsubscribe', 'uses' => 'SubscriptionController@unsubscribe'));
Route::any('/{username}/payout-subscription', array('as'=>'subscriptions.payout_subscription', 'uses' => 'SubscriptionController@payout_subscription'));
Route::any('/{username}/payment-subscribe/success', array('as'=>'subscriptions.procced_success', 'uses' => 'SubscriptionController@procced_success'));
Route::any('/{username}/payment-subscribe', array('as'=>'subscriptions.payment_subscribe', 'uses' => 'SubscriptionController@payment_subscribe'));
Route::any('/{username}/subscriptions', array('as'=>'subscriptions.subscriptions', 'uses'=>'SubscriptionController@subscriptions'));
Route::any('/{username?}/update-profile', array('as'=>'users.update_profile', 'uses'=>'UserController@update_profile'));
Route::any('/{username?}/change-password', array('as'=>'users.change_password', 'uses'=>'UserController@change_password'));


Route::any('/{username?}/myprofile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('/{username}', array('as'=>'posts.index', 'uses'=>'PostController@index'));