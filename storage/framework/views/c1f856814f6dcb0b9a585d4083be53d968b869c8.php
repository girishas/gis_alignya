<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Members'); ?></h1>
                     <div class="float-md-right">
                     		<?php if($data->total() < getEmpLimit(Auth::User()->company_id)): ?>
							<button type="button" class="btn btn-outline-primary mb-1" onclick="addMember()">Add Member</button>
							<button type="button" class="btn btn-outline-primary mb-1" onclick="importcsv()">Import Members</button>
							<?php endif; ?>
							
							
							<a href="<?php echo url('department'); ?>"><button type="button" class="btn btn-primary mb-1">Departments</button></a>
							<a href="<?php echo url('team'); ?>"><button type="button" class="btn btn-primary mb-1">Teams</button></a>
							
							
                            
                        </div>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Members'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
            <?php if(session('message')): ?>
			<div class="alert alert-success alert-dismissible" role="alert" style="z-index: unset;">
				<?php echo session('message'); ?>

				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<?php endif; ?>

			<?php if(Auth::User()->current_membership_plan == 1 || Auth::User()->current_membership_plan == 4): ?>
			<div class="alert alert-warning alert-dismissible" role="alert" style="z-index: unset;">
				Upgrade your membership for add more team members. <a href="<?php echo url('subscription'); ?>">Click Here</a>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<?php endif; ?>
			<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">

                            <h5 class="mb-4"><?php echo getLabels('Search'); ?></h5>
                            <?php echo Form::open(array('url' => array($route_prefix.'/members'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')); ?>

								<div class="form-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<?php echo Form::text('first_name', isset($_POST['first_name'])?trim($_POST['first_name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name'))); ?>

											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<?php echo Form::text('email', isset($_POST['email'])?trim($_POST['email']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_email'))); ?>

											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<?php echo Form::select('status', array('' => getLabels('all_status')) + config('constants.STATUS'), isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control')); ?>

											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit"><?php echo getLabels('Search'); ?></button>
											<a class="btn btn-dark mb-1 steamerst_link" href="<?php echo url($route_prefix, 'members'); ?>"><?php echo getLabels('show_all'); ?></a>
										</div>
									</div>
								</div>
							<?php echo Form::close(); ?>

                        </div>
                    </div>
				</div>
			</div>
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
										   <th> <?php echo getLabels('name'); ?> </th>
											<th> <?php echo getLabels('email'); ?> </th>
											<th> <?php echo getLabels('user_type'); ?> </th>
											<th class="text-center"> <?php echo getLabels('designation'); ?> </th>
											<th class="text-center"> <?php echo getLabels('status'); ?> </th>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$data->isEmpty()): ?>
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr class="odd gradeX">
													<td><?php echo $val->first_name." ".$val->last_name; ?></td>
													<td>
														<a href="mailto:<?php echo $val->email; ?>"> <?php echo $val->email; ?> </a>
													</td>
													<td><?php echo config('constants.USER_TYPES.'.$val->role_id); ?></td>
													<td class="text-center">
														<?php echo $val->designation; ?>

													</td>
													<td class="text-center"><?php echo config('constants.STATUS.'.$val->status); ?></td>
													<td>
														<?php if($val->role_id > Auth::User()->role_id): ?>
														<a href="javascript:void(0);" onclick="updatemember(<?php echo $val->id; ?>)"><i class="heading-icon simple-icon-pencil"></i></a>
														<?php endif; ?>
																<a href="javascript:void(0);" onclick="viewmember(<?php echo $val->id; ?>)"><i class="heading-icon iconsminds-information"></i></a>
													<?php
													$remove_msg = "Are You Sure";
													$remove_url = url('member/remove/'.$val->id);
													 ?>
														<?php if(Auth::User()->role_id == 2): ?>
														<a  onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);" title="Remove"><i class="simple-icon-trash heading-icon"></i></a>
														<?php endif; ?>		
													</td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
										<tr class="odd gradeX">
											<td colspan="6" class="no_record"><?php echo getLabels('records_not_found'); ?></td>
										</tr>
									<?php endif; ?>
									</tbody>
								</table>
							</div>
							<br />
							
							<div class="row">
								<div class="col-12 text-center">
									<p class="justify-content-center "><?php echo str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')); ?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<?php echo $data->links('frontend.pagination_custom'); ?>

								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php echo $__env->make('Element/users/addmember', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/users/importmember', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/js/includejs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div id="viewMemberShow"></div>
    <div id="modalShow"></div>
    <script type="text/javascript">
    	$(document).ready(function(){
    		var erroradd = "<?php echo session('errormessageadd')?session('errormessageadd'):''; ?>";
    		if(erroradd != ""){
    			addMember();
    		}
    		var errorupdate = "<?php echo session('errormessageupdate')?session('errormessageupdate'):''; ?>";
    		if(errorupdate != ""){
    			$("#updatemember").modal("show");
    		}
    		$("#importmemberhide").click(function(){
    			$("#importmember").modal("hide");
    		})
    		var rejected = <?=json_encode(session('rejected_arr'))?>;
    		var errormessage = "<?php echo session('errormessage')?session('errormessage'):''; ?>";
    		if(rejected != null || errormessage != ''){
    			importcsv();
    		}

    	});
    	function addMember(){
    		$("#addmember").modal("show");
    	}
    	$("#addmemberhide").click(function(){
    		$("#addmember").modal("hide");
    	});
    	function updatemember(id){
    		var token = "<?php echo csrf_token(); ?>";
	        $.ajax({
	            type:"POST",
	            url: "<?php echo url('/setuserdatasession'); ?>",
	            data:'_token='+token+'&id='+id,
	            dataType:'html',
	            success: function (response) {
	            	$("#modalShow").html(response);
    				$("#updatemember").modal("show");
	            }  
	        });
    	}

    	function viewmember(id){
    		var token = "<?php echo csrf_token(); ?>";
	        $.ajax({
	            type:"POST",
	            url: "<?php echo url('/viewmember'); ?>",
	            data:'_token='+token+'&id='+id,
	            dataType:'html',
	            success: function (response) {
	            	$("#viewMemberShow").html(response);
    				$("#viewmember").modal("show");
	            }  
	        });
    	}

    	function importcsv(){
    		$("#importmember").modal("show");
    	}
    	
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>