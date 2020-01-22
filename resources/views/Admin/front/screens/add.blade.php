@extends('Admin/layouts/master')
@section('page_title', __('Add new screen'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('screens.create')}}" class="form-material" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-9">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Add new screen')}}</h5>
                </div>
                <div class="card-block" id="card-block" id="add-in">
                    <div class="form-group form-primary">
                        <label>{{__('Image')}}</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group form-primary">
                        <button type="submit" id="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
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
