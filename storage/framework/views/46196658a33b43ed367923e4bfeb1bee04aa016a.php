<li class="dropdown-submenu"><a class="dropdown-item" href="<?php echo url('department/'.$department->id); ?>"><?php echo $department->department_name; ?></a>
	<ul class="dropdown-menu">
		<?php $__currentLoopData = getSubDepartment($department->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky => $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    <?php if(empty(getSubDepartment($vs['id']))): ?>
	    <li class="dropdown-item"><a href="<?php echo url('department/'.$vs['id']); ?>"><?php echo $vs['department_name']; ?></a></li>
	   	<?php else: ?>
	   	    <li class="dropdown-submenu"><a class="dropdown-item" href="<?php echo url('department/'.$vs['id']); ?>"><?php echo $vs['department_name']; ?></a>
            <ul class="dropdown-menu">
            	<?php $__currentLoopData = getSubDepartment($vs['id']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky => $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="dropdown-item"><a href="<?php echo url('department/'.$vs['id']); ?>"><?php echo $vs['department_name']; ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </li>
	    <?php endif; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</li>