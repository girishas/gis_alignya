

<?php $__env->startSection('content'); ?>
 
    <main style="opacity:1;">
        
    </main>
	<?php if(Auth::check()): ?>{
		<script type="text/javascript">
			window.onunload = refreshParent;
			function refreshParent() {
				window.opener.location.reload();
			}
			window.close();
			window.opener.location.reload();
		</script>
	<?php else: ?>
		<script type="text/javascript">
			window.onunload = refreshParent;
			function refreshParent() {
				window.opener.location.reload();
			}
			window.close();
			window.opener.location.reload();
		</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>