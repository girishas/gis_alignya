@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-12">

                    <div class="mb-2">
                        <h1>Subscription</h1>
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                            </ol>
                        </nav>
                        
                          <div class="float-md-right">
                           <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                  <label class="btn btn-secondary active">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Monthly
                                  </label>
                                   
                                  <label class="btn btn-secondary">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> Yearly
                                  </label>
                                </div>
                          </div>
                        <div class="separator mb-3"></div>
                    </div> 
                    
                    
                    <div class="row equal-height-container">

                        <div class="col-12 mb-4 ">
                           Please choose subscription for membership plan!!
                        </div>

                        
                        <div class="col-md-12 col-lg-4 mb-4 col-item">
                            <div class="card">
                                <div
                                    class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-male large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">BASIC</h5>
                                        <p class="text-large mb-2 text-default">$11</p>
                                        <p class="text-muted text-small">Upto 5 Members</p>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="mb-0 ">
                                                    30 Days Trial Period
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    24/5 support
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Number of end products 1
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Free updates
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Forum support
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="{!!url('invoice')!!}" class="btn btn-link btn-empty btn-lg">PURCHASE <i
                                                    class="simple-icon-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4 mb-4 col-item">
                            <div class="card">
                                <div
                                    class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-male-female large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">PROFESSIONAL</h5>
                                        <p class="text-large mb-2 text-default">$25</p>
                                        <p class="text-muted text-small">Upto 15 Members</p>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="mb-0 ">
                                                    30 Days Trial Period
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    24/5 support
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Number of end products 1
                                                </p>
                                            </li>

                                            <li>
                                                <p class="mb-0 ">
                                                    Two factor authentication
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Free updates
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Forum support
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="{!!url('invoice')!!}" class="btn btn-link btn-empty btn-lg">PURCHASE <i
                                                    class="simple-icon-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4 mb-4 col-item">
                            <div class="card">
                                <div
                                    class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-mens large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">ENTERPRISE</h5>
                                        <p class="text-large mb-2 text-default">$50</p>
                                        <p class="text-muted text-small">Unlimited Members</p>
                                    </div>
                                    <div
                                        class="pl-3 pr-3 pt-3 pb-0 flex-grow-1 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="mb-0 ">
                                                    30 Days Trial Period
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    24/7 support
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Number of end products 1
                                                </p>
                                            </li>

                                            <li>
                                                <p class="mb-0 ">
                                                    Two factor authentication
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Free updates
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Forum support
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="{!!url('invoice')!!}" class="btn btn-link btn-empty btn-lg">PURCHASE <i
                                                    class="simple-icon-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h5>Feature Comparison</h5>
                </div>

                <div class="d-none d-md-block col-12">
                    <div class="card d-flex flex-row mb-3 table-heading">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <p class="list-item-heading mb-0 truncate w-40 w-xs-100"></p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">BASIC</p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">PROFESSIONAL</p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">ENTERPRISE</p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <p class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                    Two factor authentication
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <p class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                    Team permissions
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">

                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <p class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                    24/5 Support
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">

                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <p class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                    24/7 Support
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">

                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">

                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <p class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                    User actions audit log
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">

                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                </p>
                                <p class="mb-0 text-primary w-20 w-xs-100 text-center">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- For small screens -->
                <div class="d-block d-md-none col-12">

                    <div class="card d-flex flex-row mb-3 table-heading">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body pl-0 pb-0">
                                <p class="list-item-heading mb-0 text-primary">Two factor
                                    authentication</p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    BASIC
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    PROFESSIONAL
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    ENTERPRISE
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="card d-flex flex-row mb-3 table-heading">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body pl-0 pb-0">
                                <p class="list-item-heading mb-0 text-primary">Team permissions</p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    BASIC
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    PROFESSIONAL
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    ENTERPRISE
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="card d-flex flex-row mb-3 table-heading">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body pl-0 pb-0">
                                <p class="list-item-heading mb-0 text-primary">24/5 Support</p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    BASIC
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    PROFESSIONAL
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    ENTERPRISE
                                </p>

                            </div>
                        </div>
                    </div>



                    <div class="card d-flex flex-row mb-3 table-heading">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body pl-0 pb-0">
                                <p class="list-item-heading mb-0 text-primary">24/7 Support</p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    BASIC
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    PROFESSIONAL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    ENTERPRISE
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="card d-flex flex-row mb-3 table-heading">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body pl-0 pb-0">
                                <p class="list-item-heading mb-0 text-primary">User actions audit log</p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    BASIC
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    PROFESSIONAL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-row">
                                <p class="list-item-heading mb-0 truncate w-70">
                                    ENTERPRISE
                                </p>
                                <p class="text-primary text-right mb-0 w-30 text-one">
                                    <i class="simple-icon-check"></i>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </main>
@stop