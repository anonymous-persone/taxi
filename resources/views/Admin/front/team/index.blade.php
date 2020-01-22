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
@section('modals')
<div class="modal fade" id="singleEmailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h6>{{__('Edit Team Member')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" action="{{route('member.update')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="driver_key" name="key" value="">
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Image')}}</label>
                                <img id="photo" src="" width="100" height="100">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
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
                                <label >{{__('Image')}}</label>
                                <input type="file" id="mem-image" name="mem-image" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Facebook URL')}}</label>
                                <input type="text" id="fb_url" name="fb_url" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Twitter URL')}}</label>
                                <input type="text" id="tw_url" name="tw_url" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Description')}}</label>
                                <textarea id="description" class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
                @if ($user->able(12))
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new team member')}}</button>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('Image')}}</th>
                            <th id="lname">{{__('Name')}}</th>
                            <th id="image">{{__('Description')}}</th>
                            <th id="phone">{{__('Facebook URL')}}</th>
                            <th id="phone">{{__('Twitter URL')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($team as $key => $member)
                                <tr>
                                    <td>@if(!empty($member->image))<img src="{{$member->image}}" width="70" height="70"> @else <img height="70" width="70" src="{{asset('assets/admin/images/default-face.jpg')}}"> @endif</td>
                                    <td>{{$member->name}}</td>
                                    <td>{{str_limit($member->description,20)}}</td>
                                    <td><a href="{{$member->fb_url}}">{{$member->fb_url}}</a></td>
                                    <td><a href="{{$member->tw_url}}">{{$member->tw_url}}</a></td>
                                    <td>
                                        @if ($user->able(13))
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$member->id}}" class="alert-confirm delete"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                        @endif
                                        @if ($user->able(14))
                                        <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$member->id}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
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
            document.location.href = "{{route('member.add')}}";
        })
    </script>
    <script type="text/javascript">
        $("#dataTable").on('click', '.edit', function(e){
            var el = $(this);
            var key = el.data('key');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('team.member')}}",
                type: "get",
                data: {key:key},
                success:function(resp){
                    console.log(resp.image);
                    $("#name").val(resp.name);
                    $("#description").val(resp.description);
                    $("#fb_url").val(resp.fb_url);
                    $("#tw_url").val(resp.tw_url);
                    $("#photo").attr('src', resp.image);
                    $("#id").val(resp.id);
                }
            });
        });
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
                url: "{{route('team.deleteTeamMember')}}",
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