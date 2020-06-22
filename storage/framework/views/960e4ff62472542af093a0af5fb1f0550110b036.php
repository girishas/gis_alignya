<div style="height: 350px;overflow: auto;" class="ttrr">
	<div id="fgoto_recent_emoji">
		
	</div>
	<?php $__currentLoopData = $file_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$file_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($key != 'smileys'): ?>
		<div id="fgoto_<?php echo $key; ?>">	
			<h3 class="emoji_heading" style="text-transform: capitalize;"><?php echo $key; ?></h3>   
		<?php endif; ?>
			<?php $__currentLoopData = $file_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<span rel="<?php echo $val; ?>" class="emoji_click">
					<div class="emoji_div">
						<img class="emoji_icon" rel="<?php echo $val; ?>" src="<?php echo $val; ?>">
					</div>
				</span>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php if($key != 'smiley'): ?>
		</div> 
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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