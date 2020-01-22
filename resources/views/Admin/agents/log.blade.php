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
@section('page_body')
    <div class="row">
        <div class="col-md-12">
            <div class="card table-card latest-activity-card">
                <div class="card-header">
                    <div class="clearfix"></div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-borderless tablesorter">
                            <thead class="border-checkbox-section">
                            <th id="fname">{{__('Agent')}}</th>
                            <th id="lname">{{__('Action')}}</th>
                            <th id="lname">{{__('Date')}}</th>
                            </thead>
                            <tbody class="border-checkbox-section">
                            @if(sizeof($logs) > 0)
                            @foreach($logs as $key => $log)
                                <tr>
                                    <td>{{$log->agent}}</td>
                                    <td>{{$log->action}}</td>
                                    <td>{{$log->created_at}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="3" style="text-align: center">No logs for now</td>
                                </tr>
                            @endif
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
        @if(!empty($success))
        toastr.success("{{$success}}");
        @endif
    </script>
@endsection
