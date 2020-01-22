@extends('Admin/layouts/master')
@section('page_title', __('Add New agent'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('agent.create')}}" class="form-material">
    <div class="row">
    	<div class="col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Add New Agent')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="name" id="name" class="form-control" required="" value="{{Request::old('name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Name')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="email" id="email" class="form-control" required="" value="{{Request::old('email')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Email')}}</label>
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

                    <div class="form-group form-primary">
                        <input type="password" autocomplete="off" name="password" id="password" class="form-control" required="" value="{{Request::old('car_Color')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Password')}}</label>
                    </div>
                    @csrf
                    <div class="form-group form-primary">
                        <button type="submit" id="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
                </div>

                </div>
            </div>

        </div>

    {{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card table-card">--}}
{{--                <div class="card-header">--}}
{{--                    <h5>{{__('Permissions')}}</h5>--}}
{{--                </div>--}}
{{--                <div class="card-block col-md-12" id="card-block">--}}
{{--                    <h5>{{__('Drivers Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_drivers">{{__('View Drivers')}}</label>--}}
{{--                            <input type="checkbox" name="view_drivers" id="view_drivers" value="1">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="add_driver">{{__('Add Driver')}}</label>--}}
{{--                            <input type="checkbox" name="add_driver" id="add_driver" value="2">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="edit_driver">{{__('Edit Driver')}}</label>--}}
{{--                            <input type="checkbox" name="edit_driver" id="edit_driver" value="3">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="delete_driver">{{__('Delete Driver')}}</label>--}}
{{--                            <input type="checkbox" name="delete_driver" id="delete_driver" value="4">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <h5>{{__('Riders Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_riders">{{__('View Riders')}}</label>--}}
{{--                            <input type="checkbox" name="view_riders" id="view_riders" value="5">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="add_rider">{{__('Add Rider')}}</label>--}}
{{--                            <input type="checkbox" name="add_rider" id="add_rider" value="6">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="edit_rider">{{__('Edit Rider')}}</label>--}}
{{--                            <input type="checkbox" name="edit_rider" id="edit_rider" value="7">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="delete_rider">{{__('Delete Rider')}}</label>--}}
{{--                            <input type="checkbox" name="delete_rider" id="delete_rider" value="8">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <h5>{{__('Settings Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_settings">{{__('View Settings')}}</label>--}}
{{--                            <input type="checkbox" name="view_settings" id="view_settings" value="9">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="edit_settings">{{__('Edit Settings')}}</label>--}}
{{--                            <input type="checkbox" name="edit_settings" id="edit_settings" value="10">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <h5>{{__('Team Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_team">{{__('View Team')}}</label>--}}
{{--                            <input type="checkbox" name="view_team" id="view_team" value="11">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="add_member">{{__('Add Member')}}</label>--}}
{{--                            <input type="checkbox" name="add_member" id="add_member" value="12">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="edit_member">{{__('Edit Member')}}</label>--}}
{{--                            <input type="checkbox" name="edit_member" id="edit_member" value="13">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="delete_member">{{__('Delete Member')}}</label>--}}
{{--                            <input type="checkbox" name="delete_member" id="delete_member" value="14">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <h5>{{__('Features Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_features">{{__('View Feature')}}</label>--}}
{{--                            <input type="checkbox" name="view_features" id="view_features" value="15">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="add_feature">{{__('Add Feature')}}</label>--}}
{{--                            <input type="checkbox" name="add_feature" id="add_feature" value="16">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="edit_feature">{{__('Edit Feature')}}</label>--}}
{{--                            <input type="checkbox" name="edit_feature" id="edit_feature" value="17">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="delete_feature">{{__('Delete Feature')}}</label>--}}
{{--                            <input type="checkbox" name="delete_feature" id="delete_feature" value="18">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <h5>{{__('Screens Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_screen">{{__('View Screens')}}</label>--}}
{{--                            <input type="checkbox" name="view_screen" id="view_screen" value="19">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="add_screen">{{__('Add Screen')}}</label>--}}
{{--                            <input type="checkbox" name="add_screen" id="add_screen" value="20">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="delete_screen">{{__('Delete Screen')}}</label>--}}
{{--                            <input type="checkbox" name="delete_screen" id="delete_screen" value="21">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <h5>{{__('Admins Operations')}}</h5>--}}
{{--                    <br>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="view_admin">{{__('View Admins')}}</label>--}}
{{--                            <input type="checkbox" name="view_admin" id="view_admin" value="22">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;">--}}
{{--                            <label for="add_admin">{{__('Add Admin')}}</label>--}}
{{--                            <input type="checkbox" name="add_admin" id="add_admin" value="23">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="edit_admin">{{__('Edit Admin')}}</label>--}}
{{--                            <input type="checkbox" name="edit_admin" id="edit_admin" value="24">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3" style="display: inline-block;float: right;">--}}
{{--                            <label for="delete_admin">{{__('Delete Admin')}}</label>--}}
{{--                            <input type="checkbox" name="delete_admin" id="delete_admin" value="25">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-primary">--}}
{{--                        <button type="submit" id="submit" class="btn btn-success">{{__('Submit')}}</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
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
                $("#up_here").attr('src',"https://firebasestorage.googleapis.com/v0/b/qwegoo-bb78c.appspot.com/o/drivers%2F"+fileName+"?alt=media&token=ac482b17-ffec-4f70-8414-50aaa7fd629e");
	})
</script>
@endsection
