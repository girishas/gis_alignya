@if(count($post->postFiles) > 0)
	<?php $more_images = false; $html_detail = $html_thumb = ""; $gall_images = array(); ?>
	@foreach($post->postFiles as $k=>$postfile) <?php 
		$html_detail .= ' <li class="glide__slide">'.HTML::image("public/upload/posts/".Auth::User()->uniq_username."/".$postfile->image_name, "Detail", array("class"=>"responsive border-0 border-radius img-fluid mb-3")).'</li>';
		$html_thumb .= ' <li class="glide__slide">'.HTML::image("public/upload/posts/".Auth::User()->uniq_username."/".$postfile->image_name, "Thumb", array("class"=>"responsive border-0 border-radius img-fluid ")).'</li>';?>
	@endforeach
	<?php $htmlImage  = array('detail' => $html_detail, 'thumb' => $html_thumb); ?>
	<div class="mb-5" style="position:relative;">
		<ul style="padding:0px;margin:0px;padding-left:-3px;padding-right:-3px;">
			@foreach($post->postFiles as $k=>$postfile)
				@if($k > 5)
				<?php $more_images = true; ?>
				<?php break; ?>
				@endif
				<li style="list-style:none;float:left;padding:3px;margin:0px;"><a rel="{!! $k !!}" href="javascript:void(0);" onclick='showPostFilesModal(<?php echo json_encode($htmlImage); ?>,{!! $k !!});'>{!! HTML::image('public/upload/posts/'.Auth::User()->uniq_username.'/'.$postfile->image_name, "", array("style"=>"height:150px;border-radius:10px;", "class"=>"img-fluid border-radius")) !!}</a></li>
			@endforeach
		</ul>
		<div style="clear:both;"></div>
		
		@if($more_images)
			<a href="javascript:void(0);" rel="6" class="btn btn-primary mb-1" onclick='showPostFilesModal(<?php echo json_encode($htmlImage); ?>, 6);' style="position:absolute;bottom:40px;right:85px;opacity:0.9;"> + {!! count($post->postFiles) - 6 !!}</a>
		@endif
	</div>
@endif
