@extends('Admin/layouts/master')
@section('page_title', __('Add new team member'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('member.create')}}" class="form-material" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-9">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Add new team member')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <input type="text" autocomplete="off" name="name" id="name" class="form-control" required="" value="{{Request::old('name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Name')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Image')}}</label>
                        <input type="file" autocomplete="off" name="image" id="image" class="form-control" required="">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Description')}}</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Facebook URL')}}</label>
                        <input type="text" autocomplete="off" name="fb_url" id="fb_url" class="form-control">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Twitter URL')}}</label>
                        <input type="text" autocomplete="off" name="tw_url" id="tw_url" class="form-control">
                    </div>                    
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
@endsection
