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
                        <h6>{{__('Edit Admin')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" action="{{route('admin.update')}}" method="post" enctype="multipart/form-data">
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
                    <div class="row">
        <div class="col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{__('Permissions')}}</h5>
                </div>
                <div class="card-block col-md-12" id="card-block">
                    <h5>{{__('Drivers Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_drivers">{{__('View Drivers')}}</label>
                            <input type="checkbox" name="view_drivers" id="view_drivers" value="1">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="add_driver">{{__('Add Driver')}}</label>
                            <input type="checkbox" name="add_driver" id="add_driver" value="2">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="edit_driver">{{__('Edit Driver')}}</label>
                            <input type="checkbox" name="edit_driver" id="edit_driver" value="3">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="delete_driver">{{__('Delete Driver')}}</label>
                            <input type="checkbox" name="delete_driver" id="delete_driver" value="4">
                        </div>
                    </div>
                    <br>
                    <h5>{{__('Riders Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_riders">{{__('View Riders')}}</label>
                            <input type="checkbox" name="view_riders" id="view_riders" value="8">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="add_rider">{{__('Add Rider')}}</label>
                            <input type="checkbox" name="add_rider" id="add_rider" value="7">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="edit_rider">{{__('Edit Rider')}}</label>
                            <input type="checkbox" name="edit_rider" id="edit_rider" value="5">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="delete_rider">{{__('Delete Rider')}}</label>
                            <input type="checkbox" name="delete_rider" id="delete_rider" value="6">
                        </div>
                    </div>
                    <br>
                    <h5>{{__('Settings Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_settings">{{__('View Settings')}}</label>
                            <input type="checkbox" name="view_settings" id="view_settings" value="9">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="edit_settings">{{__('Edit Settings')}}</label>
                            <input type="checkbox" name="edit_settings" id="edit_settings" value="10">
                        </div>
                    </div>
                    <br>
                    <h5>{{__('Team Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_team">{{__('View Team')}}</label>
                            <input type="checkbox" name="view_team" id="view_team" value="11">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="add_member">{{__('Add Member')}}</label>
                            <input type="checkbox" name="add_member" id="add_member" value="12">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="edit_member">{{__('Edit Member')}}</label>
                            <input type="checkbox" name="edit_member" id="edit_member" value="13">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="delete_member">{{__('Delete Member')}}</label>
                            <input type="checkbox" name="delete_member" id="delete_member" value="14">
                        </div>
                    </div>
                    <br>
                    <h5>{{__('Features Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_features">{{__('View Feature')}}</label>
                            <input type="checkbox" name="view_features" id="view_features" value="15">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="add_feature">{{__('Add Feature')}}</label>
                            <input type="checkbox" name="add_feature" id="add_feature" value="16">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="edit_feature">{{__('Edit Feature')}}</label>
                            <input type="checkbox" name="edit_feature" id="edit_feature" value="17">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="delete_feature">{{__('Delete Feature')}}</label>
                            <input type="checkbox" name="delete_feature" id="delete_feature" value="18">
                        </div>
                    </div>
                    <br>
                    <h5>{{__('Screens Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_screen">{{__('View Screens')}}</label>
                            <input type="checkbox" name="view_screen" id="view_screen" value="19">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="add_screen">{{__('Add Screen')}}</label>
                            <input type="checkbox" name="add_screen" id="add_screen" value="20">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="delete_screen">{{__('Delete Screen')}}</label>
                            <input type="checkbox" name="delete_screen" id="delete_screen" value="21">
                        </div>
                    </div>
                    <br>
                    <h5>{{__('Admins Operations')}}</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="view_admin">{{__('View Admins')}}</label>
                            <input type="checkbox" name="view_admin" id="view_admin" value="22">
                        </div>
                        <div class="col-md-3" style="display: inline-block;">
                            <label for="add_admin">{{__('Add Admin')}}</label>
                            <input type="checkbox" name="add_admin" id="add_admin" value="23">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="edit_admin">{{__('Edit Admin')}}</label>
                            <input type="checkbox" name="edit_admin" id="edit_admin" value="24">
                        </div>
                        <div class="col-md-3" style="display: inline-block;float: right;">
                            <label for="delete_admin">{{__('Delete Admin')}}</label>
                            <input type="checkbox" name="delete_admin" id="delete_admin" value="25">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new admin')}}</button>
                @endif    
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('Name')}}</th>
                            <th id="lname">{{__('Email')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($admins as $key => $admin)
                                <tr>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
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
            document.location.href = "{{route('admins.new')}}";
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
                url: "{{route('admin.get')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){
                    $('input:checkbox').removeAttr('checked');
                    console.log(resp);
                    $.each(resp.permissions, function(k,v){
                        if (v.permission_id == 1) {
                            $("#view_drivers").attr('checked', true);
                        }
                        if (v.permission_id == 2) {
                            $("#add_driver").attr('checked', true);
                        }
                        if (v.permission_id == 3) {
                            $("#edit_driver").attr('checked', true);
                        }
                        if (v.permission_id == 4) {
                            $("#delete_driver").attr('checked', true);
                        }
                        if (v.permission_id == 8) {
                            $("#view_riders").attr('checked', true);
                        }
                        if (v.permission_id == 7) {
                            $("#add_rider").attr('checked', true);
                        }
                        if (v.permission_id == 5) {
                            $("#edit_rider").attr('checked', true);
                        }
                        if (v.permission_id == 6) {
                            $("#delete_rider").attr('checked', true);
                        }
                        if (v.permission_id == 9) {
                            $("#view_settings").attr('checked', true);
                        }
                        if (v.permission_id == 10) {
                            $("#edit_settings").attr('checked', true);
                        }
                        if (v.permission_id == 11) {
                            $("#view_team").attr('checked', true);
                        }
                        if (v.permission_id == 12) {
                            $("#add_member").attr('checked', true);
                        }
                        if (v.permission_id == 13) {
                            $("#edit_member").attr('checked', true);
                        }
                        if (v.permission_id == 14) {
                            $("#delete_member").attr('checked', true);
                        }
                        if (v.permission_id == 15) {
                            $("#view_features").attr('checked', true);
                        }
                        if (v.permission_id == 16) {
                            $("#add_feature").attr('checked', true);
                        }
                        if (v.permission_id == 17) {
                            $("#edit_feature").attr('checked', true);
                        }
                        if (v.permission_id == 18) {
                            $("#delete_feature").attr('checked', true);
                        }
                        if (v.permission_id == 19) {
                            $("#view_screen").attr('checked', true);
                        }
                        if (v.permission_id == 20) {
                            $("#add_screen").attr('checked', true);
                        }
                        if (v.permission_id == 21) {
                            $("#delete_screen").attr('checked', true);
                        }
                        if (v.permission_id == 25) {
                            $("#delete_admin").attr('checked', true);
                        }
                        if (v.permission_id == 24) {
                            $("#edit_admin").attr('checked', true);
                        }
                        if (v.permission_id == 23) {
                            $("#add_admin").attr('checked', true);
                        }
                        if (v.permission_id == 22) {
                            $("#view_admin").attr('checked', true);
                        }
                    })
                    $("#name").val(resp.name);
                    $("#email").val(resp.email);
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