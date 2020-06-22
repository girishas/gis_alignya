@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
       
  <main>
<div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Support</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                           
                            <li class="breadcrumb-item active" aria-current="page">Support</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">
             <div class="col-12 col-lg-6 mb-5">
                     <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Contact Form</h5>
                            <form class="needs-validation tooltip-label-right" novalidate>
                                <div class="form-group position-relative error-l-50">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" required>
                                    <div class="invalid-tooltip">
                                        Subject is required!
                                    </div>
                                </div>
                               
                                <div class="form-group position-relative error-l-50  mb-4">
                                    <label>Summary</label>
                                    <textarea class="form-control" rows="2" required></textarea>
                                    <div class="invalid-tooltip">
                                        Summary are required!
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mb-0">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                   
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Helpful Resources</h5>
                            <div id="accordion">

                                <div class="border">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Frequently asked questions #1
                                    </button>

                                    <div id="collapseOne" class="collapse show " data-parent="#accordion">
                                        <div class="p-4">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute,
                                            non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod.
                                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                            coffee
                                            nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                            labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice
                                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                            nesciunt
                                            you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="border">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Frequently asked questions #2
                                    </button>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="p-4">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute,
                                            non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod.
                                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                            coffee
                                            nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                            labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice
                                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                            nesciunt
                                            you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="border">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Frequently asked questions #3
                                    </button>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="p-4">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute,
                                            non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod.
                                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                            coffee
                                            nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                            labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice
                                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                            nesciunt
                                            you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@stop