@extends('Admin/layouts/master')
@section('page_title', __('Add New Cards'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('cards.create')}}" class="form-material" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-9">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Add New Cards')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <input type="number" autocomplete="off" name="quantity" id="quantity" class="form-control" required >
                        <label class="float-label">{{__('Quantity')}}</label>
                    </div>
                    
                    <div class="form-group form-primary">
                        <input type="number" autocomplete="off" name="value" id="value" class="form-control" required >
                        <label class="float-label">{{__('Value')}}</label>
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
<link rel="stylesheet" type="text/css" href="{{ @url('/assets/admin/css/sweetalert.css') }}">
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
<script type="text/javascript" src="{{ @url('/assets/admin/js/sweetalert.min.js') }}"></script>

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

    $('#submit').on('click', function(){
        $('#quantity').attr('value', $('#quantity').text());
        $('#value').attr('value', $('#value').text());
        if(! $('#quantity').val() || ! $('#value').val() || $('#quantity').val() == 0 || $('#value').val() == 0){
            return false;
        }

        swal({
            title: "{{__('Download starts in a few seconds')}}",
            type: "success",
            timer:4000,
        });
        $('#pageForm').submit(function(){
            $('#quantity').attr('value', $('#quantity').text());
            $('#value').attr('value', $('#value').text());
        });
    });
 </script>
@endsection
