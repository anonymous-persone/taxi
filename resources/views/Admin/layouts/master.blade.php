<!DOCTYPE html>
<html lang="en">

<head>
	<title>{{ config('app.name') }} | @yield('page_title')</title>
	<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="@yield('meta_description')" />
	<meta name="keywords" content="@yield('meta_keywords')">
	<meta name="author" content="@yield('meta_author')" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Favicon icon -->
	<link rel="icon" href="{{ @asset('/assets/admin/images/favicon.ico') }}" type="image/x-icon">
	<!-- Google font-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<!-- Required Fremwork -->
	<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/bootstrap.min.css') }}">
	<!-- waves.css -->
	<link rel="stylesheet" href="{{ @asset('/assets/admin/css/waves.min.css') }}" type="text/css" media="all">
	<!-- feather icon -->
	<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/feather.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/icon/icofont/css/icofont.css') }}">
	<!-- notify js Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/vendor/pnotify/css/pnotify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/vendor/pnotify/css/pnotify.brighttheme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/vendor/pnotify/css/pnotify.buttons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/vendor/pnotify/css/pnotify.history.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/vendor/pnotify/css/pnotify.mobile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/notify.css') }}">
	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/pages.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ @asset('/assets/admin/css/custom.css') }}">
	<link type="text/javascript" src="{{asset('assets/admin/css/toastr.min.css')}}"></link>
    <style>
       .pcoded[fream-type="theme1"][theme-layout="vertical"] .page-header{
           background-color: #FCB531;
       }
       .pcoded .pcoded-header[header-theme="theme1"]{
           background-color: #000;
       }
    </style>
    @yield('css_files')
</head>

<body >
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-bar"></div>
	</div>
	<!-- [ Pre-loader ] end -->
	@yield('modals')
	<div class="md-overlay"></div>
	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">
			@include('Admin/partials/header')

			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">
                    @include('Admin/partials/side_nav')
					<div class="pcoded-content">
                        @include('Admin/partials/breadcrumbs')

						<div class="pcoded-inner-content">
							<div class="main-body">
								<div class="page-wrapper">
									<div class="page-body">
										<!-- [ page content ] start -->
										@yield('page_body')
										<!-- [ page content ] end -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Warning Section Starts -->
	<!-- Older IE warning message -->
	<!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
        </p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="{{ @asset('/assets/admin/images/browser/chrome.png') }}" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="{{ @asset('/assets/admin/images/browser/firefox.png') }}" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="{{ @asset('/assets/admin/images/browser/opera.png') }}" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="{{ @asset('/assets/admin/images/browser/safari.png') }}" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="{{ @asset('/assets/admin/images/browser/ie.png') }}" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->
	<!-- Warning Section Ends -->
	<!-- Required Jquery -->
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/bootstrap.min.js') }}"></script>
	<!-- waves js -->
	<script src="{{ @asset('/assets/admin/js/waves.min.js') }}"></script>
	<!-- jquery slimscroll js -->
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/jquery.slimscroll.js') }}"></script>
	<script src="{{ @asset('/assets/admin/js/classie.js') }}"></script>
	<script src="{{ @asset('/assets/admin/js/pcoded.min.js') }}"></script>
	<script src="{{ @asset('/assets/admin/js/vertical/vertical-layout.min.js') }}"></script>
	<!-- pnotify js -->
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.desktop.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.buttons.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.confirm.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.callbacks.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.animate.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.history.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.mobile.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/vendor/pnotify/js/pnotify.nonblock.js') }}"></script>
	<!-- Custom js -->
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/script.min.js') }}"></script>
	<script type="text/javascript" src="{{ @asset('/assets/admin/js/custom.js') }}"></script>
	<script type="text/javascript">
	@if($errors->any() || \Session::has('success'))
		(function($) {
			$(document).ready(function() {
				@if($errors->any())
				errorNotify('{{$errors->first()}}');
				@elseif(\Session::has('success'))
				successNotify('{{ \Session::get('success') }}');
				@endif
			});
		})(jQuery);
	@endif
		function errorNotify(message) {
			new PNotify({
				text: message,
				icon: 'icofont icofont-info-circle',
				addclass: "stack-bottom-right bg-danger",
				type: 'error',
				stack: {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25}
			});
		}
		function successNotify(message) {
			new PNotify({
				text: message,
				icon: 'icofont icofont-check-circled',
				addclass: "stack-bottom-right bg-success",
				type: 'success',
				stack: {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25}
			});
		}
	</script>
	<script type="text/javascript" src="{{asset('assets/admin/js/toastr.min.js')}}"></script>
	@yield('js_files')
</body>

</html>
