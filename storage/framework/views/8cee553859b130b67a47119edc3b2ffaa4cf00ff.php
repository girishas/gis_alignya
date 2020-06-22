<?php if(session('message')): ?>
	<div class="alert alert-success" role="alert">
		<?php echo session('message'); ?>

	</div>
<?php elseif(session('errormessage')): ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo session('errormessage'); ?>

	</div>
<?php endif; ?>