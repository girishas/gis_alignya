<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Template;
use App\Models\Follower;
use App\Models\Conversation;
use App\Models\Notification;
use App\Models\Group;
use App\Models\GroupMember;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Mail;
use File;
use App\Classes\Slim;

class ConversationController extends Controller
{
	

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 //protected $loginPath = 'admin/login';

	public function __construct()
    {
       Parent::__construct();
		$this->middleware('auth', ['except' => ['admin_login', 'admin_register', 'login', 'register', 'forgot_password', 'resetpassword', 'admin_forgot_password']]);
    }
	
	
	public function messages($username = null){
		//$result = Conversation::where('sender', Auth::User()->uniq_username)->orWhere('receiver', Auth::User()->uniq_username)->orderBy('created_at', 'DESC')->groupBy('receiver', 'sender')->take(10)->get()->toArray();
		//echo "<pre>"; print_r($result); die;
		$page_title  = getLabels('messages');
		$following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$follower   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		$all_users  = array_unique(array_merge($following, $follower));
		$user       = User::where('uniq_username', $username)->first(array('first_name', 'last_name', 'uniq_username', 'photo'));
		
		//$messages   = Conversation::orderBy('created_at', 'DESC')->where('sender', Auth::User()->uniq_username)->pluck('');
		
		$previous_chat_users = Conversation::where('sender', Auth::User()->uniq_username)->orWhere('receiver', Auth::User()->uniq_username)->select('sender','receiver')->orderBy('created_at','desc')->get()->toArray();
       
        $prev_users = [];
        if(count($previous_chat_users)>0){
            foreach ($previous_chat_users as $value) {
				if(!in_array($value['receiver'], $prev_users) and !in_array($value['sender'], $prev_users)){
					if($value['sender'] == Auth::User()->uniq_username){
						$prev_users[] = $value['receiver'];
					}else{
						$prev_users[] = $value['sender'];
					}
				}
			}
		}
		
		$orderUsersArr  = User::whereIn('users.id', $all_users)->whereNotIn('uniq_username', $prev_users)->orderBy('first_name', 'asc')->pluck('uniq_username')->toArray();
		$orderUsersArr2  = array_merge($prev_users, $orderUsersArr);
		
		$orders = "";
		foreach($orderUsersArr2 as $val){
			if($orders == ""){
				$orders .= '"'.$val.'"';
			}else{
				$orders .= ','.'"'.$val.'"';
			}
		}
		
		$membersofgroup  = GroupMember::where("is_active", 1)->where('member_id', Auth::User()->uniq_username)->pluck("group_id")->toArray();
		$my_grps = Group::whereIn('id', $membersofgroup)->where('status', 1)->get();
		
		$data       = User::where('status', 1)->whereIn('users.id', $all_users);
		if($orders != ""){
			$data       = $data->orderByRaw('FIELD(uniq_username,'.$orders.')');
		}else{
			$data       = $data->orderBy('first_name', 'ASC');
		}
		$data       = $data->get();
		
		$groupUsers       = User::where('status', 1)->whereIn('users.id', $all_users)->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS userfullname"), "uniq_username")->orderBy("userfullname", "ASC")->pluck("userfullname", "uniq_username")->toArray();
		
		return view('frontend/conversations/index', compact('page_title', 'data', 'user', 'groupUsers', 'my_grps'));
	}
	
	
	
	public function groups($slug = null){
		$page_title  = getLabels('Groups');
		$following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$follower   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		$all_users  = array_unique(array_merge($following, $follower));
		$curgroup   = Group::where('slug', $slug)->first();
		
		if($slug){
			$is_group_member  = GroupMember::where("is_active", 1)->where('group_slug', $slug)->where('member_id', Auth::User()->uniq_username)->count();
			if($is_group_member < 1){
				$url_prefix  = (Auth::User()->role_id == 1)?env('ADMIN_PREFIX'):"";
				return redirect($url_prefix.'/groups');
			}
		}
		
		if($this->request->isMethod('post')){
			$validator = Group::validate($this->request->all(), Auth::User()->uniq_username);
				
			if($validator->fails()) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('group_not_created_errors')]);
			}else {
				
				$formData = $this->request->except('image', 'group_members');
				
				$group_members  = $this->request->group_members;
				if ( $this->request->image){
					$image = head(Slim::getImages('image'));
					if ( isset($image['output']['data']) ){
						$name = $image['output']['name'];
						$dataImage = $image['output']['data'];
						$path = base_path() . '/public/upload/groups/';
						$file = Slim::saveFile($dataImage, $name, $path);
						$formData['icon'] 	= $file['name'];
					}
				}
				if(!empty($formData['id'])){
					$group  = Group::where('user_id', Auth::User()->uniq_username)->where('id', $formData['id'])->first();
					
					$group->update($formData);
					$group  = Group::where('user_id', Auth::User()->uniq_username)->where('id', $formData['id'])->first();
				}else{
					$formData['user_id']  = $group_members[] = Auth::User()->uniq_username;
					$group = Group::create($formData);
				}
				if($group){
					if(empty($formData['id'])){
						$gslug = Group::createGroupSlug($group->name, $group->id);
						$notifications = array();
						foreach($group_members as $group_member){
							$dataGMember  = array("group_id" => $group->id,"member_id" => $group_member, "is_active" => 1, "group_slug" => $gslug);
							if($group_member == Auth::User()->uniq_username){
								$dataGMember['is_admin'] = 1;
							}
							$dataNoti = json_encode(['group_id'=>$group->id,'member_id'=>$group_member,'to_user_id'=>$group_member,'type'=>12]);
							
							if($group_member != Auth::User()->uniq_username){
								if($group->privacy == 3){
									$dataGMember['is_active'] = 0;
									$notimsg   = 'invited_to_join_group';
								}else{
									$notimsg   = 'added_to_group';
								}
								$messageNoti  = str_replace(array('{MEMBER}', '{GROUP}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $group->name), getLabels($notimsg));
								//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' '.$notimsg.$group->name;
								$notifications[] = Notification::createNotifications(Auth::User()->uniq_username, $group_member, $messageNoti, 12, 0, $dataNoti);
							}
							GroupMember::create($dataGMember);
							
						}
						$group = Group::where('id', $group->id)->first();
						$group_data  =  view('Element/conversation/append_group', compact('group'))->render();
						$gmemberArr = $group->groupMembers->toArray();
						return response()->json(['type' => 'success',  'group_html'=>$group_data, 'group_members'=>$gmemberArr, 'group'=>$group, 'action'=>'create', 'notification_count'=>count($notifications), 'notifications'=>$notifications, 'totalMember'=>$group->totalMember, 'message' => getLabels('group_created_successfully')]);
					}elseif(!empty($formData['id'])){
						$group = Group::where('id', $group->id)->first();
						
						
						return response()->json(['type' => 'success', 'group'=>$group, 'action'=>'update', 'totalMember'=>$group->totalMember, 'message' => getLabels('group_updated_successfully')]);
					}
					
				}else{
					return response()->json(['type' => 'error', 'group'=> array(), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		$membersofgroup  = GroupMember::where("is_active", 1)->where('member_id', Auth::User()->uniq_username)->pluck("group_slug", "group_id")->toArray();
		$previous_chat_groups = Conversation::where('sender', Auth::User()->uniq_username)->orWhere('receiver', Auth::User()->uniq_username)->whereIn("group_id", array_values($membersofgroup))->select('group_id')->orderBy('created_at','desc')->groupBy('group_id')->pluck('group_id')->toArray();
       
		$grouporders = "";
		$grporder  = array_diff($membersofgroup, $previous_chat_groups);
		
		$previous_chat_groupsAr  = $previous_chat_groups + $grporder;
		foreach($previous_chat_groupsAr as $val){
			if($grouporders == ""){
				$grouporders .= '"'.$val.'"';
			}else{
				$grouporders .= ','.'"'.$val.'"';
			}
		}
		$my_grps = Group::whereIn('id', array_keys($membersofgroup));
		if($grouporders != ""){
			$my_grps       = $my_grps->orderByRaw('FIELD(slug,'.$grouporders.')');
		}else{
			$my_grps       = $my_grps->orderBy('name', 'ASC');
		}
		$my_grps       = $my_grps->get();
		
		return view('frontend/conversations/groups', compact('page_title', 'my_grps', 'curgroup'));
	}
	
	
	public function messageheader(){
		return view('Element/users/headermsg')->render();
	}
	
	
	public function messageRequests(){
		return view('Element/users/headergrouprequest')->render();
	}
	
	
	public function discover_groups($slug = null){
		
		$page_title  = getLabels('discover_groups');
		$following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$follower   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		$all_users  = array_unique(array_merge($following, $follower));
		
		
		$membersofgroup  = GroupMember::where("is_active", 1)->where('member_id', Auth::User()->uniq_username)->pluck("group_slug", "group_id")->toArray();
		$previous_chat_groups = Conversation::where('sender', Auth::User()->uniq_username)->orWhere('receiver', Auth::User()->uniq_username)->whereIn("group_id", array_values($membersofgroup))->select('group_id')->orderBy('created_at','desc')->groupBy('group_id')->pluck('group_id')->toArray();
       
		$grouporders = "";
		$grporder  = array_diff($membersofgroup, $previous_chat_groups);
		
		$previous_chat_groupsAr  = $previous_chat_groups + $grporder;
		foreach($previous_chat_groupsAr as $val){
			if($grouporders == ""){
				$grouporders .= '"'.$val.'"';
			}else{
				$grouporders .= ','.'"'.$val.'"';
			}
		}
		
		
		$data  = Group::whereNotIn('id', array_keys($membersofgroup))->where('privacy', '!=', 3)->where('status', 1);
		if($this->request->session()->has('groupsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('groupsearch');
		}else{
			$this->request->session()->forget('groupsearch');
		}
		
		if(! empty($_POST)){
			if(isset($_POST['group_name']) and $_POST['group_name'] !=''){
				$group_name = $_POST['group_name'];
				$this->request->session()->put('groupsearch.group_name', $group_name);
				$data = $data->where('groups.name', 'like', "%".$group_name."%");
			}
		}else{
			$this->request->session()->forget('groupsearch');
		}
		
		$data  = $data->paginate(config('constants.PAGINATION_GROUPS'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		
		if ($this->request->ajax() and isset($_GET['page'])) {
    		$view = view('Element/conversation/browse_groups',compact('data'))->render();
            return response()->json(['html'=>$view]);
        }
		$my_grps = Group::whereIn('id', array_keys($membersofgroup))->where('status', 1);
		if($grouporders != ""){
			$my_grps       = $my_grps->orderByRaw('FIELD(slug,'.$grouporders.')');
		}else{
			$my_grps       = $my_grps->orderBy('name', 'ASC');
		}
		$my_grps       = $my_grps->get();
		
		return view('frontend/conversations/discover_groups', compact('page_title', 'my_grps', 'data', 'all_users'));
	}
	
	
	function invite_friends_mid($slug = null){
		$group   = Group::where('slug', $slug)->first();
		
		if($this->request->isMethod('post')){
			
			$group_members = $this->request->invites;
			$notifications = array();
			if(count($group_members) > 0){
				foreach($group_members as $group_member){
					$dataGMember  = array("group_id" => $group->id,"member_id" => $group_member, "is_active" => 0, "group_slug" => $slug);
				
					$dataNoti = json_encode(['group_id'=>$group->id,'member_id'=>$group_member,'to_user_id'=>$group_member,'type'=>12]);
					$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' invited to join group : '.$group->name;
					$notifications[] = Notification::createNotifications(Auth::User()->uniq_username, $group_member, $messageNoti, 12, 0, $dataNoti);
					GroupMember::create($dataGMember);
				}
				return response()->json(['type' => 'success', 'notification_count'=>count($notifications), 'notifications'=>$notifications, 'message' => getLabels('members_invited_to_join_group')]);
			}else{
				return response()->json(['type' => 'error', 'group'=> array(), 'message' => getLabels('no_members_selected')]);
			}	
		}
	
		$following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$follower   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		$all_usersArr  = array_unique(array_merge($following, $follower));
		$grpsmember   = GroupMember::where('group_slug', $slug)->pluck('member_id')->toArray();
		
		$all_users    = User::where('status', 1)->whereIn('id', $all_usersArr)->whereNotIn('uniq_username', $grpsmember)->get();
		$view = view('Element/conversation/invite_friends_mid', compact('all_users', 'slug'))->render();
        return response()->json(['html'=>$view]);
	}
	
	
	public function all_group_requests(){
		$page_title  = getLabels('group_request');
		$data = GroupMember::leftjoin('groups', 'groups.slug', '=', 'group_members.group_slug')->where('group_members.is_active', 0)->where('groups.status', 1)->whereIn('groups.privacy', [2,3]);
		$data = $data->where(function($query){
					$query->where(function($query1){
							$query1->where('groups.user_id', Auth::User()->uniq_username)->where('group_members.member_id','!=', Auth::User()->uniq_username)->where('groups.privacy', 2);
						})->orWhere(function($query2){
							$query2->where('groups.user_id', '!=', Auth::User()->uniq_username)->where('group_members.member_id', Auth::User()->uniq_username)->where('groups.privacy', 3);
						});
					});
		$data = $data->orderBy('group_members.created_at', 'DESC')->take(3)->select('group_members.*', 'groups.name', 'groups.user_id', 'groups.icon', 'groups.user_id', 'groups.privacy')->paginate(config('constants.PAGINATION_NOTIFICATION'));
		
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		
		
		return view('frontend/conversations/all_group_requests', compact('page_title', 'data'));
	}
	
	
	public function join_group(){
		if ($this->request->ajax()) {
			$member_id  = Auth::User()->uniq_username;
			$slug  = $this->request->group;
			$group   = Group::where('slug', $slug)->where('status', 1)->where('privacy', '!=', 3)->first();
			$data = array();
			if(!empty($group->id)){
				$isExisting  = GroupMember::where('member_id', $member_id)->where('group_slug', $slug)->count();
				
				if($isExisting > 0){
					$data['type'] = 'error';
					$data['message'] = getLabels('already_member_of_group');
				}else{
					$is_active  = ($group->privacy == 1)?1:0;
					$data['btn_name']  = ($group->privacy == 1)?getLabels('joined'):getLabels('requested');
					GroupMember::create(array('member_id' => $member_id, 'group_slug' => $slug, 'group_id' => $group->id, 'is_active' => $is_active));
					$data['group'] 		= Group::where('id', $group->id)->first();
					$data['group']->totalMember 		= $data['group']->totalMember;
					$dataNoti = json_encode(['group_id'=>$group->id,'member_id'=>Auth::User()->uniq_username,'to_user_id'=>$group->user_id,'type'=>12]);
					$notimsg   = ($group->privacy == 1)?'joined_group':'requested_to_join_group';
					$messageNoti  = str_replace(array('{MEMBER}', '{GROUP}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $group->name), getLabels($notimsg));
								
					//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' '.$notimsg.' '.$group->name;
					$data['notification'] = Notification::createNotifications(Auth::User()->uniq_username, $group->user_id, $messageNoti, 12, 0, $dataNoti);
					$data['privacy'] = $group->privacy;
					$data['message'] = $data['btn_name'];
					$data['type'] = 'success';
				}
			}else{
				$data['type'] = 'error';
				$data['message'] = getLabels('group_is_not_active');
			}
			return response()->json($data);

        }
	}
	
	
	public function join_group_request(){
		$data = array();
		if ($this->request->ajax()) {
			$user_id  = Auth::User()->uniq_username;
			$type  = $this->request->type;
			$id  = $this->request->member;
			$member = GroupMember::with(['memberGroup', 'memberUser'])->where('group_members.id', $id)->first();
			if(!empty($member->id)){
				if($member->member_id == $user_id OR $member->memberGroup->user_id == $user_id){
					if($type == "1"){
						$member->update(['is_active' => 1]);
						if($member->member_id == $user_id){
							$dataNoti = json_encode(['group_id'=>$member->memberGroup->id,'member_id'=>Auth::User()->uniq_username,'to_user_id'=>$member->memberGroup->user_id,'type'=>12]);
							$notimsg  = ' joined the group ';
							//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.''.$notimsg.''.$member->memberGroup->name;
							$messageNoti  = str_replace(array('{MEMBER}', '{GROUP}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $member->memberGroup->name), getLabels('joined_the_group'));
							$data['notification'] = Notification::createNotifications(Auth::User()->uniq_username, $member->memberGroup->user_id, $messageNoti, 12, 0, $dataNoti);
						}elseif($member->memberGroup->user_id == $user_id){
							$dataNoti = json_encode(['group_id'=>$member->memberGroup->id,'member_id'=>Auth::User()->uniq_username,'to_user_id'=>$member->member_id,'type'=>12]);
							$notimsg  = ' accepted the request to join group ';
							//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.$notimsg.$member->memberGroup->name;
							$messageNoti  = str_replace(array('{MEMBER}', '{GROUP}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $member->memberGroup->name), getLabels('accepted_request_join_group'));
							$data['notification'] = Notification::createNotifications(Auth::User()->uniq_username, $member->member_id, $messageNoti, 12, 0, $dataNoti);
						}
					}else{
						DB::table('group_members')->where('id', $id)->delete();
					}
					$data['type'] = "success"; 
					$data['html'] = view('Element/users/headergrouprequest')->render();
					return response()->json($data);
				}
			}
		}
		
	}
	
	
	
	
	
	public function remove_member(){
		$data = array();
		if ($this->request->ajax()) {
			$user_id  = Auth::User()->uniq_username;
			$id  = $this->request->member;
			$member = GroupMember::with(['memberGroup', 'memberUser'])->where('group_members.id', $id)->first();
			if(!empty($member->id)){
				if($member->memberGroup->user_id == $user_id){
					DB::table('group_members')->where('id', $id)->delete();
				}
				$group  = Group::where('id', $member->memberGroup->id)->first();
				$membercount  = ($group->totalMember > 1)?$group->totalMember.' '.getLabels('Members'):$group->totalMember.' '.str_singular(getLabels('Members'));
				$data  = array("type" => 'success', 'groupMembers' => $group->groupMembers->toArray(), 'grp_slug' => $group->slug, 'totalMember' => $membercount);
				return response()->json($data);
			}
		}
	}
	
	
	
	public function group_actions($slug = null){
		$data = array();
		$url_prefix = (Auth::User()->role_id == 1)?env('ADMIN_PREFIX').'/':'';
		if($slug != ""){
			$group = Group::where('slug', $slug)->where('user_id', Auth::User()->uniq_username)->first();
			if(!empty($group->id)){
				$group->delete();
				GroupMember::where('group_id', $group->id)->delete();
				Conversation::where('group_id', $slug)->delete();
				$data = array("type" => "success", "url" => url($url_prefix.'groups'), "message" => getLabels('group_removed'));
			}else{
				$data = array("type" => "success", "url" => url($url_prefix.'groups'), "message" => getLabels('invalid_group'));
			}
			return response()->json($data);
		}
		if ($this->request->ajax()) {
			$user_id  = Auth::User()->uniq_username;
			$slug  = $this->request->group;
			$action  = $this->request->action;
			$group = Group::where('slug', $slug)->first();
			if(!empty($group->id)){
				if($action == 'leave' and $group->user_id != $user_id){
					GroupMember::where('member_id', $user_id)->where('group_id', $group->id)->delete();
					$data = array('type' => 'success');
				}
				return response()->json($data);
			}

		}
	}
	
	
	public function update_group($slug = null){
		$group = Group::where('user_id', Auth::User()->uniq_username)->where('slug', $slug)->first();
		
		if ($this->request->ajax() and $group) {
			$active_members  = GroupMember::where('member_id', '!=', Auth::User()->uniq_username)->where('group_slug', $slug)->pluck('member_id')->toArray();
			$view = view('Element/conversation/update_group',compact('group', 'active_members'))->render();
            return response()->json(['html'=>$view]);
		}
	}
	
	
	
}
