<?php if($paginator->hasPages()): ?>
    <ul class="pagination justify-content-center mb-0">
       
        <?php if($paginator->onFirstPage()): ?>
              <li class="page-item disabled"><a class="page-link prev" href="<?php echo $paginator->previousPageUrl(); ?>" rel="prev"> <i class="simple-icon-arrow-left"></i></a></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link prev" href="<?php echo $paginator->previousPageUrl(); ?>" rel="prev"> <i class="simple-icon-arrow-left"></i></a></li>
        <?php endif; ?>


        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
            <?php if(is_string($element)): ?>
                <li class="page-item disabled"><span><?php echo $element; ?></span></li>
            <?php endif; ?>


           
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active"><a  class="page-link" href="<?php echo $url; ?>"><?php echo $page; ?></a></li>
                    <?php else: ?>
                         <li class="page-item"><a  class="page-link" href="<?php echo $url; ?>"><?php echo $page; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


       
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
				 <a class="page-link next" href="<?php echo $paginator->nextPageUrl(); ?>" aria-label="Next" rel="next">
					<i class="simple-icon-arrow-right"></i>
				</a>
			</li>
        <?php else: ?>
            <li class="page-item disabled">
				 <a class="page-link next" href="<?php echo $paginator->nextPageUrl(); ?>" aria-label="Next" rel="next">
					<i class="simple-icon-arrow-right"></i>
				</a>
			</li>
        <?php endif; ?>
    </ul>
<?php endif; ?>