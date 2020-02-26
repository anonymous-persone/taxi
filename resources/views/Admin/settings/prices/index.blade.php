@extends('Admin/layouts/master')
@section('page_title', __('System Prices'))

@section('page_body')
<form id="pageForm" method="post" action="{{@route('prices.update')}}" class="form-material" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('System Prices')}}</h5>
                </div>
                <div class="card-block" id="card-block">
                    <div class="form-group form-primary">
                        <label>{{__('Commission Percentage')}}</label>
                        <input type="number" step=".05" autocomplete="off" name="commissionPercentage" id="commissionPercentage" class="form-control" required="" value="{{$prices->commissionPercentage}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Initial Trip Cost')}}</label>
                        <input type="number" step=".05" autocomplete="off" name="initialTripCost" id="initialTripCost" class="form-control" required="" value="{{$prices->initialTripCost}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Trip Per Meter Cost')}}</label>
                        <input type="number" step=".05" autocomplete="off" name="tripPerMeterCost" id="tripPerMeterCost" class="form-control" required="" value="{{$prices->tripPerMeterCost}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Trip Per Second Cost')}}</label>
                        <input type="number" step=".05" autocomplete="off" name="tripPerSecondCost" id="tripPerSecondCost" class="form-control" required="" value="{{$prices->tripPerSecondCost}}">
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('Add Cost')}}</label>
                        <input type="number" step="1" autocomplete="off" name="addCost" id="addCost" class="form-control" required="" value="{{$prices->addCost}}">
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
