{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title">{!! getLabels('update_group') !!} : {!! $group->name !!}</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	{!! Form::model($group, array('url' => array($route_prefix.'/groups'), 'class' =>'steamerstudio_groupform needs-validation tooltip-label-right', 'name'=>'Search')) !!}
		<div class="modal-body">
			{!! Form::hidden("id", $group->id) !!}
			<div class="form-group  position-relative error-l-50">
				<label>{!! getLabels('Name') !!}</label>
				{!! Form::text("name", null, array("class"=>"form-control")) !!}
				<div class="invalid-tooltip"></div>
			</div>
			<div class="form-group  position-relative error-l-50">
				<label>{!! getLabels('Icon') !!}</label>
				<div class="slim" data-ratio="1:1" id="myCropper" data-size="150,150" data-instant-edit="true" style="height:120px;width:120px;"  data-label="{!! getLabels('Drop_your_icon_here') !!}" data-min-size="120,120">
					@if($group->icon and file_exists('public/upload/groups/'. $group->icon) )
						{!! HTML::image('public/upload/groups/'. $group->icon, $group->name) !!}
					@endif
					<input type="file" name="image"/>
				</div>
				<div class="invalid-tooltip"></div>
			</div>
			<div class="form-group  position-relative error-l-50">
				<label>{!! getLabels('Privacy') !!}</label>
				{!! Form::select("privacy", config('constants.GROUPPRIVACY'), null, array("class"=>"form-control")) !!}
				<div class="invalid-tooltip"></div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-outline-primary" data-dismiss="modal">{!! getLabels('Cancel') !!}</button>
			<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>
		</div>
	{!! Form::close() !!}
</div>