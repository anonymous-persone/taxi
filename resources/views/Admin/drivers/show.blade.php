@extends('Admin/layouts/master')
@section('page_title', __('Driver'))
@section('css_files')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style type="text/css">
        .dataTables_filter{
            float: right;
        }
        .div.dataTables_wrapper{
            display: none;
        }
        .dataTables_length{
            width: 50%;
            display: inline-block;
        }
        .accordion {
          background-color: #4680ff;
          color: #fff;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
          transition: 0.4s;
        }

        .active, .accordion:hover {
          background-color: #90B2FF;
        }

        .accordion:after {
          content: '\002B';
          color: #fff;
          font-weight: bold;
          float: right;
          margin-left: 5px;
        }

        .active:after {
          content: "\2212";
        }

        .panel {
          padding: 0 18px;
          background-color: white;
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.2s ease-out;
        }
    </style>
@endsection
@section('modals')
    <div class="modal fade" id="singleEmailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <div class="section-title mb-10">
                            <h6>{{__('Edit Trip')}}</h6>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_user_form" action="{{route('trip.update')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="trip_key" name="key" value="">
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Date')}}</label>
                                    <input type="text" id="date" name="date" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Rider')}}</label>
                                    <select class="form-control" name="rider" id="rider">
                                        @foreach($riders as $key => $rider)
                                            <option value="{{$rider['phone']}}">{{$rider['first_Name']}} {{$rider['last_Name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label>{{__('Driver')}}</label>
                                    <select class="form-control" name="driver" id="driver">
                                        @foreach($drivers as $key => $driver)
                                        @if(isset($driver['phone']))
                                            <option value="{{$driver['phone']}}">{{$driver['first_Name']}} {{$driver['last_Name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Other Rider')}}</label>
                                    <input type="text" id="otherRiderPhone" name="otherRiderPhone" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Distance')}}</label>
                                    <input type="text" id="distance" name="distance" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Base Fare')}}</label>
                                    <input type="text" id="totalPaymentValue" name="totalPaymentValue" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Wallet Payment')}}</label>
                                    <input type="text" id="walletPaymentValue" name="walletPaymentValue" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('New Cost')}}</label>
                                    <input type="number" min="0" id="newCost" name="newCost" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Time')}}</label>
                                    <input type="text" id="time" name="time" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Payout')}}</label>
                                    <input type="text" id="estimatedPayout" name="estimatedPayout" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('From')}}</label>
                                    <input type="text" id="from" name="from" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('To')}}</label>
                                    <input type="text" id="to" name="to" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Rate')}}</label>
                                    <input type="text" id="rates" name="rates" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="section-field col-md-12">
                                <div class="form-group">
                                    <label >{{__('Rate Comment')}}</label>
                                    <input type="text" id="comments" name="comments" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="communicationID" type="hidden" name="id" value="">
                        <button type="submit" class="btn btn-primary pull-right">
                            <i class="fa fa-check"></i> {{__('Save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_body')
<div class="row">
    <div class="col-md-12">
        <div class="card table-card latest-activity-card">
            <div class="card-header">
                <h5>{{__('Driver details')}}</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <img id="userPic" src="{{$image}}" alt="{{$firstname}}" class="img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <div class="form-group form-primary">
                            <label class="float-label"><strong>{{__('First name')}} : </strong></label>
                            <label>{{$firstname}}</label>
                            <span class="form-bar"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-primary">
                                    <label class="float-label"><strong>{{__('Last name')}} : </strong></label>
                                    <label>{{$lastname}}</label>
                                    <span class="form-bar"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-primary">
                                    <label class="float-label"><strong>{{__('Phone')}} : </strong></label>
                                    <label>{{$phone}}</label>
                                    <span class="form-bar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-primary">
                            <label class="float-label"><strong>{{__('Total rate')}} : </strong></label>
                            <label>{{$rate}}</label>
                            <span class="form-bar"></span>
                        </div>
                        <div class="form-group form-primary">
                            <label class="float-label"><strong>{{__('Car Color')}} : </strong></label>
                            <label>{{$color}}</label>
                            <span class="form-bar"></span>
                        </div>
                        <div class="form-group">
                            <label><strong>{{__('Car Model')}} : </strong></label>
                            <label>{{$model}}</label>
                        </div>
                        <div class="form-group">
                            <label><strong>{{__('Car Number')}} : </strong></label>
                            <label>{{$number}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

                <nav class="float-right">
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card table-card latest-activity-card">
            <div class="card-header">
                <h5>{{__('Earnings')}}</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center m-l-0">
                                        <div class="col-auto">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__("Deserved amount since last payout")}}</h6>
                                            <h2 class="m-b-0">{{$money + ceil((($earnings['today']*15)/100))}} {{__('EGP')}}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <a style="margin-left:38%" class="btn btn-success btn-xs" href="{{route('driver.update-deserved')}}?deserved={{$money + ceil((($earnings['today']*15)/100))}}&key={{$phone}}">Save value to firebase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center m-l-0">
                                        <div class="col-auto">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__("Today's trips cost")}}</h6>
                                            <h2 class="m-b-0">{{$all = $earnings['today']}} {{__('EGP')}}</h2>
                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('System percentage')}}</h6>
                                            <h2 class="m-b-0">{{$x = round((($earnings['today']*15)/100),2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Earnings')}}</h6>
                                            <h2 class="m-b-0">{{$c = $all - $x}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Cash')}}</h6>
                                            <h2 class="m-b-0">{{$cash = round($earnings['cashToday'], 2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Outstanding balance')}}</h6>
                                            <h2 class="m-b-0">{{$earnings['outstandingToday']}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center m-l-0">
                                        <div class="col-auto">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('This month trips cost')}}</h6>
                                            <h2 class="m-b-0">{{$all = $earnings['month']}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('System percentage')}}</h6>
                                            <h2 class="m-b-0">{{$x = round((($earnings['month']*15)/100),2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Earnings')}}</h6>
                                            <h2 class="m-b-0">{{$c = $all - $x}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Cash')}}</h6>
                                            <h2 class="m-b-0">{{$cash = round($earnings['cashMonth'], 2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Outstanding balance')}}</h6>
                                            <h2 class="m-b-0">{{round($earnings['outstandingMonth'],2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center m-l-0">
                                        <div class="col-auto">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('This year trips cost')}}</h6>
                                            <h2 class="m-b-0">{{$all = $earnings['year']}} {{__('EGP')}}</h2>
                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('System percentage')}}</h6>
                                            <h2 class="m-b-0">{{$x = round((($earnings['year']*15)/100),2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Earnings')}}</h6>
                                            <h2 class="m-b-0">{{$c = $all - $x}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Cash')}}</h6>
                                            <h2 class="m-b-0">{{$cash = round($earnings['cashYear'], 2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Outstanding balance')}}</h6>
                                            <h2 class="m-b-0">{{round($earnings['outstandingYear'], 2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center m-l-0">
                                        <div class="col-auto">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('This Week trips cost')}}</h6>
                                            <h2 class="m-b-0">{{$all = $earnings['week']}} EGP</h2>
                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('System percentage')}}</h6>
                                            <h2 class="m-b-0">{{$x = round((($earnings['week']*15)/100),2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Earnings')}}</h6>
                                            <h2 class="m-b-0">{{$c = $all - $x}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Cash')}}</h6>
                                            <h2 class="m-b-0">{{$cash = round($earnings['cashWeek'],2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                    <div class="row align-items-center m-1-0">
                                        <div class="col-auto" style="margin-left:15px;">
                                            <i class="icofont icofont-users-alt-1  f-30 text-c-green"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="text-muted m-b-10">{{__('Outstanding balance')}}</h6>
                                            <h2 class="m-b-0">{{round($earnings['outstandingWeek'],2)}} {{__('EGP')}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

                <nav class="float-right">
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card table-card latest-activity-card">
            <div class="card-header">
                <h5>{{__('Trips History')}}</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                        <th id="fname">{{__('Date')}}</th>
                        <th id="fname">{{__('Rider')}}</th>
                        <th id="fname">{{__('Driver')}}</th>
                        <th id="fname">{{__('Other Rider')}}</th>
                        <th id="lname">{{__('Distance')}}</th>
                        <th id="image">{{__('Total Payment')}}</th>
                        <th id="image">{{__('Wallet Payment')}}</th>
                        <th id="image">{{__('New cost')}}</th>
                        <th id="car_number">{{__('Time')}}</th>
                        <th id="car_color">{{__('Payout')}}</th>
                        <th id="car_model">{{__('From')}}</th>
                        <th id="phone">{{__('To')}}</th>
                        <th id="rate">{{__('Rate')}}</th>
                        <th id="rate">{{__('Rate Comment')}}</th>
                        <th>{{__("Actions")}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                        @foreach($hist as $c => $history)
                            <tr>
                                <td>@if(isset($history['date'])) {{$history['date']}} @endif</td>
                                <td>@if(isset($history['rider'])) {{$history['rider']}} @endif</td>
                                <td>@if(isset($history['driver'])) {{$history['driver']}} @endif</td>
                                <td>@if(isset($history['otherRiderPhone'])) {{$history['otherRiderPhone']}} @endif</td>
                                <td>@if(isset($history['distance'])) {{$history['distance']}} @endif</td>
                                <td>@if(isset($history['totalPaymentValue'])) {{$history['totalPaymentValue']}} @endif</td>
                                <td>@if(isset($history['walletPaymentValue'])) {{$history['walletPaymentValue']}} @endif</td>
                                <td>@if(isset($history['newCost'])) {{$history['newCost']}} @endif</td>
                                <td>@if(isset($history['time'])) {{$history['time']}} @endif</td>
                                <td>@if(isset($history['estimatedPayout'])) {{$history['estimatedPayout']}} @endif</td>
                                <td>@if(isset($history['from'])) {{$history['from']}} @endif</td>
                                <td>@if(isset($history['to'])) {{$history['to']}} @endif</td>
                                <td>@if(isset($history['rates'])) {{$history['rates']}} @endif</td>
                                <td>@if(isset($history['comments'])) {{$history['comments']}} @endif</td>
                                <td>
                                    <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$history['key']}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                    <a data-key="{{$history['key']}}" href="https://wasalni-225100.firebaseio.com/TripsHistory/{{$history['key']}}" data-placement="left" title="{{__('View on firebase')}}" class="edit"><i class="feather icon-eye f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer">

                <nav class="float-right">
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_files')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $("#dataTable").dataTable();
    </script>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
</script>
    <script type="text/javascript">
        $("#dataTable").on('click', '.edit', function(e){
            var el = $(this);
            var key = el.data('key');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('trip.get')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){
                    console.log(resp);
                    $("#driver").val(resp.driver);
                    $("#rider").val(resp.rider);
                    $("#date").val(resp.date);
                    $("#otherRiderPhone").val(resp.otherRiderPhone);
                    $("#distance").val(resp.distance);
                    $("#totalPaymentValue").val(resp.totalPaymentValue);
                    $("#walletPaymentValue").val(resp.walletPaymentValue);
                    $("#newCost").val(resp.newCost);
                    $("#time").val(resp.time);
                    $("#estimatedPayout").val(resp.estimatedPayout);
                    $("#from").val(resp.from);
                    $("#to").val(resp.to);
                    $("#rates").val(resp.rates);
                    $("#comments").val(resp.comments);
                    $("#trip_key").val(key);
                }
            });
        });
    </script>
@endsection
