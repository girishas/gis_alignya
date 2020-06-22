<?php
	use App\User;

	use App\Models\Country;
	use App\Models\Category;
	use App\Models\Product;
	use App\Models\Conversation;
	use App\Models\Language;
	use App\Models\LevelCommission;
	use App\Models\GroupMember;
	use App\Models\SubscriptionPlan;
	use App\Models\Subscription;
	use App\Models\Notification;
	use App\Models\Plans;
	use App\Models\Post;
	use App\Models\Follower;
	use App\Models\Setting;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Schema;
	
	
	function getGroupNotificationURL($group_id, $user_id, $to_user_id){
		$route_prefix  = (Auth::check() and Auth::User()->role_id == 1)?env('ADMIN_PREFIX'):"";
		$group  = DB::table('groups')->where('id', $group_id)->first();
		$data   = array("url" => "javascript:void(0);", "class"=>"");
		if(!empty($group->user_id) and $group->user_id == $user_id){
			$is_member   = DB::table('group_members')->where('group_members.group_id', $group->id)->where('member_id', $to_user_id)->first();
			$data['url']         = !empty($is_member->id)?($is_member->is_active == 1?url($route_prefix.'/groups/'.$group->slug):url($route_prefix.'/group-request')):"javascript:void(0);";
			$data['class']         = "steamerst_link";
		}elseif(!empty($group->user_id) and $group->user_id == $to_user_id){
			$is_member   = DB::table('group_members')->where('group_members.group_id', $group->id)->where('member_id', $user_id)->first();
			$data['url']         = !empty($is_member->id)?($is_member->is_active == 1?url($route_prefix.'/groups/'.$group->slug):url($route_prefix.'/group-request')):"javascript:void(0);";
			$data['class']         = "steamerst_link";
		}
		return $data;
	}
	
	
	function getAllLanguages(){
		$data  = Language::where('status', 1)->get();
		return $data;
	}
	
	
	function getLanguageByCode($code = null){
		$data  = Language::where('status', 1)->where('code', $code)->first();
		return $data;
	}
	
	
	function isSubscribe($plan_id,$level,$user_id){
		$is_subscribe = Subscription::where('plan_id', $plan_id)->where('level',$level)->where('page_creater_id', $user_id)->where('status',1)->where('subscriber_user_id',Auth::id())->first();
		return $is_subscribe;
	}
	
	function planPricefromPlanID($subscription_plan_id, $price, $level_id){
		$data = Plans::where(array('subscription_plan_id'=>$subscription_plan_id,'price'=>$price,'level_id'=>$level_id))->first();
		return $data;
	}
	
	
	function getPlanDetailsByID($plan_id){
		$plan = SubscriptionPlan::where('id', $plan_id)->first();
		return $plan;
	}
	
	function checkAlreadySubscribe($pageCreatorId){
		$check = Subscription::where('subscriber_user_id', Auth::id())->where('page_creater_id',$pageCreatorId)->where('status',1)->first();
		return $check;
	}
	
	
	function getCountries(){
		$countries = Country::orderBy('name','ASC')->orderBy('name','ASC')->pluck('name','id')->toArray();
		return $countries;
	}
	
	function getLevelFees($level_id){
		$data = LevelCommission::where('id',$level_id)->first();
		return $data;
	}
	
	
	function isGroupMember($slug = null){
		$member = GroupMember::where('member_id', Auth::User()->uniq_username)->where('group_slug', $slug)->first();
		return $member;
	}
	
	
	function totalGroupRequestcount(){
		$count = GroupMember::leftjoin('groups', 'groups.slug', '=', 'group_members.group_slug')->where('group_members.is_active', 0)->where('groups.status', 1)->whereIn('groups.privacy', [2,3]);
		$count = $count->where(function($query){
					$query->where(function($query1){
							$query1->where('groups.user_id', Auth::User()->uniq_username)->where('group_members.member_id','!=', Auth::User()->uniq_username)->where('groups.privacy', 2);
						})->orWhere(function($query2){
							$query2->where('groups.user_id', '!=', Auth::User()->uniq_username)->where('group_members.member_id', Auth::User()->uniq_username)->where('groups.privacy', 3);
						});
					});
		$count = $count->count();
		return $count;
	}
	
	
	function getGroupRequestsHeader(){
		$member = GroupMember::leftjoin('groups', 'groups.slug', '=', 'group_members.group_slug')->where('group_members.is_active', 0)->where('groups.status', 1)->whereIn('groups.privacy', [2,3]);
		$member = $member->where(function($query){
					$query->where(function($query1){
							$query1->where('groups.user_id', Auth::User()->uniq_username)->where('group_members.member_id','!=', Auth::User()->uniq_username)->where('groups.privacy', 2);
						})->orWhere(function($query2){
							$query2->where('groups.user_id', '!=', Auth::User()->uniq_username)->where('group_members.member_id', Auth::User()->uniq_username)->where('groups.privacy', 3);
						});
					});
		$member = $member->orderBy('group_members.created_at', 'DESC')->take(3)->select('group_members.*', 'groups.name', 'groups.user_id', 'groups.icon', 'groups.user_id', 'groups.privacy')->get();
		
		return $member;
	}
	
	
	function unreadNotificationCount(){
		$count = 0;
		if(Auth::check()){
			$count = Notification::where('to_user_id', Auth::User()->uniq_username)->where('status', 0)->count();
		}
		return $count;
	}
	
	function getNotifications(){
		$data = Notification::where('to_user_id', Auth::User()->uniq_username)->where('status', '!=', 2)->orderBy('created_at', 'DESC')->take(3)->get();
		return $data;
	}
	
	
	function getMessagesHeader(){
		$data = Conversation::with(['User', 'Group'])->where('receiver', Auth::User()->uniq_username)->where('sender', '!=', Auth::User()->uniq_username)->orderBy('created_at', 'DESC')->get()->unique('sender','group_id');
		return $data;
	}
	
	
	function scheduledPostCount(){
		$count = Post::where('posts.scheduled_starttime', '>', date('Y-m-d H:i:s'))->whereNotNull('posts.scheduled_starttime')->where("posts.user_id", Auth::id())->count();
		return $count;
	}
	
	function myPostCount(){
		$count = Post::where("posts.user_id", Auth::id())->count();
		return $count;
	}
	
	function followersCount(){
		$count  = Follower::where('user_id', Auth::id())->orWhere('to_user_id', Auth::id())->count();
		return $count;
	}
	
	function allFollowersPluck(){
		$following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$follower   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		$all_users  = array_unique(array_merge($following, $follower));
		$groupUsers       = User::where('status', 1)->whereIn('users.id', $all_users)->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS userfullname"), "uniq_username")->orderBy("userfullname", "ASC")->pluck("userfullname", "uniq_username")->toArray();
		return $groupUsers;
	}
	
	function getActiveClass($cat_id=null){
		$cat_active   = Category::getActiveClass($cat_id);
		return $cat_active;
	}
	
	
	function totalUnreadMessage(){
		$total   = 0;
		if(Auth::check()){
			$total   = Conversation::where('is_read', 0)->where('receiver', Auth()->User()->uniq_username)->count();
		}
		
		return $total;
	}
	
	function recentMessageUsers($take = 3){
		if(Auth::check()){
			$messages = DB::table('conversations AS m1')
    ->leftjoin('conversations AS m2', function($join) {
        $join->on('m1.sender', '=', 'm2.sender');
        $join->on('m1.id', '<', 'm2.id');
    })->whereNull('m2.id')
    ->select('m1.sender', 'm1.message', 'm1.created_at')
    ->orderBy('m1.created_at', 'm1.desc')->get();
	
			//$total   = Conversation::where('receiver', Auth()->User()->uniq_username)->orWhere('sender', Auth()->User()->uniq_username)->orderBy('created_at', 'DESC')->groupBy('');
		}
		
		return $messages;
	}
	
	
	function who_to_follow(){
		$followings   	= Follower::where('followers.to_user_id', Auth::id())->pluck('user_id')->toArray();
		$followers    	= Follower::where('followers.user_id', Auth::id())->pluck('to_user_id')->toArray();
		$followerArr  	= array_merge($followings, $followers);
		$followerArr[] = Auth::id();
		
		$friendFollowing = Follower::whereIn('followers.to_user_id', $followerArr)->whereNotIn('user_id', $followerArr)->pluck('user_id')->toArray();
		$friendFollowers = Follower::whereIn('followers.user_id', $followerArr)->whereNotIn('to_user_id', $followerArr)->pluck('to_user_id')->toArray();
		$friendsFollowerArr = array_merge($friendFollowing, $friendFollowers);
		$data  = DB::table('users')->leftjoin('countries', 'countries.id', '=', 'users.country_id');
		if($friendsFollowerArr){
			$data  = $data->whereIn('users.id', $friendsFollowerArr);
		}
		
		$data  = $data->where('users.status', 1)->select('users.*', 'countries.name as country')->inRandomOrder()->take(5)->get();
		return $data;
	}
	
	
	function pageImage($slug = '' ){
		$slug  = strtolower($slug);
		$path	= 'public/upload/page_images/';
		
		
		$data  = DB::table('page_images')->where('page_images.slug', $slug )->first();
		
		$images = !empty($data->image)?$data->image:"";
		$path	= 'public/upload/page_images/'.$images;
		if($path != '' and file_exists($path)){ 
			return  $images ; 
		}else{
			return ''; 
		}
		return $images;
	}


	function getLabels($label_key = '', $html=null){
		$data  = DB::table('labels')->where('labels.label_key', $label_key)->first();
		
		if(!empty($data->id)){
			$language  = session('selected_lang')?session('selected_lang'):'en';
			$field_name = "label_text_".$language;
			$label_text = !empty($data->{$field_name})?$data->{$field_name}:$data->label_text_en;
		}else{
			$label_key  = str_replace("_", " ", $label_key);
			$label_key  = str_replace("-", " ", $label_key);
			$label_text = ucwords($label_key);
		}
		return $label_text;
		
	}

	function getLabel($label_key = '',$html=null){
		$data  = DB::table('labels')->where('labels.label_key', $label_key)->first();
		if(!empty($data->id)){
			$language  = session('selected_lang')?session('selected_lang'):'en';
			$field_name = "label_text_".$language;
			$label_text = !empty($data->{$field_name})?$data->{$field_name}:$data->label_text_en;
		}else{
			$label_key  = str_replace("_", " ", $label_key);
			$label_key  = str_replace("-", " ", $label_key);
			$label_text = ucwords($label_key);		}
		return $label_text;
		
	}

	
	
	function getEmailTemplate($key = '', $html=null){
		$tempArr = array();
		$data  = DB::table('templates')->where('slug', $key)->first();
		if(!empty($data->id)){
			$language  = session('selected_lang')?session('selected_lang'):'en';
			$field_subject = "subject_".$language;
			$field_content = "content_".$language;
			$tempArr['subject'] = !empty($data->{$field_subject})?$data->{$field_subject}:$data->subject_en;
			$tempArr['content'] = !empty($data->{$field_content})?$data->{$field_content}:$data->content_en;
		}
		return $tempArr;
	}
	
	
	function getFAQs($key = '', $html=null){
		$tempArr = array();
		$data  = DB::table('faqs')->get();
		$language  = session('selected_lang')?session('selected_lang'):'en';
		$i=0;
		foreach($data as $val){
			$field_question = "question_".$language;
			$field_answer = "answer_".$language;
			$tempArr[$i]['question'] = !empty($val->{$field_question})?$val->{$field_question}:$val->question_en;
			$tempArr[$i]['answer'] = !empty($val->{$field_answer})?$val->{$field_answer}:$val->answer_en;
			$i++;
		}
		
		return $tempArr;
	}
	
	
	function testimonials(){
		$data  = DB::table('testimonials')->where('status', 1)->orderBy('created_at', 'DESC')->get();
		return $data;
	}

	
	
	function showImage($file = null, $class = '', $width = '', $height = '', $title = '', $fpath='large', $style="", $no_img="img/no_images.png"){
		$title  = strtolower($title);
		$path	= 'public/upload/'.$fpath.'/'.$file;
		$style = $style;
		if($width!=''){
			$style .= 'width:'. $width .';';
		}
		
		if($height!=''){
			$style .= 'height:'. $height .';';
		}
		
		if($file != '' and file_exists($path)){ 
			return HTML::image($path, $title, array('class'=>$class, 'style'=>$style)); 
		}else{
			return HTML::image($no_img, $title, array('class'=>$class, 'style'=>$style)); 
		}
	}
	

	function showUserImg($file=null, $class='', $width='', $height='', $title='', $outer_path='profile-photo/thumb', $div_id = null, $default_image = null){
		$title  = strtolower($title);
		$path	= 'public/upload/users/'. $file;
		
		$style = '';
		if($width!=''){
			$style = 'width:'. $width .';';
		}
		
		if($height!=''){
			$style .= 'height:'. $height .';';
		}
		if($file != '' and file_exists($path)){ 
			//do nothing
		}else{
			$path = $default_image?'public/img/'.$default_image:'public/img/default_profile_photo.jpg';
		}
		
		return HTML::image($path, $title, array('title'=>$title, 'id'=>$div_id, 'class'=>$class, 'style'=>$style)); 
		
	}

	function dataString(){
	  $mytime = Carbon\Carbon::now();
      return $mytime->toDateTimeString();
	}
	
	function getUsersCount($role_id =  null){
		$data  = User::where('role_id', $role_id)->count();
		return $data;
	}
		
		
	function getUserDetailByUsername($slug = null){
		$data  = User::where('uniq_username', $slug)->first();
		return $data;
	}
		
	function getUserDetail($id = null){
		$data  = User::find($id);
		
		return $data;
	}
	
	
	function timeAgo($time_ago) {
		$time_ago = strtotime($time_ago);
		$cur_time   = time();
		$time_elapsed   = $cur_time - $time_ago;
		$seconds    = $time_elapsed ;
		$minutes    = round($time_elapsed / 60 );
		$hours      = round($time_elapsed / 3600);
		$days       = round($time_elapsed / 86400 );
		$weeks      = round($time_elapsed / 604800);
		$months     = round($time_elapsed / 2600640 );
		$years      = round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 60){
			return "less then a minute ago";
		}
		//Minutes
		else if($minutes <=60){
			if($minutes==1){
				return "one minute ago";
			}
			else{
				return "$minutes minutes ago";
			}
		}
		//Hours
		else if($hours <=24){
			if($hours==1){
				return "an hour ago";
			}else{
				return "$hours hours ago";
			}
		}
		//Days
		else if($days <= 7){
			if($days==1){
				return "yesterday";
			}else{
				return "$days days ago";
			}
		}
		//Weeks
		else if($weeks <= 4.3){
			if($weeks==1){
				return "a week ago";
			}else{
				return "$weeks weeks ago";
			}
		}
		//Months
		else if($months <=12){
			if($months==1){
				return "a month ago";
			}else{
				return "$months months ago";
			}
		}
		//Years
		else{
			if($years==1){
				return "one year ago";
			}else{
				return "$years years ago";
			}
		}
	}
	
	
	function twitchChat($url){
			
	  	$type_of_file = getfiletype($url);
		//echo 	$url; die;
		$url_clean  = strtok($url, '?');
		$extenction = substr($url_clean, strrpos($url_clean, '/') + 1);   
		
		if($type_of_file == 'mixer'){
	  	 	$src =  'https://mixer.com/embed/chat/'.$extenction;
		} else if($type_of_file == 'youtube' || $type_of_file == 'youtube_gaming'){
			$url_clean  = strtok($url, '&');
	  	 	$extens = substr($url_clean, strrpos($url_clean, '=') + 1);
	  	 	$src =  'https://www.youtube.com/live_chat?v='.$extens.'&embed_domain='.config('constants.EMBED_DOMAIN');
		} else {
	  	 	$src =  'https://www.twitch.tv/embed/'.$extenction.'/chat?darkpopout';
		}  
		
		return $src;
		//return $sce.trustAsResourceUrl(src);
	}
	
	
	function getfiletype($url){
		
		if(strpos($url,'youtube.com') !== false OR strpos($url,'youtu.be') !== false){
			if(strpos($url,'gaming.youtube.com')){
				return 'youtube_gaming';
			}else{
				return 'youtube';
			}
		}
		$pattern = '/(\:\/\/.*(mixer\.com))/';
		if(preg_match($pattern, $url)){
			return "mixer";
		}
		
		$pattern = '/(\:\/\/.*(vimeo\.com))/';
		if(preg_match($pattern, $url)){
			return "vimeo";
		}
		
		if (preg_match('/(\:\/\/.*(twitch\.tv))/', $url, $matches)){
			//echo "<pre>"; print_r($matches); die;
			if(strpos($url, "clips.twitch.tv") !== false OR strpos($url, "/clip/") !== false){
				return 'twitch_clips';
			}elseif(strpos($url, "/videos/") !== false){
				return 'twitch_video';
			}else{
				return 'twitch';
			}
		}
		
		return NULL;
		
		
		//if (href.match(/\:\/\/.*(vimeo\.com)/i)) return 'vimeo';
	}
	
	function youtubeVideo($url){
		$pattern = '/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/';
		preg_match($pattern, $url, $matches, PREG_OFFSET_CAPTURE);
		
		if(!empty($matches[1][0])) {
			return $matches[1][0];
		} else { 
			return 0;
		}
	}
	
	
	function parseVideo($url){
		$pattern = "/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/";
		preg_match($pattern, $url, $matches, PREG_OFFSET_CAPTURE);
		$type = "";
		if(!empty($matches[3][0])) {
			if(strpos($matches[3][0],'youtu') !== false){
				$type = 'youtube';
			}elseif(strpos($matches[3][0],'vimeo') !== false){
				$type = 'vimeo';
			}
		}
		
		if($type and !empty($matches[6][0])) {
			return array("type" => $type, "id" => $matches[6][0]);
		}
		return "";
	}
	
	
	function getPlayVideoURL($url){
		$type_of_file  = getfiletype($url);
		if($type_of_file =='youtube'){
			$video_id = youtubeVideo($url);
			return "https://www.youtube.com/embed/".$video_id;
		}
		
		if($type_of_file =='vimeo'){	
			$videoObj = parseVideo($url);
			if(!empty($videoObj['id'])){
				return 'https://player.vimeo.com/video/'.$videoObj['id'].'?autoplay=false';
			}
		}
		//echo $type_of_file; die;
		if($type_of_file =='twitch'){       	
			$extenction = substr($url, strrpos($url, '/') + 1);    
			return 'https://player.twitch.tv/?channel='.$extenction.'&autoplay=false';
		}
		
		if($type_of_file =='twitch_clips'){       	
			$extenction = substr($url, strrpos($url, '/') + 1);
			return 'https://clips.twitch.tv/embed?clip='.$extenction.'&autoplay=false';
		}
		if($type_of_file =='twitch_video'){       	
			$extenction = substr($url, strrpos($url, '/') + 1); 
			return 'https://player.twitch.tv/?autoplay=false&video='.$extenction;
		}
			
		if($type_of_file =='mixer'){       	
			$extenction = substr($url, strrpos($url, '/') + 1); 
			return 'https://mixer.com/embed/player/'.$extenction.'?muted=true';
			
		}	
		
		if($type_of_file =='youtube_gaming'){       	
			$extenction = substr($url, strrpos($url, '/') + 1); 
			return 'https://gaming.youtube.com/embed/'.$extenction;
			
		}
		return $url;
	}
	
	
	function changeuniqusername($old_username, $new_username){
		DB::table('conversations')->where('sender', $old_username)->update(array('sender' => $new_username));
		DB::table('conversations')->where('receiver', $old_username)->update(array('receiver' => $new_username));
		DB::table('groups')->where('user_id', $old_username)->update(array('user_id' => $new_username));
		DB::table('group_members')->where('member_id', $old_username)->update(array('member_id' => $new_username));
		DB::table('notifications')->where('user_id', $old_username)->update(array('user_id' => $new_username));
		DB::table('notifications')->where('to_user_id', $old_username)->update(array('to_user_id' => $new_username));
		DB::table('payouts')->where('user_id', $old_username)->update(array('user_id' => $new_username));
		return true;
	}
	
	
	function pr($arr){
		echo "<pre>"; print_r($arr); die;
	}
	
	
	?>