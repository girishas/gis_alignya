<?php
	$totalUnreadMessage = totalUnreadMessage();
	$msgHeaders = getMessagesHeader();  ?>
	<button class="header-icon btn btn-empty" type="button" id="headerMsgButton"
		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="simple-icon-bubbles"></i>
		<span class="count" id="totalUnreadMessage" style="<?php echo $totalUnreadMessage > 0?'opacity:1;':'opacity:0'; ?>"><?php echo $totalUnreadMessage; ?></span>
	</button>
	<div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="headerMsgDropdown">
		<div class="scroll"  id="my_msg_list">
			<?php if(!$msgHeaders->isEmpty()): ?>
				<?php $__currentLoopData = $msgHeaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgHeader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $elem = ($msgHeader->group_id)?$msgHeader->group_id:$msgHeader->sender; ?>
					<div class="d-flex flex-row mb-3 pb-3 border-bottom" id="mymsdiv<?php echo $elem; ?>">
						<a href="javascript:void(0);">
							<?php echo showImage($msgHeader->User->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $msgHeader->User->first_name, 'users/profile-photo'); ?>

							
						</a>
						<div class="pl-3">
							<?php if($msgHeader->group_id): ?>
								<a href="<?php echo url($route_prefix.'/groups/'.$msgHeader->group_id); ?>" class="steamerst_link">
							<?php else: ?>
								<a href="<?php echo url($route_prefix.'/messages/'.$msgHeader->sender); ?>" class="steamerst_link">
							<?php endif; ?>
								<p class="list-item-heading mb-1 truncate"><?php echo $msgHeader->User->first_name." ".$msgHeader->User->last_name; ?></p>
								<p class="font-weight-medium mb-1"><?php echo $msgHeader->message; ?></p>
								<p class="text-muted mb-0 text-small"><?php echo date('d/m/Y H:i:s', strtotime($msgHeader->created_at)); ?></p>
							</a>
						</div>
					</div>
					
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php else: ?>
				<div class="d-flex flex-row mb-3 pb-3 border-bottom">
					<p class="font-weight-medium mb-1 text-light text-center"><?php echo getLabels('no_messages_yet'); ?></p>
				</div>
			<?php endif; ?>
			 
		</div>
		<p class="text-center">
			<a  href="<?php echo url($route_prefix, 'messages'); ?>"  class="text-primary bold steamerst_link"><?php echo getLabels('view_all_messages'); ?></a>
		</p>
	</div>