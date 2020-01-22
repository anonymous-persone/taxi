@extends('Admin/layouts/master')
@section('page_title', 'Rider')
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
@section('page_body')
<div class="row">
    <div class="col-md-12">
        <div class="card table-card latest-activity-card">
            <div class="card-header">
                <h5>Rider details</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <img id="userPic" src="{{$image}}" alt="{{$firstname}}" class="img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <div class="form-group form-primary">
                            <label class="float-label"><strong>First name : </strong></label>
                            <label>{{$firstname}}</label>
                            <span class="form-bar"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-primary">
                                    <label class="float-label"><strong>Last name : </strong></label>
                                    <label>{{$lastname}}</label>
                                    <span class="form-bar"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-primary">
                                    <label class="float-label"><strong>Phone : </strong></label>
                                    <label>{{$phone}}</label>
                                    <span class="form-bar"></span>
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
                <h5>Trips History</h5>
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
@endsection
