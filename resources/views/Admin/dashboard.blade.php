@extends('Admin/layouts/master')
@section('page_title', 'Dashboard')

@section('page_body')
<div class="row">
	<div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center m-l-0">
                    <div class="col-auto">
                        <i class="icofont icofont-users-alt-2 f-30 text-c-green"></i>
                    </div>
                    <div class="col-auto">
                        <h6 class="text-muted m-b-10">Today's trips cost</h6>
                        <h2 class="m-b-0">{{$moneyToday}} $</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center m-l-0">
                    <div class="col-auto">
                        <i class="icofont icofont-users-alt-2 f-30 text-c-yellow"></i>
                    </div>
                    <div class="col-auto">
                        <h6 class="text-muted m-b-10">This month trips cost</h6>
                        <h2 class="m-b-0"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center m-l-0">
                    <div class="col-auto">
                        <i class="icofont icofont-satellite f-30 text-c-red"></i>
                    </div>
                    <div class="col-auto">
                        <h6 class="text-muted m-b-10">This week trips cost</h6>
                        <h2 class="m-b-0"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
