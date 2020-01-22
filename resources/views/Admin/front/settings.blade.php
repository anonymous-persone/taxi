@extends('Admin/layouts/master')
@section('page_title', __('System Settings'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('settings.update')}}" class="form-material" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('System Settings')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <label>{{__('Main title')}}</label>
                        <input type="text" autocomplete="off" name="main_title" id="main_title" class="form-control" required="" value="{{$settings->main_title}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Main title extend')}}</label>
                        <input type="text" autocomplete="off" name="main_title_extend" id="main_title_extend" class="form-control" required="" value="{{$settings->main_title_extend}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Cover Image')}}</label>
                        <input type="file" autocomplete="off" name="cover_image" id="cover_image" class="form-control" required="">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Main Description')}}</label>
                        <textarea name="main_description" class="form-control">{{$settings->main_description}}</textarea>
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Google play URL')}}</label>
                        <input type="text" autocomplete="off" name="google_play_url" id="google_play_url" class="form-control" required="" value="{{$settings->google_play_url}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Section Description Title')}}</label>
                        <input type="text" autocomplete="off" name="description_title" id="description_title" class="form-control" required="" value="{{$settings->description_title}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Description')}}</label>
                        <textarea class="form-control" name="description">{{$settings->description}}</textarea>
                    </div>
                </div>

                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <label>{{__('Street Address')}}</label>
                        <input type="text" autocomplete="off" name="street" id="street" class="form-control" required="" value="{{$settings->street}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Country')}}</label>
                        <input type="text" autocomplete="off" name="country" id="country" class="form-control" required="" value="{{$settings->country}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Government')}}</label>
                        <input type="text" autocomplete="off" name="gov" id="gov" class="form-control" required="" value="{{$settings->gov}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Mobile phone')}}</label>
                        <input type="text" autocomplete="off" name="mobile" id="mobile" class="form-control" required="" value="{{$settings->mobile}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Email')}}</label>
                        <input type="text" autocomplete="off" name="email" id="email" class="form-control" required="" value="{{$settings->email}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('About')}}</label>
                        <textarea class="form-control" name="about">{{$settings->about}}</textarea>
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Facebook')}}</label>
                        <input type="text" autocomplete="off" name="facebook" id="facebook" class="form-control" required="" value="{{$settings->facebook}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Linkedin')}}</label>
                        <input type="text" autocomplete="off" name="linkedin" id="linkedin" class="form-control" required="" value="{{$settings->linkedin}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Twitter')}}</label>
                        <input type="text" autocomplete="off" name="twitter" id="twitter" class="form-control" required="" value="{{$settings->twitter}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Github')}}</label>
                        <input type="text" autocomplete="off" name="github" id="github" class="form-control" required="" value="{{$settings->github}}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">{{__('Save')}}</button>
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
<script type="text/javascript">
    @if(isset($success))
        toastr.success("{{$success}}");
    @endif
</script>
@endsection
