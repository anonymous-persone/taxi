@extends('Admin/layouts/master')
@section('page_title', __($title))
@section('css_files')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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
@section('page_body')
<div class="row">
	<div class="col-md-12">
        <div class="card table-card latest-activity-card">
            <div class="card-header">
				<h5>{{$title}}</h5>
                @if ($user->able(21))
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new screenshot')}}</button>
                @endif                
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('Screen')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($screens as $key => $screen)
                                <tr>
                                    
                                    <td><img src="{{$screen->image}}" width="100" height="100"></td>
                                    <td>
                                        @if ($user->able(20))
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$screen->id}}" class="alert-confirm delete"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                        @endif
                                    </td>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $("#dataTable").dataTable();
    </script>
    <script type="text/javascript">
        $("#add-new").on('click', function(){
            document.location.href = "{{route('screens.add')}}";
        })
    </script>
    <script type="text/javascript">
        $("#dataTable").on('click', '.delete', function(e){
            e.preventDefault();
            var el = $(this);
            var key = $(this).data('value');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('screen.delete')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){
                    toastr.success(resp);
                    el.closest('tr').remove();
                }
            });
        })
    </script>
    <script type="text/javascript">
        @if(!empty($success))
            toastr.success("{{$success}}");
        @endif
    </script>
@endsection