@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
        
  <main>
 <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Notifications</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                           
                            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">
            <div class="col-12 col-lg-12">
                                    <div class="card">
                                        <div class="position-absolute card-top-buttons">
                                            <button class="btn btn-header-light icon-button">
                                                <i class="simple-icon-refresh"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">You are successfully registered on Alignya!</p> 
                                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row mb-3 pb-3 border-bottom ">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l-4.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">Objective has been assigned to you.</p>
                                                        
                                                        <p class="text-muted mb-0 text-small">04.04.2018 - 01:45</p>
                                                    </a>
                                                </div>
                                            </div>
<div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">Measure has been assigned to you.</p> 
                                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row mb-3 pb-3 border-bottom ">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">Objective has been completed.</p>
                                                        
                                                        <p class="text-muted mb-0 text-small">04.04.2018 - 01:45</p>
                                                    </a>
                                                </div>
                                            </div>
<div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">KPI has been assigned to you.</p> 
                                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row mb-3 pb-3 border-bottom ">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l-4.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">Imitative status has been changed.</p>
                                                        
                                                        <p class="text-muted mb-0 text-small">04.04.2018 - 01:45</p>
                                                    </a>
                                                </div>
                                            </div>
<div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">Measure has been assigned to you.</p> 
                                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                                    </a>
                                                </div>
                                            </div>
                                           
                                            <div class="d-flex flex-row mb-3 pb-3 border-bottom ">
                                                <a href="#">
                                                    <img alt="Profile Picture" src="{!!url('public/img/profile-pic-l.jpg')!!}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class="pl-3">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-2">Objective has been assigned to you.</p>
                                                        
                                                        <p class="text-muted mb-0 text-small">04.04.2018 - 01:45</p>
                                                    </a>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>

            </div>
        </div>

</main>
@stop