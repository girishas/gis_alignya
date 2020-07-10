
	{!! Form::model($post, array('url' => array($route_prefix.'/'.Auth::User()->uniq_username), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'files' => true, 'id'=>'post_form_update', 'name'=>'Search')) !!}
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{!! getLabels('update_post') !!} : {!! $post->title !!}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			
			<div class="modal-body bg_input">
				{!! Form::hidden('id', null) !!}
				<label class="form-group has-float-label mb-4">
					{!! Form::text('live_url', null, array("id" => "post_live_url_update", "class" => "form-control")) !!}
					<div class="invalid-tooltip"></div>
					<span>{!! getLabels('URL_youtube_vimeo_mixer_twitch') !!} </span>
				</label>
				
				<label class="form-group has-float-label mb-4">
					{!! Form::text('title', null, array("class" => "form-control")) !!}
					<div class="invalid-tooltip"></div>
					<span>{!! getLabels('Title') !!}</span>
				</label>
				
				 <label class="form-group has-float-label mb-4">
					{!! Form::textarea('description', null, array("class" => "summernote_update form-control" )) !!}
					<div class="invalid-tooltip"></div>
					<span>{!! getLabels('Description') !!}</span>
				</label>
				<div class="form-row">
					<label class="form-group has-float-label mb-4 position-relative error-l-40 col-md-6">
						{!! Form::text('scheduled_starttime', null, array('class' => 'input-sm form-control', "id"=>"start_date_update", 'placeholder'=> ''))!!}
						<div class="invalid-tooltip"></div>
						<span>{!! getLabels('Schedule') !!}</span>
					</label>
					<label class="form-group has-float-label mb-4 position-relative error-l-40 col-md-6">
						{!! Form::select('who_can_see', ['1'=>getLabels('public'), '2' => getLabels('followers'), '3'=>getLabels('only_me')], null, array('class' => 'input-lg form-control'))!!}
						<span>{!! getLabels('Visible_to') !!}</span>
					</label>
				</div>
				
				<div class="form-group">
					<a href="javascript:void(0)" class="btn btn-outline-dark" onclick="$('#pro-image').click()"><i class="simple-icon-picture"></i>&nbsp;&nbsp;{!! getLabels('Add_Images') !!}</a>
					<input type="file" accept='image/*' id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
				</div>
				@if(count($postFiles) > 0)
					<div class="preview-images-zone">
						<?php $p = 1000;  ?>
						@foreach($postFiles as $postFile)
							<div class="preview-image preview-show-{!! $p !!}"><div class="image-cancel" data-no="{!! $p !!}">x</div><div class="image-zone">
								{!! Form::hidden('post_files['.$p.']', $postFile->id)!!}
								{!! HTML::image('public/upload/posts/'.Auth::User()->uniq_username.'/'.$postFile->image_name,"", array("id"=>"pro-img-".$p)) !!}
							</div></div>
							<?php $p++; ?>
						@endforeach
					</div>
				@else
					<div class="preview-images-zone hidden"></div>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary cancel_modal" data-dismiss="modal">{!! getLabels('Cancel') !!}</button>
				<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>
			</div>
		</div>
	{!! Form::close() !!}

<script>
	jQuery('#start_date_update').bootstrapMaterialDatePicker({ 
		format : 'YYYY-MM-DD H:mm:ss', 
		minDate: moment(),
		shortTime:false,
		switchOnClick:true,
		autoClose:true
	});
	jQuery('.summernote_update').summernote({
		height: 100,
		popover: {
			image: [],
			link: [],
			air: []
		},
		toolbar: [
			['font', ['bold', 'underline', 'italic', 'clear']],
			// ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['insert', ['picture']],
		],
	});
</script>