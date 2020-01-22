@extends('Admin/layouts/master')
@section('page_title', __($title))
@section('css_files')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ @url('/assets/admin/css/sweetalert.css') }}">
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
                                            <option value="{{$driver['phone']}}">{{$driver['first_Name']}} {{$driver['last_Name']}}</option>
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
				<h5>{{__($title)}}</h5>
                <div class="clearfix"></div>
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
                                @if($user->able(3))
                                    <td>
                                    <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$c}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                    <a data-key="{{$c}}" href="https://wasalni-225100.firebaseio.com/TripsHistory/{{$c}}" data-placement="left" title="{{__('View on firebase')}}" class="edit"><i class="feather icon-eye f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                    </td>
                                @endif
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
<script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyCM2MFaxVkWiT3YE2MPInrHmmsRBAFdf6E",
      authDomain: "wasalni-225100.firebaseapp.com",
      databaseURL: "https://wasalni-225100.firebaseio.com/",
      storageBucket: "wasalni-225100.appspot.com",
    };
    firebase.initializeApp(config);
  </script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{ @url('/assets/admin/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $("#dataTable").dataTable();
    </script>
    <script type="text/javascript">
        $("#add-new").on('click', function(){
            document.location.href = "{{route('drivers.new')}}";
        })
    </script>
    <script type="text/javascript">
        $('#dataTable').on('click', '.alert-confirm', function(){
        var key=$(this).data("value");
        swal({
            title: "{{__('Are you sure')}}?",
            text: "{{__('You will not be able to recover this item')}}!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "{{__('Yes, delete it')}}!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url: "drivers/delete/"+key,
                data: {key:key},
                cache:false
            });
            swal("Deleted!", "", "success");
            document.location.href = "{{route('drivers')}}";
        });
    });
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
    <script type="text/javascript">
        @if(!empty($success))
            toastr.success("{{$success}}");
        @endif
    </script>
    <script type="text/javascript">
        $("#image").on('change', function(event){
            var file = event.target.files[0];
            var fileName = file.name;
            var storage = firebase.storage();
            var storageRef = storage.ref('drivers/'+fileName);
            var upload = storageRef.put(file);
            var pathReference = storage.refFromURL('gs://bucket/drivers/'+fileName);
            $("form").append(`<input type="hidden" name="driver_image" value="https://firebasestorage.googleapis.com/v0/b/wasalni-225100.appspot.com/o/drivers%2F`+fileName+`?alt=media&token=a1ceb69b-a1e4-45a6-84f8-910baecdd067"></input>`);
            $("#theImage").attr('src',"https://firebasestorage.googleapis.com/v0/b/wasalni-225100.appspot.com/o/drivers%2F"+fileName+"?alt=media&token=a1ceb69b-a1e4-45a6-84f8-910baecdd067")
            $("#the_image").fadeIn();
        })
    </script>
@endsection
