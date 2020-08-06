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
Route::any('members', array('as'=>'users.admin_index', 'uses'=>'UserController@admin_index'));
Route::any('teams/new', array('as'=>'users.admin_add', 'uses'=>'TeamController@admin_add'));
Route::any('teams/update/{id?}', array('as'=>'users.admin_edit', 'uses'=>'TeamController@admin_edit'))->where('id', '[0-9]+');
Route::any('teams', array('as'=>'admin.users', function(){ 
							return App::make('App\Http\Controllers\TeamController')->admin_index(2); }));
Route::any('department/new/{id?}', array('as'=>'department.admin_add', 'uses'=>'DepartmentController@admin_add'));
Route::any('department/update/{id?}', array('as'=>'department.admin_edit', 'uses'=>'DepartmentController@admin_edit'))->where('id', '[0-9]+');
Route::any('departments/{id?}', array('as'=>'admin.admin_index', 'uses'=>'DepartmentController@admin_index'));

Route::any('objectives', array('as'=>'users.admin_index', 'uses' => 'ObjectiveController@admin_index'));
Route::any('setuserdatasession', array('as'=>'users.setuserdatasession', 'uses'=>'UserController@setuserdatasession'));
Route::any('add_teampopup', array('as'=>'users.add_teampopup', 'uses'=>'TeamController@add_teampopup'));
Route::any('kpis', array('as'=>'users.admin_index', 'uses'=>'KPIController@admin_index' ));
Route::any('measures', array('as'=>'users.admin_index', 'uses'=>'MeasureController@admin_index' ));
Route::any('initiatives', array('as'=>'users.initiatives', 'uses'=>'InitiativeController@admin_index'));
Route::any('addinitiative', array('as'=>'admin.addinitiative', 'uses'=>'InitiativeController@addinitiative'));
Route::any('updateinitiative', array('as'=>'admin.updateinitiative', 'uses'=>'InitiativeController@updateinitiative'));
Route::any('addmilestoneinitiative', array('as'=>'admin.addmilestoneinitiative', 'uses'=>'InitiativeController@addmilestoneinitiative'));
Route::any('getmilestonedata', array('as'=>'admin.getmilestonedata', 'uses'=>'InitiativeController@getmilestonedata'));
Route::any('getInitiativeData', array('as'=>'admin.getInitiativeData', 'uses'=>'InitiativeController@getInitiativeData'));
Route::any('department/remove/{id?}', array('as'=>'admin.department_remove', 'uses'=>'DepartmentController@department_remove'));
Route::any('team/remove/{id?}', array('as'=>'admin.team_remove', 'uses'=>'TeamController@team_remove'));
Route::any('kpi/remove/{id?}', array('as'=>'admin.kpi_remove', 'uses'=>'KPIController@kpi_remove'));

Route::any('reports/{id?}', array('as'=>'users.reports', 'uses'=>'TeamController@reports'));
Route::any('addobjective', array('as'=>'users.addobjective', 'uses'=>'ObjectiveController@addobjective'));
Route::any('updateobjective', array('as'=>'users.updateobjective', 'uses'=>'ObjectiveController@updateobjective'));
Route::any('viewobjective', array('as'=>'users.viewobjective', 'uses'=>'ObjectiveController@viewobjective'));
Route::any('getprojectinsightsobjective', array('as'=>'users.getprojectinsightsobjective', 'uses'=>'TeamController@getprojectinsightsobjective'));
Route::any('addmeasure', array('as'=>'users.addmeasure', 'uses'=>'MeasureController@addmeasure'));
Route::any('import-members', array('as'=>'users.importmembers', 'uses'=>'UserController@importmembers'));
Route::any('addkpi', array('as'=>'users.addkpi', 'uses'=>'KPIController@addkpi'));
Route::any('addtask', array('as'=>'users.addtask', 'uses'=>'MeasureController@addtask'));
Route::any('removetasks/{id?}', array('as'=>'users.removetasks', 'uses'=>'MeasureController@removetasks'));
Route::any('updatemeasure', array('as'=>'users.updatemeasure', 'uses'=>'MeasureController@updatemeasure'));
Route::any('updatekpi', array('as'=>'users.updatekpi', 'uses'=>'KPIController@updatekpi'));
Route::any('getMeasureonUpdatePage', array('as'=>'users.getMeasureonUpdatePage', 'uses'=>'MeasureController@getMeasureonUpdatePage'));


Route::any('getmilestonedetails', array('as'=>'users.getmilestonedetails', 'uses'=>'MeasureController@getmilestonedetails'));
Route::any('updatemilestonemeasure', array('as'=>'users.updatemilestonemeasure', 'uses'=>'MeasureController@updatemilestonemeasure'));

Route::any('ideas', array('as'=>'users.ideas', 'uses'=>'TeamController@ideas'));
Route::any('idealike', array('as'=>'users.idealike', 'uses'=>'TeamController@idealike'));
Route::any('ideadislike', array('as'=>'users.ideadislike', 'uses'=>'TeamController@ideadislike'));
Route::any('ideacommentlike', array('as'=>'users.ideacommentlike', 'uses'=>'TeamController@ideacommentlike'));
Route::any('ideacommentdislike', array('as'=>'users.ideacommentdislike', 'uses'=>'TeamController@ideacommentdislike'));

Route::any('idea-categories', array('as'=>'users.idea_categories', 'uses'=>'DepartmentController@idea_categories'));
Route::any('idea-categories/new', array('as'=>'users.idea_categories_add', 'uses'=>'DepartmentController@idea_categories_add'));
Route::any('idea-categories/remove/{id?}', array('as'=>'users.remove_idea_categories', 'uses'=>'DepartmentController@remove_idea_categories')) ;
Route::any('single-idea-categories-details/{id?}', array('as'=>'users.single_idea_categories', 'uses'=>'DepartmentController@single_idea_categories'));

Route::any('addidea', array('as'=>'users.addidea', 'uses'=>'TeamController@addidea'));
Route::any('idea-details/{id?}', array('as'=>'users.idea_details', 'uses'=>'TeamController@idea_details'));
Route::any('department/{id?}', array('as'=>'users.admin_index', 'uses'=>'DepartmentController@admin_index'));
Route::any('profile', array('as'=>'users.profile', 'uses'=>'UserController@profile'));
Route::any('addDepartmentForm', array('as'=>'users.addDepartmentForm', 'uses'=>'DepartmentController@addDepartmentForm'));
Route::any('getprofiledata', array('as'=>'users.getprofiledata', 'uses'=>'UserController@getprofiledata'));
Route::any('update-profile', array('as'=>'users.update_profile', 'uses'=>'UserController@update_profile'));
Route::any('subscription', array('as'=>'users.subscription', 'uses'=>'DepartmentController@subscription'));
Route::any('upgrade-membership', array('as'=>'users.upgrade_membership', 'uses'=>'DepartmentController@upgrade_membership'));
Route::any('checkemailexist', array('as'=>'users.checkemailexist', 'uses'=>'UserController@checkemailexist'));
Route::any('invoice', array('as'=>'users.invoice', 'uses'=>'DepartmentController@invoice'));
Route::any('tree', array('as'=>'users.tree', 'uses'=>'DepartmentController@tree'));
Route::any('roadmap', array('as'=>'users.roadmap', 'uses'=>'DepartmentController@roadmap'));
Route::any('timemap', array('as'=>'users.timemap', 'uses'=>'DepartmentController@timemap'));
Route::any('departmental', array('as'=>'users.departmental', 'uses'=>'DepartmentController@departmental'));
Route::any('supports', array('as'=>'users.supports', 'uses'=>'DepartmentController@supports'));
Route::any('notifications', array('as'=>'users.notifications', 'uses'=>'DepartmentController@notifications'));
Route::any('team/{id?}', array('as'=>'users.admin_index', 'uses'=>'TeamController@admin_index'));
Route::any('scorecard', array('as'=>'users.scorecard', 'uses'=>'TeamController@scorecard'));
Route::any('strategic-map', array('as'=>'users.startegic_map', 'uses'=>'TeamController@startegic_map'));
Route::any('viewmember', array('as'=>'users.viewmember', 'uses'=>'UserController@viewmember'));
Route::any('getscorecards/{id?}', array('as'=>'users.getscorecards', 'uses'=>'ObjectiveController@getscorecards'));
Route::any('getcontributersforobjective', array('as'=>'users.getcontributersforobjective', 'uses'=>'ObjectiveController@getcontributersforobjective'));
Route::any('scorecards', array('as'=>'users.scorecardlist', 'uses'=>'DepartmentController@scorecardlist'));
Route::any('scorecards/new', array('as'=>'users.scorecardadd', 'uses'=>'DepartmentController@scorecardadd'));
Route::any('scorecard/remove/{id?}', array('as'=>'users.remove_scorecard', 'uses'=>'DepartmentController@remove_scorecard')) ;
Route::any('single-scorecards-details/{id?}', array('as'=>'users.singlescorecard', 'uses'=>'DepartmentController@singlescorecard'));

Route::any('themes', array('as'=>'users.themelist', 'uses'=>'DepartmentController@themelist'));
Route::any('theme/remove/{id?}', array('as'=>'users.remove_theme', 'uses'=>'DepartmentController@remove_theme')) ;
Route::any('themes/new', array('as'=>'users.themeadd', 'uses'=>'DepartmentController@themeadd'));
Route::any('single-theme-details/{id?}', array('as'=>'users.singletheme', 'uses'=>'DepartmentController@singletheme'));

Route::any('goalcycles', array('as'=>'users.goalcyclelist', 'uses'=>'DepartmentController@goalcyclelist'));
Route::any('goalcycle/remove/{id?}', array('as'=>'users.remove_goalcycle', 'uses'=>'DepartmentController@remove_goalcycle')) ;
Route::any('goalcycles/new', array('as'=>'users.goalcycleadd', 'uses'=>'DepartmentController@goalcycleadd'));
Route::any('single-goalcycle-details/{id?}', array('as'=>'users.singlegoalcycle', 'uses'=>'DepartmentController@singlegoalcycle'));

Route::any('perspectives', array('as'=>'users.perspectivelist', 'uses'=>'DepartmentController@perspectivelist'));
Route::any('perspective/remove/{id?}', array('as'=>'users.remove_perspective', 'uses'=>'DepartmentController@remove_perspective')) ;
Route::any('perspectives/new', array('as'=>'users.perspectiveadd', 'uses'=>'DepartmentController@perspectiveadd'));
Route::any('single-perspective-details/{id?}', array('as'=>'users.singleperspective', 'uses'=>'DepartmentController@singleperspective'));

Route::any('submitscorecard', array('as'=>'users.submitscorecard', 'uses'=>'ObjectiveController@submitscorecard'));
Route::any('getthemes', array('as'=>'users.getthemes', 'uses'=>'ObjectiveController@getthemes'));
Route::any('getcontributers', array('as'=>'users.getcontributers', 'uses'=>'ObjectiveController@getcontributers'));
Route::any('updateobjectivesubmit', array('as'=>'users.updateobjectivesubmit', 'uses'=>'ObjectiveController@updateobjectivesubmit'));
Route::any('submitaddtheme', array('as'=>'users.submitaddtheme', 'uses'=>'ObjectiveController@submitaddtheme'));
Route::any('getdepartments', array('as'=>'users.getdepartments', 'uses'=>'DepartmentController@getdepartments'));
Route::any('getteams', array('as'=>'users.getteams', 'uses'=>'TeamController@getteams'));
Route::any('getmembers', array('as'=>'users.getmembers', 'uses'=>'UserController@getmembers'));
Route::any('getCycles', array('as'=>'users.getCycles', 'uses'=>'ObjectiveController@getCycles'));
Route::any('getTaskDetails', array('as'=>'users.getTaskDetails', 'uses'=>'ObjectiveController@getTaskDetails'));
Route::any('submitaddcycle', array('as'=>'users.submitaddcycle', 'uses'=>'ObjectiveController@submitaddcycle'));
Route::any('getMeasureCycles', array('as'=>'users.getMeasureCycles', 'uses'=>'MeasureController@getMeasureCycles'));
Route::any('/initiative/remove/{id?}', array('as'=>'users.remove_initiative', 'uses'=>'InitiativeController@remove_initiative'));
Route::any('/objective/remove/{id?}', array('as'=>'users.remove_objective', 'uses'=>'ObjectiveController@remove_objective'));
Route::any('/measure/remove/{id?}', array('as'=>'users.remove_measure', 'uses'=>'MeasureController@remove_measure')) ;


Route::any('/milestone/remove/{id?}', array('as'=>'users.remove_milestone', 'uses'=>'InitiativeController@remove_milestone'));
Route::any('/tasks/remove/{id?}', array('as'=>'users.remove_tasks', 'uses'=>'InitiativeController@remove_tasks'));
Route::any('auth/{provider?}', 'UserController@redirectToProvider');
Route::any('auth/{provider?}/callback', 'UserController@handleProviderCallback');
Route::any('/', array('as'=>'users.home', 'uses'=>'UserController@home'));
Route::any('/features-strategy-development', array('as'=>'users.features_strategy_development', 'uses'=>'UserController@features_strategy_development'));
Route::any('/features-alignment-target-initiative', array('as'=>'users.features_alignment_target_initiative', 'uses'=>'UserController@features_alignment_target_initiative'));
Route::any('/features-progress-tracking-and-insights', array('as'=>'users.features_progress_tracking_and_insights', 'uses'=>'UserController@features_progress_tracking_and_insights'));
Route::any('/features-collaboration', array('as'=>'users.features_collaboration', 'uses'=>'UserController@features_collaboration'));
Route::any('/alignya-process', array('as'=>'users.alignya_process', 'uses'=>'UserController@alignya_process'));
Route::any('/blog', array('as'=>'users.blog', 'uses'=>'UserController@blog'));
Route::any('/contact', array('as'=>'users.contact', 'uses'=>'UserController@contact'));

Route::any('/login', array('as'=>'users.login', 'uses'=>'UserController@login'));
Route::any('/register', array('as'=>'users.login', 'uses'=>'UserController@register'));
Route::any('/forgot-password', array('as'=>'users.forgot_password', 'uses'=>'UserController@forgot_password'));
Route::any('/dashboard', array('as'=>'users.dashboard', 'uses'=>'UserController@dashboard'));
Route::any('/account', array('as'=>'users.account', 'uses'=>'UserController@account'));
Route::any('/logout', array('as'=>'users.logout', 'uses'=>'UserController@logout'));
Route::any('resetpassword/{slug?}', array('as'=>'users.resetpassword', 'uses'=>'UserController@resetpassword'));
Route::any('verify-mail/{slug?}',array('uses'=>'UserController@verifyMail'));
Route::any('search', array('as'=>'users.search', 'uses'=>'UserController@search'));
Route::any('follow-user/{username?}', array('as'=>'users.follow_user', 'uses'=>'UserController@follow_user'));
Route::any('unfollow-user/{username?}', array('as'=>'users.unfollow_user', 'uses'=>'UserController@unfollow_user'));
Route::any('change-password/{id?}', array('as'=>'users.change_password', 'uses'=>'UserController@change_password'));


Route::any('/{username}', array('as'=>'users.profile', 'uses'=>'UserController@profile'));