@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Scorecard</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Scorecard</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
                <!-- <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Filters</h5>
                        <div class="row">
                        <div class="col-md-3">
                            <label>Goal Cycle</label>
                            <select class="form-control select2-single" data-width="100%">
                                <option >5 Year Strategy</option>
                                <option >3 Year Strategy</option>
                                <option >FY-2020</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Organization Unit</label>
                            <select class="form-control select2-single" data-width="100%">
                                <option label="&nbsp;">5 Year Strategy</option>
                                <option label="&nbsp;">3 Year Strategy</option>
                                <option label="&nbsp;">FY-2020</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label><span class="glyphicon glyphicon-asterisk"></span>Owner</label>
                            <select class="form-control select2-single" data-width="100%">
                                <option label="&nbsp;">5 Year Strategy</option>
                                <option label="&nbsp;">3 Year Strategy</option>
                                <option label="&nbsp;">FY-2020</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Goal Cycle</label>
                            <select class="form-control select2-single" data-width="100%">
                                <option label="&nbsp;">5 Year Strategy</option>
                                <option label="&nbsp;">3 Year Strategy</option>
                                <option label="&nbsp;">FY-2020</option>
                            </select>
                        </div>
                    </div>
                    </div>
                </div>-->
                    <div class="card">
                        <div class="card-body">
                           
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Objective</th>
                                        <th scope="col">Measure</th>
                                        <th scope="col">Initiative</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($financial))
                                    @foreach($financial as $key => $value)
                                    <tr>
                                        @if($key == '0')
                                        <th scope="row">Financial</th>
                                        @else
                                        <th scope="row"></th>
                                        @endif
                                        <td><i class="fa fa-arrow-circle-up" style="font-size:23px;color:green;"></i> {!!$value->heading!!}</td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Revenue</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                   <!--  <tr>
                                        <th ></th>
                                        <td></td>
                                        <td><i class="fa fa-arrow-circle-up" style="font-size:23px;color:green;"></i> Net Profit</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td><i class="fa fa-arrow-circle-up" style="font-size:23px;color:green;"></i> Expenses</td>
                                        <td></td>
                                    </tr>
                                     -->
                                    <tr>
                                        <th scope="row">Customer</th>
                                        <td><i class="fa fa-arrow-circle-up" style="font-size:23px;color:green;"></i> Frequent Reliable Departures</td>
                                        <td><i class="fa fa-arrow-circle-up" style="font-size:23px;color:green;"></i> Average No. Of Daily Departures Per Route</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Comparable to Other Travel</td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Customer Experince Survey</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Very Low Ticket Prices</td>
                                        <td><i class="fa fa-arrow-circle-down" style="font-size:23px;color:red;"></i> Ticket Prices Differential</td>
                                        <td></td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Internal Processes</th>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Fast Ground Turn Around</td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Time At Gate</td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Create New Employee Traning</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Airport Traffic</td>
                                    </tr>
                                    <tr>
                                        <th ></th>
                                        <td><i class="fa fa-arrow-circle-up" style="font-size:23px;color:green;"></i> Good Locations</td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> % of population served within 25 miles</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th ></th>
                                        <td><i class="fa fa-arrow-circle-down" style="font-size:23px;color:red;"></i> Direct Routes</td>
                                        <td><i class="fa fa-arrow-circle-down" style="font-size:23px;color:red;"></i> % of tickets with direct routes</td>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Airport Traffic</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            
            
            </div>
        </div>

    </main>
@stop