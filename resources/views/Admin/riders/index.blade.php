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
                        <h6>{{__('Edit Rider')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_user_form" action="{{route('rider.update')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="driver_key" name="key" value="">
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('First Name')}}</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Last Name')}}</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Gender')}}</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="ذكر">ذكر</option>
                                    <option value="أنثي">أنثي</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Governorate')}}</label>
                                <select class="form-control" name="governorate" id="governorate">
                                    @foreach($cities as $key => $city)
                                        <option value="{{$key}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Markaz')}}</label>
                                <select class="form-control" name="markaz" id="markaz">
                                    @foreach($cities as $key => $city)
                                        <optgroup label="{{$key}}">{{$key}}</optgroup>
                                        @foreach($city as $k => $c)
                                            <option value="{{$c}}">{{$c}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Phone')}}</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <label >{{__('Wallet Balance')}}</label>
                                <input type="number" min="0" name="wallet" id="wallet" class="form-control" required>
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
                @if ($user->able(7))
				<button id="add-new" class="btn btn-primary waves-effect waves-light float-right"><i class="feather icon-plus"></i> {{__('Add new rider')}}</button>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover table-borderless tablesorter">
                        <thead class="border-checkbox-section">
                            <th id="fname">{{__('First Name')}}</th>
                            <th id="lname">{{__('Last Name')}}</th>
                            <th id="image">{{__('Image')}}</th>
                            <th id="phone">{{__('Phone')}}</th>
                            <th>{{__('Actions')}}</th>
                        </thead>
                        <tbody class="border-checkbox-section">
                            @foreach($riders as $key => $driver)
                                <tr>
                                    <td>{{$driver['first_Name']}}</td>
                                    <td>{{$driver['last_Name']}}</td>
                                    @if(!empty($driver['image_url']))
                                    <td><img src="{{$driver['image_url']}}" width="70" height="70"></td>
                                    @else
                                    <td><img height="70" width="70" src="{{asset('assets/admin/images/default-face.jpg')}}"></td>
                                    @endif
                                    <td>{{$driver['phone']}}</td>
                                    <td>
                                        @if ($user->able(8))
                                        <a href="{{route('rider.show', $key)}}" data-toggle="tooltip" data-key="{{$key}}" data-placement="left" title="{{__('View Driver Profile')}}" class="view"><i class="feather icon-eye f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                            @if($user->able(3))
                                                <a data-toggle="modal" data-target="#singleEmailModal" data-key="{{$key}}" data-placement="left" title="{{__('Edit')}}" class="edit"><i class="feather icon-edit f-w-600 f-16 m-r-15 text-c-blue"></i></a>
                                            @endif
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
            document.location.href = "{{route('rider.new')}}";
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
                url: "{{route('rider.delete')}}",
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
        $("#dataTable").on('click', '.edit', function(e){
            var el = $(this);
            var key = el.data('key');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('rider.get')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){
                    console.log(key);
                    var gender = 'ذكر';
                    if(resp.gender == 'أنثي' || resp.gender == 'أنثى'){
                        gender = 'أنثي'
                    }else{
                        gender = resp.gender;
                    }
                    var markaz = '';
                    if(resp.markaz == 'بنى سويف' || resp.markaz == 'بني سويف'){
                        markaz = 'بنى سويف';
                    }else{
                        markaz = resp.markaz;
                    }
                    $("#first_name").val(resp.first_Name);
                    $("#last_name").val(resp.last_Name);
                    $("#phone").val(resp.phone);
                    $("#wallet").val(resp.walletBalance);
                    $("#markaz").val(markaz);
                    $("#governorate").val(resp.governorate);
                    $("#gender").val(gender);
                    $("#driver_key").val(key);
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
