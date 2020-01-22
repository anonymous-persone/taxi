<!-- [ breadcrumb ] start -->
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-8">
				<div class="page-header-title">
					<h4 class="m-b-10">@yield('page_title')</h4>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="{{@url('/admin/dashboard')}}">
								<i class="feather icon-home"></i>
							</a>
					</li>
					<li class="breadcrumb-item">
						<a href="">@yield('page_title')</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- [ breadcrumb ] end -->
