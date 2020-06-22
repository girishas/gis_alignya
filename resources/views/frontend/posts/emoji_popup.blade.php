<div style="height: 350px;overflow: auto;" class="ttrr">
	<div id="fgoto_recent_emoji">
		
	</div>
	@foreach($file_data as $key=>$file_val)
		@if($key != 'smileys')
		<div id="fgoto_{!! $key !!}">	
			<h3 class="emoji_heading" style="text-transform: capitalize;">{!! $key !!}</h3>   
		@endif
			@foreach($file_val as $val)
				<span rel="{!! $val !!}" class="emoji_click">
					<div class="emoji_div">
						<img class="emoji_icon" rel="{!! $val !!}" src="{!! $val !!}">
					</div>
				</span>
			@endforeach
	@if($key != 'smiley')
		</div> 
		@endif
	@endforeach
	</div>
</div>

<div class="col-sm-12 btns_emoji btns_emoji_new ">
	<ul class="femoji">
		<li>
			<a id="goto_recent_emoji" href="javascript:void(0)" class="goto_class active"><i class="simple-icon-clock font18"></i></a>
		</li>
		<li>
			<a id="goto_smiley" class="goto_class" href="javascript:void(0)"><i class="simple-icon-emotsmile font18"></i></a>
		</li>
		<li>
			<a id="goto_activity" class="goto_class" href="javascript:void(0)"><i class="iconsminds-soccer-ball lh1 font18"></i></a>
		</li>
		<li>
			<a id="goto_animals" class="goto_class" href="javascript:void(0)"><i class="iconsminds-deer lh1 font18"></i></a>
		</li>
		<li>
			<a id="goto_flags" class="goto_class" href="javascript:void(0)"><i class="simple-icon-flag font18"></i></a>
		</li>
		<li>
			<a id="goto_food" class="goto_class" href="javascript:void(0)"><i class="iconsminds-hamburger lh1 font18"></i></a>
		</li>
		<li>
			<a id="goto_objects" class="goto_class" href="javascript:void(0)"><i class="simple-icon-diamond font18"></i></a>
		</li>
		<li>
			<a id="goto_symbols" class="goto_class" href="javascript:void(0)"><i class="simple-icon-target font18"></i></a>
		</li>
		<li>
			<a id="goto_travel" class="goto_class" href="javascript:void(0)"><i class="iconsminds-plane lh1 font18"></i></a>
		</li>
	</ul>
</div>