<?php if(!empty($objectives)): ?>
<?php $__currentLoopData = $objectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="javascript:void(0);">
            <span class="align-middle d-inline-block"><?php echo $obj->heading; ?></span>
        </a>
    </td>
    <td> 
        <p class="text-semi-muted mb-2">Objective</p>  
    </td>
      <td> 
        <span class="badge badge-pill badge-secondary">ON HOLD</span>  
    </td>
    <td>
        <div role="progressbar" class="progress-bar-circle position-relative"
            data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
            aria-valuenow="40" data-show-percent="true">
        </div>
    </td>
   
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
                                     