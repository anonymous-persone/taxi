<!-- [ Header ] start -->
<nav class="navbar header-navbar pcoded-header">
	<div class="navbar-wrapper">
		<div class="navbar-logo">
			<a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
					<i class="feather icon-toggle-right"></i>
				</a>
			<a href="{{route('drivers')}}">
					<img width="70" class="img-fluid" src="{{ asset('/assets/admin/images/mylogo.png') }}" alt="{{ config('app.name') }}" />
				</a>
			<a class="mobile-options waves-effect waves-light">
					<i class="feather icon-more-horizontal"></i>
				</a>
		</div>
		<div class="navbar-container container-fluid">
			<ul class="nav-left">
				<!-- <li class="header-search">
					<div class="main-search morphsearch-search">
						<div class="input-group">
							<span class="input-group-prepend search-close">
									<i class="feather icon-x input-group-text"></i>
								</span>
							<input type="text" class="form-control" placeholder="Enter Keyword">
							<span class="input-group-append search-btn">
									<i class="feather icon-search input-group-text"></i>
								</span>
						</div>
					</div>
				</li> -->
				<li>
					<a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
							<i class="full-screen feather icon-maximize"></i>
						</a>
				</li>
			</ul>
			<ul class="nav-right">
				
				<li class="user-profile header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" data-toggle="dropdown">
							
							<span>{{auth()->user()->name}}</span>
							<i class="feather icon-chevron-down"></i>
						</div>
						<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<li>
								<a href="{{route('change-language', 'ar')}}">
										<i class="feather icon-settings"></i> العربية

									</a>
							</li>
							<li>
								<a href="{{route('change-language', 'en')}}">
										<i class="feather icon-user"></i> English

									</a>
							</li>

							<li>
								<a href="/logout">
									<i class="feather icon-log-out"></i> {{__('Logout')}}
								</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- [ Header ] end -->
