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
                        <h6>{{__('Edit Agent')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" action="{{route('agent.update')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="driver_key" name="key" value="">
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Name')}}</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Email')}}</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label>{{__('Password')}}</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-primary">
                        <label>{{__('City')}}</label>
                        <select id="city" class="form-control" name="city">
                            @foreach($cities as $key => $city)
                                <optgroup label="{{$key}}">{{$key}}</optgroup>
                                @foreach($city as $k => $c)
                                    <option value="{{$c}}">{{$c}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="id" type="hidden" name="id" value="">
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
                @if ($user->able(22))
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new agent')}}</button>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('Name')}}</th>
                            <th id="lname">{{__('Email')}}</th>
                            <th id="lname">{{__('City')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($admins as $key => $admin)
                                <tr>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->city}}</td>
                                    <td>
                                        @if ($user->able(25))
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$admin->id}}" class="alert-confirm delete"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                        @endif
                                        @if ($user->able(24))
                                        <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$admin->id}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
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
<script type="text/javascript" src="{{ @url('/assets/admin/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $("#dataTable").dataTable();
    </script>
    <script type="text/javascript">
        $("#add-new").on('click', function(){
            document.location.href = "{{route('agents.new')}}";
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
                url: "admins/delete/"+key,
                data: {key:key},
                cache:false
            });
            swal("Deleted!", "", "success");
            document.location.href = "{{route('admins')}}";
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
                url: "{{route('agent.get')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){
                    $('input:checkbox').removeAttr('checked');
                    console.log(resp);
                    $("#name").val(resp.name);
                    $("#email").val(resp.email);
                    $("#city").val(resp.city);
                    $("#id").val(resp.id);
                }
            });
        });
    </script>
    <script type="text/javascript">
        @if(!empty($success))
            toastr.success("{{$success}}");
        @endif
    </script>
@endsection
