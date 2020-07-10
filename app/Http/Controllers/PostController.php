<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Models\PostFile;
use App\Models\SiteMap;
use App\Models\UserSetting;
use App\Models\Follower;
use App\Models\Group;
use App\Models\Template;
use App\Models\Subscription;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostCategory;
use App\Models\Notification;
use App\Models\UserReward;
use App\Models\Chat;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use File;
use Session;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Route;
use DateTime;
use DateTimeZone;
use DateInterval;
use URL;
use Abraham\TwitterOAuth\TwitterOAuth;
class PostController extends Controller
{
	

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function __construct()
    {
       Parent::__construct();
		$this->middleware('auth', ['except' => ['cronPostPublish','post_data','load_more_comments']]);
    }

	
	
	public function json_posts(){
		$result = array();
		if(Auth::check()){
			$follwers  = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
			$follwing  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
			$who_to_see = array_merge($follwers, $follwing);
			
			$posts = Post::leftjoin('users', 'users.id', '=', 'posts.user_id')->where('posts.scheduled_starttime', '>', date('Y-m-d H:i:s'))->whereNotNull('posts.scheduled_starttime');
		
			$posts = $posts->where(function($queryW) use($who_to_see){
					$queryW->where("posts.user_id", Auth::id())->orWhere(function($query_ws) use($who_to_see){
								$query_ws->whereIn('posts.user_id', $who_to_see)->where('posts.who_can_see', '!=', 3);
							});
				});
			$posts = $posts->orderBy('posts.created_at', 'ASC')->select('users.first_name', 'users.uniq_username', 'users.last_name', 'users.photo', 'posts.title', 'posts.description', 'posts.scheduled_starttime as start')->get()->toArray();
			$result  = $posts;
			//pr($result); die;
		}
		
		return Response()->json($result); 
    }
	
	
	public function index($username = null, $slug = null){
		//echo $slug; die;
		$follwers  = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		$follwing  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$who_to_see = array_merge($follwers, $follwing);
		$page_title  = getLabels('Posts');
		//$posts = Post::with(['postFiles','postUser'])->where("user_id", Auth::id())->get();
		$posts = Post::with(['postUser', 'postFiles', 'postLike', 'postComments']);
		
		$posts = $posts->where(function($queryS){
					$queryS->where('posts.scheduled_starttime', '<=', date('Y-m-d H:i:s'))->orWhereNull('posts.scheduled_starttime')->orWhere('posts.scheduled_starttime', "");
				});
						
		$posts = $posts->where(function($queryW) use($who_to_see){
					$queryW->where("posts.user_id", Auth::id())->orWhere(function($query_ws) use($who_to_see){
								$query_ws->whereIn('user_id', $who_to_see)->where('posts.who_can_see', '!=', 3);
							});
				});
		if($slug){
			$posted_id = base64_decode($slug);
			$posts = $posts->where('posts.id', $posted_id);
		}else{
			$posts = $posts->where("posts.user_id", '!=', Auth::id());
		}
		
		$posts = $posts->orderBy('created_at', 'DESC')->paginate(2)->map(function ($query) {
            $query->setRelation('postComments', $query->postComments->take(config('constants.PAGINATION_COMMENTS')));
            return $query;
        });
		
		
		
		//echo "<pre>"; print_r($posts); die;
		if($this->request->isMethod('post')){
			$data = $this->request->all();
			
			
			if($this->request->isMethod('post')){
				$validator = Post::validate($this->request->all());
				
				if ( $validator->fails() ) {
					return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('post_created_errors')]);
				} else {
					$formData              	= $this->request->except('pro-image');
					$formData['user_id']    = Auth::id();
					
					preg_match_all('/<div class=\"giphyimgcreatepost\">(.*?)<\/div>/s', $formData['description'], $out);
					preg_match('~src="(.*)"\s*itemprop="image"[^>]*>~',$formData['description'],$out);
					if(!empty($out[1])){
						//$formData['description']  = "<img src=".$out[1]." />";
						$formData['giphy_image']  = $out[1];
					}
					$formData['description']  = str_replace("giphyimgareacreatepost", "giphyimgareaupdatepost", $formData['description']);
					$formData['description']  = str_replace('rel="createpost"', 'rel="updatepost"', $formData['description']);
					if(!empty($formData['id'])){
						$post  = Post::where('user_id', Auth::id())->where('id', $formData['id'])->first();
						if($post){
							$post->update($formData);
							$post  = Post::find($formData['id']);
							$postfilesold =  $this->request->get('post_files');
							$oldFilesArrs = PostFile::where('post_id', $formData['id']);
							if($postfilesold){
								$oldFilesArrs = $oldFilesArrs->whereNotIn('id', $postfilesold);
							}
							$oldFilesArrs = $oldFilesArrs->get();
								
							if(count($oldFilesArrs) > 0){
								foreach($oldFilesArrs as $oldFilesArr){
									unlink('public/upload/posts/'.Auth::User()->uniq_username.'/'.$oldFilesArr->image_name);
								}
								if($postfilesold){
									PostFile::where('post_id', $formData['id'])->whereNotIn('id', $postfilesold)->delete();
								}else{
									PostFile::where('post_id', $formData['id'])->delete();
								}
							}
							
						}else{
							$post  = Post::create($formData);
						}
					}else{
						$post  = Post::create($formData);
					}
 					
					if($post){
						$post_id  = $post->id;
						$notifications = array();
						if(empty($formData['id']) and !empty($formData['scheduled_starttime'])){
							$allFollowersPluck  = allFollowersPluck();
							foreach($allFollowersPluck as $keyf=>$follo){
								$dataNoti = json_encode(['post_id'=>$post_id,'user_id'=>Auth::User()->uniq_username,'to_user_id'=>$keyf,'type'=>7]);
								
								$messageNoti  = str_replace(array('{USER}', '{DATE}'), array(Auth::User()->first_name." ".Auth::User()->last_name, date('F d, Y H:i', strtotime($formData['scheduled_starttime']))), getLabels('scheduled_live_streaming_on'));
								//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' scheduled live streaming on : '.date('F d, Y H:i', strtotime($formData['scheduled_starttime']));
								$notifications[] = Notification::createNotifications(Auth::User()->uniq_username, $keyf, $messageNoti, 7, 0, $dataNoti);
							}
						}
						$files = glob('public/upload/tmp/'.Auth::User()->uniq_username . '/*');
						if($files){
							foreach($files as $file){
								$dir_name = 'public/upload/posts/'.Auth::User()->uniq_username;
								if (!is_dir($dir_name)) {
									mkdir($dir_name);
								}
								$file_name = substr($file, strrpos($file, '/') + 1);
								copy($file, $dir_name. '/'.$file_name);
								
								$postfileArr = array("user_id" => Auth::id(), "post_id" => $post->id, "image_name" => $file_name);
								PostFile::create($postfileArr);
							}
						}
						/* $posts = Post::with(['postUser', 'postFiles', 'postLike', 'postComments'])->where("posts.user_id", Auth::id())->where("posts.id", $post_id)->orderBy('created_at', 'DESC')->paginate(2)->map(function ($query) {
							$query->setRelation('postComments', $query->postComments->take(config('constants.PAGINATION_COMMENTS')));
							return $query;
						});
						$view = view('frontend/posts/post_mid',compact('posts'))->render(); */
						return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX').'/'.Auth::User()->uniq_username), 'modals' => 'posts', 'notifications' => $notifications, 'notification_count' => count($notifications), 'message' => getLabels('post_created_successfully')]);
					}else{
						return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX').'/'.Auth::User()->uniq_username), 'modals' => 'posts', 'message' => getLabels('something_wrong_try_again')]);
					}
				}
			}
		}
		if ($this->request->ajax() and isset($_GET['page'])) {
    		$view = view('frontend/posts/post_mid',compact('posts','slug'))->render();
            return response()->json(['html'=>$view]);
        }
		$files = glob('public/upload/tmp/'.Auth::User()->uniq_username . '/*');
		File::delete($files);
		return view('frontend/posts/index', compact('page_title', 'posts', 'slug'));
	}
	
	
	public function load_more_comments($post_id = null){
		$comments = PostComment::where('parent_id', 0)->where('post_id', $post_id)->orderBy('id', 'DESC')->paginate(config('constants.PAGINATION_COMMENTS'));
		
		if ($this->request->ajax() and isset($_GET['page'])) {
    		$view = view('frontend/posts/load_more_comments',compact('comments'))->render();
            return response()->json(['html'=>$view, 'last_page' => $comments->lastPage(), 'current_page' => $_GET['page']]);
        }
		
	}
	
	
	
	public function ajaxfileupload(){
		if($this->request->isMethod('post')){
			$data = $this->request->file('files');
			foreach($data as $file){
				if($file){
					$ext = strtolower(File::extension($file->getClientOriginalName()));
					$filenameO = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
					$filename = date("ymdhis").str_slug($filenameO).'.'. $ext;
					$dir_name = 'public/upload/tmp/'.Auth::User()->uniq_username;
					if (!is_dir($dir_name)) {
						mkdir($dir_name);
					}
					$upload_success = $file->move('public/upload/tmp/'.Auth::User()->uniq_username.'/', $filename);
				} 
			}
		}
		return true;
	}
	
	
	
	public function post_like(){
		if ($this->request->ajax()) {
			$post_id  = $this->request->post_id;
			$user_id  = Auth::id();
			$isExisting  = PostLike::where('user_id', $user_id)->where('post_id', $post_id)->count();
			$data = array();
			if($isExisting > 0){
				PostLike::where('user_id', $user_id)->where('post_id', $post_id)->delete();
				$data['action'] = 'dislike';
			}else{
				PostLike::create(array('user_id' => $user_id, 'post_id' => $post_id));
				$post = Post::find($post_id);
				if($post and $user_id != $post->user_id){
					$dataNoti = json_encode(['post_id'=>$post_id,'user_id'=>Auth::User()->uniq_username,'to_user_id'=>$post->postUser->uniq_username,'type'=>1]);
					$messageNoti  = str_replace(array('{USER}', '{POST}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $post->title), getLabels('liked_a_post'));
					//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' liked a post : '.$post->title		
					$data['notification'] = Notification::createNotifications(Auth::User()->uniq_username, $post->postUser->uniq_username, $messageNoti, 1, 0, $dataNoti);
				}
				$data['action'] = 'like';
			}
			$count = PostLike::where('post_id', $post_id)->count();
			$data['total_likes'] = ($count > 1)?$count." ".getLabels('likes'):$count." ".str_singular(getLabels('likes'));
			
    		return response()->json($data);
        }
	}
	
	
	public function comment_like(){
		if ($this->request->ajax()) {
			$post_id  = $this->request->post_id;
			$comment_id  = $this->request->comment_id;
			$user_id  = Auth::id();
			$isExisting  = PostCommentLike::where('user_id', $user_id)->where('post_comment_id', $comment_id)->count();
			$data = array();
			if($isExisting > 0){
				PostCommentLike::where('user_id', $user_id)->where('post_comment_id', $comment_id)->delete();
				$data['action'] = 'dislike';
			}else{
				PostCommentLike::create(array('user_id' => $user_id, 'post_id' => $post_id, 'post_comment_id' => $comment_id));
				$comment = PostComment::find($comment_id);
				$post = Post::find($post_id);
				if($comment and $user_id != $comment->user_id){
					$dataNoti = json_encode(['comment_id'=>$comment_id,'post_id'=>$post_id,'user_id'=>Auth::User()->uniq_username,'to_user_id'=>$comment->User->uniq_username,'type'=>2]);
					$messageNoti  = str_replace(array('{USER}', '{POST}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $post->title), getLabels('liked_a_comment'));
					//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' liked a comment on post : '.$post->title;
					$data['notification'] = Notification::createNotifications(Auth::User()->uniq_username, $comment->User->uniq_username, $messageNoti, 2, 0, $dataNoti);
				}
				$data['action'] = 'like';
			}
			$count = PostCommentLike::where('post_comment_id', $comment_id)->count();
			$data['total_likes'] = ($count > 1)?$count." ".getLabels('likes'):$count." ".str_singular(getLabels('likes'));
			
    		return response()->json($data);
        }
	}
	
	
	public function post_comment(){
		if ($this->request->ajax()) {
			$post_id  		= $this->request->post_id;
			$comment_id  		= $this->request->comment_id;
			$post_comment   = trim($this->request->post_comment);
			$giphy_image   = trim($this->request->giphy_image);
			$user_id  		= Auth::id();
			
			$data = array();
			
			$data['post_id'] = $post_id;
				
			if($comment_id){
				$data['comment_type'] = 'update';
				$data['comment_id'] = $comment_id;
				$data['postcomment'] = $post_comment;
				$data['giphy_image'] = $giphy_image;
				PostComment::where('id', $comment_id)->where('user_id', Auth::id())->update(array('comment' => $post_comment, 'giphy_image' => $giphy_image));
				return response()->json($data);
			}else{
				$data['comment_type'] = 'create';
				$pcmt = PostComment::create(array('user_id' => $user_id, 'post_id' => $post_id, 'parent_id' => 0, 'comment' => $post_comment, 'giphy_image' => $giphy_image));
				$post = Post::find($post_id);
				
				if($pcmt and $user_id != $post->user_id){
					$dataNoti = json_encode(['comment_id'=>$pcmt->id,'post_id'=>$post_id,'user_id'=>Auth::User()->uniq_username,'to_user_id'=>$post->postUser->uniq_username,'type'=>3]);
					$messageNoti  = str_replace(array('{USER}', '{POST}'), array(Auth::User()->first_name." ".Auth::User()->last_name, $post->title), getLabels('commented_on_post'));
					//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' commented on post : '.$post->title;
					$data['notification'] = Notification::createNotifications(Auth::User()->uniq_username, $post->postUser->uniq_username, $messageNoti, 3, 0, $dataNoti);
				}
			}
			
			
			$count = PostComment::where('post_id', $post_id)->where('parent_id', 0)->count();
			$data['total_comments'] = ($count > 1)?$count." ".getLabels('comments'):$count." ".str_singular(getLabels('comments'));
			
			$comments = PostComment::where('parent_id', 0)->where('post_id', $post_id)->orderBy('id', 'DESC')->paginate(config('constants.PAGINATION_COMMENTS'));
			$comments_count = PostComment::where('parent_id', 0)->where('post_id', $post_id)->count();
			$display = "";
			
			if($comments_count > config('constants.PAGINATION_COMMENTS')){
				$display = "display";
			}
			
			$data['load_more'] = $display;
			
			$data['html'] = view('frontend/posts/load_more_comments',compact('comments'))->render();
			
    		return response()->json($data);
        }
		
	}
	
	
	
	
	
	public function update_post($slug = null){
		
		$id  = base64_decode($slug);
		$post = Post::where('user_id', Auth::id())->where('id', $id)->first();
		$postFiles = PostFile::where('post_id', $id)->get();
		if ($this->request->ajax() and $post) {
			$files = glob('public/upload/tmp/'.Auth::User()->uniq_username . '/*');
			File::delete($files);
			$view = view('frontend/posts/update_post',compact('post', 'postFiles'))->render();
            return response()->json(['html'=>$view]);
		}
	}
	
	
	
	public function remove_post($slug = null){
		$id  = base64_decode($slug);
		$post = Post::where('user_id', Auth::id())->where('id', $id)->first();
		$url_prefix = ($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))?env('ADMIN_PREFIX').'/':'';
		if($post->delete()){
			PostComment::where('post_id', $id)->delete();
			PostLike::where('post_id', $id)->delete();
			PostCommentLike::where('post_id', $id)->delete();
			$postfiles = PostFile::where('post_id', $id)->get();
			foreach($postfiles as $postfile){
				unlink('public/upload/posts/'.Auth::User()->uniq_username."/".$postfile->image_name);
			}
			PostFile::where('post_id', $id)->delete();
			$results = array("type" => "success", "url" => url($url_prefix.Auth::User()->uniq_username), "message" => getLabels('post_removed'));
		}else{
			$results = array("type" => "error", "url" => url($url_prefix, Auth::User()->uniq_username), "message" => getLabels('post_not_removed'));
		}
		return json_encode($results);
		
	}
	
	public function remove_comment($slug = null){
		$id  = base64_decode($slug);
		$comment = PostComment::where('user_id', Auth::id())->where('id', $id)->first();
		$post_id  = $comment->post_id;
		$url_prefix = ($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))?env('ADMIN_PREFIX').'/':'';
		
		if($comment->delete()){
			$comments_count = PostComment::where('parent_id', 0)->where('post_id', $post_id)->count();
			$display = "";
			if($comments_count > config('constants.PAGINATION_COMMENTS')){
				$display = "display";
			}
			$total_comments = ($comments_count > 1)?$comments_count." ".getLabels('comments'):$comments_count." ".str_singular(getLabels('comments'));
			PostCommentLike::where('post_comment_id', $id)->delete();
			$results = array("type" => "success", "url" => "comment_remove", 'total_comments' =>$total_comments, 'lost_id'=>$id, 'load_more'=>$display, 'parent_id' => $post_id, "message" => getLabels('comment_removed'));
		}else{
			$results = array("type" => "error", "url" => 'comment_remove', 'lost_id'=>$id, 'parent_id' => $post_id,"message" => getLabels('comment_not_removed'));
		}
		return json_encode($results);
		
	}
	
	
	public function notifications(){
		$page_title = getLabels("notifications");
		$data   = Notification::where('to_user_id', Auth::User()->uniq_username)->where('status', '!=', 2)->orderBy('created_at', 'DESC')->paginate(config('constants.PAGINATION_NOTIFICATION'));
		return view('frontend/posts/notifications', compact('page_title', 'data'));
	}
	
	
	public function marknotificationsread(){
		$notification_id  = $this->request->notification_id;
		$data   = Notification::where('to_user_id', Auth::User()->uniq_username);
		if($notification_id != 'all'){
			$data   = $data->where('id', $notification_id);
		}
		$data   = $data->update(['status' => 1]);
		$count  = Notification::where('to_user_id', Auth::User()->uniq_username)->where('status', 0)->count();
		$results = array('count' => $count);
		return json_encode($results);
	}
	
}
