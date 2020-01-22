@extends('Admin/layouts/master')
@section('page_title', __('Add new driver'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('driver.create')}}" class="form-material">
    <div class="row">
    	<div class="col-md-9">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Add new driver')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <input type="text" name="first_Name" id="first_Name" class="form-control" required="" value="{{Request::old('first_Name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('First Name')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" name="last_Name" id="last_Name" class="form-control" required="" value="{{Request::old('last_Name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Last Name')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" name="car_Color" id="car_Color" class="form-control" required="" value="{{Request::old('car_Color')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Color')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" name="car_Model" id="car_Model" class="form-control" required="" value="{{Request::old('car_Model')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Model')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" name="car_Number" id="car_Number" class="form-control" required="" value="{{Request::old('car_Number')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Car Number')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="password" name="password" id="password" class="form-control" required="">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Password')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" name="phone" id="phone" class="form-control" required="" value="{{Request::old('phone')}}">
                        <span class="form-bar"></span>
                        <label class="float-label">{{__('Phone')}}</label>
                    </div>
                    <div class="form-group form-primary">
                        <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
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
