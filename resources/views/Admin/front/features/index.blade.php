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
                        <h6>{{__('Edit Feature')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" action="{{route('feature.update')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Title')}}</label>
                                <input type="text" id="title" name="title" class="form-control" required>
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
                @if ($user->able(16))
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new feature')}}</button>       
                @endif         
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('Title')}}</th>
                            <th id="lname">{{__('Description')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($features as $key => $feature)
                                <tr>
                                    
                                    <td>{{$feature->title}}</td>
                                    <td>{{str_limit($feature->description,20)}}</td>
                                    <td>
                                        @if ($user->able(18))
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$feature->id}}" class="alert-confirm delete"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                        @endif
                                        @if ($user->able(17))
                                        <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$feature->id}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
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
            document.location.href = "{{route('features.add')}}";
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
                url: "{{route('features.feature')}}",
                type: "get",
                data: {key:key},
                success:function(resp){
                    console.log(resp.image);
                    $("#title").val(resp.title);
                    $("#description").val(resp.description);
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
                url: "{{route('feature.delete')}}",
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