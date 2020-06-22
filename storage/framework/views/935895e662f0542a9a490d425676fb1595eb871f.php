<?php if(empty($_POST)): ?>

<?php endif; ?>


<?php if(empty($_POST)): ?>
<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

	
  <main>
  <?php endif; ?>
  <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>Ideas</h1>
                        <div class="top-right-button-container">
                            <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1"
                                data-toggle="modal" data-backdrop="static" data-target="#exampleModal">ADD A NEW IDEA</button>
                            <div class="modal fade modal-right" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Details</label>
                                                    <textarea class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-control select2-single" data-width="100%">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">Flexbox</option>
                                                        <option value="Sass">Sass</option>
                                                        <option value="React">React</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Labels</label>
                                                    <select class="form-control select2-multiple" multiple="multiple" data-width="100%">
                                                        <option value="New Framework">New Framework</option>
                                                        <option value="Education">Education</option>
                                                        <option value="Personal">Personal</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1">
                                                        <label class="custom-control-label"
                                                            for="customCheck1">Completed</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                            role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse d-md-block" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                <div class="btn-group float-md-left mr-1 mb-1">
                                    <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Order By
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </div>
                                </div>
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input placeholder="Search Ideas...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                    <div class="list disable-text-selection" data-check-all="checkAll">
                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-15">France Launch</span>
                                    
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">As part of informationalization</p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created 2 days ago By Brayan</p>
                                    <div class="w-15 w-xs-100">
                                       <i class="simple-icon-bubbles"></i> 23
                                    </div> <div class="w-15 w-xs-100">
                                       <i class="simple-icon-like"></i> 16
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                               <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-15">Maxico Launch</span>
                                    
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">As part of informationalization </p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created 2 days ago By Brayan</p>
                                    <div class="w-15 w-xs-100">
                                       <i class="simple-icon-bubbles"></i> 23
                                    </div> <div class="w-15 w-xs-100">
                                       <i class="simple-icon-like"></i> 16
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                               <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-15">Self Service Mentor Application</span>
                                    
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">As part of informationalization</p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created 2 days ago By Brayan</p>
                                    <div class="w-15 w-xs-100">
                                       <i class="simple-icon-bubbles"></i> 23
                                    </div> <div class="w-15 w-xs-100">
                                       <i class="simple-icon-like"></i> 16
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
                    <ul class="list-unstyled mb-5">
                        <li class="active">
                            <a href="#">
                                <i class="simple-icon-bulb"></i>
                                My Ideas
                                <span class="float-right">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="simple-icon-like"></i>
                                My Votes
                                <span class="float-right">24</span>
                            </a>
                        </li>
                    </ul>

                    <p class="text-muted text-small">Filter By Categories</p>
                    <ul class="list-unstyled mb-5">
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="category1">
                                <label class="custom-control-label" for="category1">Map</label>
                                <span class="float-right">52</span>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="category2">
                                <label class="custom-control-label" for="category2">Profile</label>
                                <span class="float-right">28</span>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="category3">
                                <label class="custom-control-label" for="category3">Social</label>
                                <span class="float-right">37</span>
                            </div>
                        </li>
                    </ul>
                    <p class="text-muted text-small">Filter By Status</p>
                    <ul class="list-unstyled mb-5">
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="category1">
                                <label class="custom-control-label" for="category1">Already Exist</label>
                                <span class="float-right">48</span>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="category2">
                                <label class="custom-control-label" for="category2">Will Not Implement</label>
                                <span class="float-right">17</span>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="category3">
                                <label class="custom-control-label" for="category3">Planned</label>
                                <span class="float-right">114</span>
                            </div>
                        </li>

                        <li>
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="category3">
                                <label class="custom-control-label" for="category3">Shipped</label>
                                <span class="float-right">200</span>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <a class="app-menu-button d-inline-block d-xl-none" href="#">
                <i class="simple-icon-options"></i>
            </a>
        </div>

   </div>
            </div>
        </div>
  
	<?php if(empty($_POST)): ?>
    </main>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>