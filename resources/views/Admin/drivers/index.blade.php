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
                        <h6>{{__('Edit Driver')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" action="{{route('driver.update')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="driver_key" name="key" value="">
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('First Name')}}</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Last Name')}}</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label>{{__('Password')}}</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="the_image" style="display:none">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label>{{__('Uploaded image')}}</label>
                                <img width="200" height="200" id="theImage">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label>{{__('Image')}}</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Phone')}}</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('City')}}</label>
                                <select class="form-control" name="city" id="city">
                                	@foreach($cities as $key => $city)
    	                                <optgroup label="{{$key}}">{{$key}}</optgroup>
    	                                @foreach($city as $k => $c)
    	                                    <option value="{{$c}}">{{$c}}</option>
    	                                @endforeach
    	                            @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Rate')}}</label>
                                <input type="text" name="rate" id="d_rate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Car Color')}}</label>
                                <input type="text" name="color" id="color" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Car Model')}}</label>
                                <input type="text" name="model" id="model" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Car Number')}}</label>
                                <input type="text" name="number" id="number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Car Type')}}</label>
                                <select class="form-control" name="car_type" id="car_type">
                                    <option value="TokTok">Toktok</option>
                                    <option value="Malaki">Malaki</option>
                                    <option value="SevenPassengers">Seven Passengers</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Last Payment')}}</label>
                                <input type="number" min="0" class="form-control" id="last_payment" name="last_payment">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Remaining')}}</label>
                                <input type="number" min="0" class="form-control" id="remaining" name="remaining">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Last Payment Date')}}</label>
                                <input type="date" class="form-control" id="last_payment_date" name="last_payment_date">
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
                @if ($user->able(2))
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new driver')}}</button>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('First Name')}}</th>
                            <th id="lname">{{__('Last Name')}}</th>
                            <th id="image">{{__('Image')}}</th>
                            <th id="car_number">{{__('Car Number')}}</th>
                            <th id="car_color">{{__('Car Color')}}</th>
                            <th id="car_model">{{__('Car Model')}}</th>
                            <th id="car_model">{{__('Car Type')}}</th>
                            <th id="phone">{{__('Phone')}}</th>
                            <th id="rate">{{__('Total Rate')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($drivers as $key => $driver)
                            @if(isset($driver['phone']))
                                <tr>
                                    <td>{{$driver['first_Name']}}</td>
                                    <td>{{$driver['last_Name']}}</td>
                                    @if(!empty($driver['image_url']))
                                    <td><img src="{{$driver['image_url']}}" width="70" height="70"></td>
                                    @else
                                    <td><img height="70" width="70" src="{{asset('assets/admin/images/default-face.jpg')}}"></td>
                                    @endif
                                    <td>{{$driver['car_Number']}}</td>
                                    <td>{{$driver['car_Color']}}</td>
                                    <td>{{$driver['car_Model']}}</td>
                                    <td>@if(isset($driver['carType'])) {{$driver['carType']}} @else - @endif</td>
                                    <td>{{$driver['phone']}}</td>
                                    <td>{{$driver['rates']}}</td>
                                    <td>
                                        @if($user->able(4))
                                            @if(!$user->is_agent)
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$key}}" class="alert-confirm delete"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                            @else
                                                @if(isset($driver['city']) && $user->city == $driver['city'])
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$key}}" class="alert-confirm delete"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                @endif
                                            @endif
                                        @endif
                                        @if($user->able(3))
                                            @if(!$user->is_agent)
                                                <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$key}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                            @else
                                                @if(isset($driver['city']) && $user->city == $driver['city'])
                                                    <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$key}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                                @endif
                                            @endif
                                        @endif
                                        @if($user->able(1))
                                        <a style="margin-left: -15px;" href="{{route('driver.show', $key)}}" data-toggle="tooltip" data-key="{{$key}}" data-placement="left" title="{{__('View Driver Profile')}}" class="view"><i class="feather icon-eye f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
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
                url: "{{route('driver.get')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){
                    $("#first_name").val(resp.first_Name);
                    $("#last_name").val(resp.last_Name);
                    $("#password").val(resp.password);
                    $("#phone").val(resp.phone);
                    $("#color").val(resp.car_Color);
                    $("#model").val(resp.car_Model);
                    $("#number").val(resp.car_Number);
                    $("#driver_key").val(key);
                    $("#city").val(resp.city);
                    $("#last_payment").val(resp.last_payment);
                    $("#remaining").val(resp.remaining);
                    $("#last_payment_date").val(resp.last_payment_date);
                    $("#car_type").val(resp.carType);
                    $("#d_rate").val(resp.rates);
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
