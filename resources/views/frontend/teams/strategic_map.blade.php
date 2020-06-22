@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Strategic Map</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Strategic Map</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
                <div class="card mb-4">
                </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12" style="height: 200px;" >
                                <h6><b>Financial</b></h6>
                                <br>
                                <div class="row" style="justify-content: center;">
                                @if(!empty($financial))
                                @foreach($financial as $key => $value)
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: {!!$value->bg_color!!};height: 100px;text-align: center;padding-top: 35px;"><b>{!!$value->heading!!}</b></div></div> 
                                     

                                @endforeach
                                @endif
                                </div>
                            </div>
                            <div class="col-lg-12" style="height: 200px;">
                                <h6><b>Customer</b></h6>
                                 <br>
                                <div class="row" style="justify-content: center;">
                                    @if(!empty($customer))
                                @foreach($customer as $key => $value)
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: {!!$value->bg_color!!};height: 100px;text-align: center;padding-top: 35px;"><b>{!!$value->heading!!}</b></div></div> 
                                     

                                @endforeach
                                @endif
                                            
                                </div>
                            </div>
                            <div class="col-lg-12" style="height: 200px;">
                                <h6><b>Internal Process</b></h6>
                                 <br>
                                <div class="row" style="justify-content: center;">
                                    @if(!empty($process))
                                @foreach($process as $key => $value)
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: {!!$value->bg_color!!};height: 100px;text-align: center;padding-top: 35px;"><b>{!!$value->heading!!}</b></div></div> 
                                     

                                @endforeach
                                @endif
                                    
                                </div>
                            </div>
                            <div class="col-lg-12" style="height: 200px;">
                                <h6><b>L&G</b></h6>
                                 <br>
                                <div class="row" style="justify-content: center;">
                                    @if(!$people->isEmpty())
                                @foreach($people as $key => $value)
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: {!!$value->bg_color!!};height: 100px;text-align: center;padding-top: 35px;"><b>{!!$value->heading!!}</b></div></div> 
                                     

                                @endforeach
                                @else
                                No Data Available
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
            
            </div>
        </div>

    </main>
@stop