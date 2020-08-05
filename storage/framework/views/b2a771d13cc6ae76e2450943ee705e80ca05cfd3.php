<?php if(empty($_POST)): ?>

<?php endif; ?>

<?php $__env->startSection('content'); ?>
 <main>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12" data-check-all="checkAll">
                    <div class="mb-2">
                        <h1>
                            <i class="simple-icon-refresh heading-icon"></i>
                            <span class="align-middle d-inline-block pt-1"><?php echo $idea_details->title; ?></span>
                        </h1>
                       
                    </div>

                    <div class="tab-content mb-4">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">
                                <div class="col-lg-4 col-12 mb-4">
                                    <div class="card mb-4">
                                        <div class="position-absolute card-top-buttons">
                                            <button class="btn btn-header-light icon-button">
                                                <i class="simple-icon-pencil"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <p class="list-item-heading mb-4">Summary</p>
                                            
                                            <p class="mb-3"><?php echo $idea_details->description; ?>

                                            </p>

                                            
                                            <p class="text-muted text-small mb-2">Created By</p>
                                            <div class="mb-3">
                                               <p class="mb-3">
                                                <?php echo $idea_details->created_by; ?>

                                            </p>  
                                                
                                            </div>
                                            <p class="text-muted text-small mb-2">Category</p>
                                            <div>
                                                <p class="d-sm-inline-block mb-1">
                                                    <?php echo $idea_details->category_name; ?>

                                                </p>
                                                
                                            </div>
                                            <p class="text-muted text-small mb-2">Department</p>
                                            <div>
                                                <p class="d-sm-inline-block mb-1">
                                                    <?php echo $idea_details->department_name; ?>

                                                </p>
                                                
                                            </div>
                                            <p class="text-muted text-small mb-2">Status</p>
                                            <div>
                                                <p class="d-sm-inline-block mb-1">
                                                    <?php echo $idea_details->status_name; ?>

                                                </p>
                                                
                                            </div>
                                            <p class="text-muted text-small mb-2">Posted Date</p>
                                            <p class="mb-3">
                                                <?php echo createdat($idea_details->created_at); ?>

                                            </p>
                                             <p class="text-muted text-small mb-2">
                                                 <i class="simple-icon-bubbles"></i>
                                            <?php echo ideacommentscount($idea_details->id); ?> &nbsp; <i class="simple-icon-like"></i> <?php echo idealikescount($idea_details->id); ?>

                                        </p>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-12 col-lg-8">
                                     <div class="card mb-2">
                                        <div class="card-body">
                                            <?php echo Form::open(array('url' => array($route_prefix.'/idea-details/'.$id), 'class' =>'steamerstudio_form', 'name'=>'Search')); ?>

                                            <div class="position-relative error-l-100">
                                            <textarea name="comments" class="form-control flex-grow-1" placeholder="type comment here..."></textarea>
                                            <div class="invalid-tooltip"></div>
                                        </div>
                                            <br>
                                            <button type="submit" class="btn badge-outline-primary btn-sm float-right">
                                                Submit
                                            </button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <?php if(count($comments->toArray())>0): ?>
                                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="<?php echo url('public/img/profile-pic-l.jpg'); ?>"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2"><?php echo $value->commented_by; ?></p>
                                                        <p class="text-semi-muted mb-1">
                                                            <?php echo $value->comments; ?>

                                                        </p>
                                                        <p class="text-muted mb-2 text-small">
                                                            <?php echo date('d.m.Y - h:i a',strtotime($value->created_at)); ?></p>
                                                    <p class="text-muted text-small mb-2">
                                                             <i class="simple-icon-like"></i>
                                                        <?php echo ideacommentscount($idea_details->id); ?> &nbsp; <i class="simple-icon-dislike"></i> <?php echo idealikescount($idea_details->id); ?>

                                                    </p>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <p class="text-small text-center">No Record found</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                            <div class="row">
                                <div class="col-lg-4 col-12 mb-4">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <p class="list-item-heading mb-4">Overview</p>
                                            <div class="mb-4">
                                                <p class="mb-2">Pull Requests
                                                    <span class="float-right text-muted">12/18</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span
                                                                    class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">3
                                                                    Merged Requests</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span
                                                                    class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">2
                                                                    Proposed Requests</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div>
                                                <p class="mb-2">Issues
                                                    <span class="float-right text-muted">24/32</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span
                                                                    class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span
                                                                    class="font-weight-medium text-muted text-small">24
                                                                    Closed</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span
                                                                    class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">6
                                                                    Active</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-4">Frequency</h6>
                                            <div class="dashboard-donut-chart chart">
                                                <canvas id="frequencyChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="d-flex flex-row mb-2  mb-4">
                                                <a class="d-flex" href="#">
                                                    <img alt="Profile Picture" src="img/profile-pic-l.jpg"
                                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Sarah Kortney</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">315 Commits</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart1"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="d-flex flex-row mb-2  mb-4">
                                                <a class="d-flex" href="#">
                                                    <img alt="Profile Picture" src="img/profile-pic-l-4.jpg"
                                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Latarsha Gama</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">482 Commits</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart2"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-row mb-2  mb-4">
                                                <a class="d-flex" href="#">
                                                    <img alt="Profile Picture" src="img/profile-pic-l-3.jpg"
                                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Williemae Lagasse</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">102 Commits</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart3"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="app-menu">
            <div class="p-4 h-100">
                <div class="scroll">
                    <p class="text-muted text-small">Popular Ideas</p>
                    <ul class="list-unstyled mb-5">
                        <?php if(!empty($popular_ideas)): ?>
                        <?php $__currentLoopData = $popular_ideas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="active">
                            <a href="<?php echo url('idea-details/'.$popular->id); ?>">
                                <i class="iconsminds-idea"></i>
                                <?php if(strlen($popular->title)>20): ?>
                                <?php echo substr($popular->title,0,20); ?>

                                <?php else: ?>
                                <?php echo $popular->title; ?>

                                <?php endif; ?>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <a class="app-menu-button d-inline-block d-xl-none" href="#">
                <i class="simple-icon-options"></i>
            </a>
        </div>
    </main>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>