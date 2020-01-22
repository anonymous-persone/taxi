@extends('Admin/layouts/master')
@section('page_title', __('Add New Driver'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('driver.create')}}" class="form-material">
    <div class="row">
    	<div class="col-md-9">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Add New Driver')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="first_Name" id="first_Name" class="form-control" required="" value="{{Request::old('first_Name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('First Name')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="last_Name" id="last_Name" class="form-control" required="" value="{{Request::old('last_Name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Last Name')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="file" autocomplete="off" name="image" id="image" class="form-control">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Driver Image')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="car_Color" id="car_Color" class="form-control" required="" value="{{Request::old('car_Color')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Color')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="car_Model" id="car_Model" class="form-control" required="" value="{{Request::old('car_Model')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Model')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="car_Number" id="car_Number" class="form-control" required="" value="{{Request::old('car_Number')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Number')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <select class="form-control" name="car_type" id="car_type">
                            <option value="TokTok">Toktok</option>
                            <option value="Malaki">Malaki</option>
                            <option value="SevenPassengers">Seven Passengers</option>
                        </select>
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Type')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="password" autocomplete="off" name="password" id="password" class="form-control" required="">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Password')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" required="" value="{{Request::old('phone')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Phone')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="rate" id="rate" class="form-control" required="" value="{{Request::old('rate')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Rate')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <select class="form-control" name="city">
                            @foreach($cities as $key => $city)
                                <optgroup label="{{$key}}">{{$key}}</optgroup>
                                @foreach($city as $k => $c)
                                    <option value="{{$c}}">{{$c}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('City')}}</label>
                    </div>
                    <input type="hidden" name="driver_image" id="dr_image"></input>
                    <div class="form-group form-primary">
                        <button type="submit" id="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Uploaded image')}}</h5>
                </div>
                <div class="card-block" id="card-block" style="height:300px;">
                    <img width="100%" height="250px" id="up_here">
                </div>
            </div>
        </div>
    </div>
    @csrf
</form>

@endsection
@section('css_files')
<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/nestable.css') }}">
<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/component.css') }}">
<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/switchery.min.css') }}">
@endsection
@section('js_files')
<script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyDpkXJ7MsU6emR-KPyGRQi6NT_WEFrW53M",
      authDomain: "qwegoo-bb78c.firebaseapp.com",
      databaseURL: "https://qwegoo-bb78c.firebaseio.com/",
      storageBucket: "qwegoo-bb78c.appspot.com",
    };
    firebase.initializeApp(config);
  </script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" src="{{ @asset('/assets/admin/js/modalEffects.js') }}"></script>
<script type="text/javascript" src="{{ @asset('/assets/admin/js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ @asset('/assets/admin/js/switchery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-small').each(function() {
            new Switchery(this, { color: '#4099ff', jackColor: '#fff', size: 'small' });
        });
        $("#add-new").click(function(){
            $("#to_be_cloned").clone(true).removeAttr('id').appendTo('#add-in').fadeIn();
            $("[data-toggle='tooltip']").tooltip('update');
        });
        $('body').on('click', '.answer-remove-btn', function(e){
            e.preventDefault();
            $(this).closest('.material-group').remove();
        });
    });
</script>
<script type="text/javascript">
	$("#image").on('change', function(event){
		var file = event.target.files[0];
		var fileName = file.name;
		var storage = firebase.storage();
		var storageRef = storage.ref('drivers/'+fileName);
		var upload = storageRef.put(file);
		var pathReference = storage.refFromURL('gs://bucket/drivers/'+fileName);
		$("#dr_image").val("https://firebasestorage.googleapis.com/v0/b/qwegoo-bb78c.appspot.com/o/drivers%2F"+fileName+"?alt=media&token=ac482b17-ffec-4f70-8414-50aaa7fd629e");
        setTimeout(
            function(){
                $("#up_here").attr('src',"https://firebasestorage.googleapis.com/v0/b/qwegoo-bb78c.appspot.com/o/drivers%2F"+fileName+"?alt=media&token=ac482b17-ffec-4f70-8414-50aaa7fd629e");
            }, 5000
        )
	})
</script>
@endsection
