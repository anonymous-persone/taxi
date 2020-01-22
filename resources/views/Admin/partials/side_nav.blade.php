<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar">
	<div class="pcoded-inner-navbar main-menu">
		<div class="">
			<div class="main-menu-header">
				<img class="img-menu-user img-radius" src="{{ @url('/storage/') }}" alt="">
				<div class="user-details">
					<p id="more-details"></p>
				</div>
			</div>
		</div>
		<div class="pcoded-navigation-label">{{__('Navigation')}}</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="pcoded-hasmenu @if('drivers' == request()->segment(2)) active pcoded-trigger @endif">
				<a href="javascript:void(0)" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="feather icon-truck"></i></span>
					<span class="pcoded-mtext">{{__('Drivers')}}</span>
				</a>
				<ul class="pcoded-submenu">
					@if($user->able(1))
					<li @if('drivers' == request()->segment(3)) class="active" @endif>
						<a href="{{route('drivers')}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{__('All Drivers')}}</span>
						</a>
					</li>
					@endif
					@if($user->able(2))
					<li @if('add' == request()->segment(3)) class="active" @endif>
						<a href="{{route('drivers.new')}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{__('Add Driver')}}</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
			<li class="pcoded-hasmenu @if('drivers' == request()->segment(2)) active pcoded-trigger @endif">
				<a href="javascript:void(0)" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="feather icon-users"></i></span>
					<span class="pcoded-mtext">{{__('Riders')}}</span>
				</a>
				<ul class="pcoded-submenu">
					@if($user->able(8))
					<li @if('riders' == request()->segment(3)) class="active" @endif>
						<a href="{{route('riders')}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{__('All Riders')}}</span>
						</a>
					</li>
					@endif
					@if($user->able(7))
					<li @if('add' == request()->segment(3)) class="active" @endif>
						<a href="{{route('rider.new')}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{__('Add Rider')}}</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
            <li class="@if('trips' == request()->segment(2)) active pcoded-trigger @endif">
                <a href="{{route('trips')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-loader"></i></span>
                    <span class="pcoded-mtext">{{__('All Trips')}}</span>
                </a>
            </li>
            @if(!$user->is_agent)
			<li class="pcoded-hasmenu @if('admins' == request()->segment(1)) active pcoded-trigger @endif">
				<a href="javascript:void(0)" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="feather icon-truck"></i></span>
					<span class="pcoded-mtext">{{__('Admins')}}</span>
				</a>
				<ul class="pcoded-submenu">
					@if($user->able(22))
					<li @if('admins' == request()->segment(1)) class="active" @endif>
						<a href="{{route('admins')}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{__('All Admins')}}</span>
						</a>
					</li>
					@endif
					@if($user->able(23))
					<li @if('new' == request()->segment(2)) class="active" @endif>
						<a href="{{route('admins.new')}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{__('Add Admin')}}</span>
						</a>
					</li>
					@endif
				</ul>
			</li>
            <li class="pcoded-hasmenu @if('agents' == request()->segment(1)) active pcoded-trigger @endif">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-airplay"></i></span>
                        <span class="pcoded-mtext">{{__('Agents')}}</span>
                    </a>
                    <ul class="pcoded-submenu">
                        {{--                    @if($user->able(22))--}}
                        <li @if('agents' == request()->segment(1)) class="active" @endif>
                            <a href="{{route('agents')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{__('All Agents')}}</span>
                            </a>
                        </li>
                        {{--                    @endif--}}
                        {{--                    @if($user->able(23))--}}
                        <li @if('new' == request()->segment(2)) class="active" @endif>
                            <a href="{{route('agents.new')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{__('Add Agent')}}</span>
                            </a>
                        </li>
                        {{--                    @endif--}}
                    </ul>
            </li>
            <li class="pcoded-hasmenu @if('drivers' == request()->segment(2)) active pcoded-trigger @endif">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">{{__('Front-End Management')}}</span>
                </a>
                <ul class="pcoded-submenu">
                    @if($user->able(9))
                        <li @if('settings' == request()->segment(1)) class="active" @endif>
                            <a href="{{route('settings')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{__('Site Settings')}}</span>
                            </a>
                        </li>
                    @endif
                    @if($user->able(11))
                        <li @if('team' == request()->segment(1)) class="active" @endif>
                            <a href="{{route('team')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{__('Team Members')}}</span>
                            </a>
                        </li>
                    @endif
                    @if($user->able(15))
                        <li @if('features' == request()->segment(1)) class="active" @endif>
                            <a href="{{route('features')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{__('Features')}}</span>
                            </a>
                        </li>
                    @endif
                    @if($user->able(19))
                        <li @if('screens' == request()->segment(1)) class="active" @endif>
                            <a href="{{route('screens')}}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{__('Screens')}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="@if('log' == request()->segment(2)) active pcoded-trigger @endif">
                <a href="{{route('log')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-loader"></i></span>
                    <span class="pcoded-mtext">{{__('Agents Log')}}</span>
                </a>
            </li>
            @endif

		</ul>
	</div>
</nav>
<!-- [ navigation menu ] end -->
