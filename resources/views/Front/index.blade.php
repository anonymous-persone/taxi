<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Wasalni Mobile App Landing Page | Home</title>
<link href="{{asset('assets/front/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- jQuery (Bootstrap's JavaScript plugins) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="{{asset('assets/front/css/component.css')}}" rel="stylesheet" type="text/css"  />
<!-- Custom Theme files -->
<link href="{{asset('assets/front/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/demo.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/footer-distributed-with-address-and-phones.css')}}">
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<!---- start-smoth-scrolling---->
		<script type="text/javascript" src="{{asset('assets/front/js/move-top.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/front/js/easing.js')}}"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
		</script>
<!---- start-smoth-scrolling---->
</head>
<body class="cbp-spmenu-push">
<div id="home" class="banner" style="
    background-image: http://bekyaaa.hostingerapp.com/assets/front/main.jpg;
    background: url({{$settings->cover_image}});
    background-size: cover;
    direction: rtl;
">
	 <div class="container">
		 <div class="header">
			 <div class="logo">
				 <a href="#"><img src="http://bekyaaa.hostingerapp.com/assets/admin/images/logo.png" width="90px" alt=""/></a>
			 </div>	
			 <div class="top-nav">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
					<h3>Menu</h3>
					<a class="scroll" href="#home" class="active">Home</a>
					<a class="scroll" href="#feature">Features</a>
					<a class="scroll" href="#screenshots">Screen Shots</a>
					<a class="scroll" href="#team">Team</a>
				</nav>
				<div class="main buttonset">	
						<!-- Class "cbp-spmenu-open" gets applied to menu and "cbp-spmenu-push-toleft" or "cbp-spmenu-push-toright" to the body -->
						<button id="showRightPush" style="background-color: black"><img src="{{asset('assets/front/images/menu-icon.png')}}" alt=""/></button>
						<!--<span class="menu"></span>-->
				</div>
				<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
				<script src="{{asset('assets/front/js/classie.js')}}"></script>
				<script>
				var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRightPush = document.getElementById( 'showRightPush' ),
				body = document.body;

				showRightPush.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( body, 'cbp-spmenu-push-toleft' );
					classie.toggle( menuRight, 'cbp-spmenu-open' );
					disableOther( 'showRightPush' );
				};

				function disableOther( button ) {
					if( button !== 'showRightPush' ) {
						classie.toggle( showRightPush, 'disabled' );
					}
				}
			 </script>
	     </div>
			<div class="clearfix"></div>
		 </div>
		 
		 <div class="banner-info">
			 <h1 style="color: #FCB531">{{$settings->main_title}}<span>{{$settings->main_title_extend}}</span></h1>
			 <p>{{$settings->main_description}}</p>
			 <a style="width: 150%" href="{{$settings->google_play_url}}"><img src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" width="250" height="100" alt="Get it on Google Play" border="0"></a> 
		 </div>
		 <div class="down">
		 <a class="scroll" href="#feature"><img src="{{asset('assets/front/images/scroll.png')}}" alt=""/></a>
		 </div>
	 </div>
	 
</div>
<!--features-->
<div id="feature" class="features">
	 <div class="container">
		 <div class="feature-info text-center">
		 <h3 style="color: #FCB531">APP FEATURES</h3>
		 <p>{{$settings->description}}</p>
		 </div>
		 <div class="feature-grids">
		 	@php
		 		$counter = 1;
		 	@endphp
		 	@foreach($features as $feature)
		 	
			 <div class="col-md-6 feature-sec">
				 <div class="feature-grid grid{{$counter}}">
					 <h3 style="color: #FCB531">{{$feature->title}}</h3>
					 <p>{{$feature->description}}</p>
				 </div>
				 @php
				 	$counter++;
				 @endphp
			 </div>
			 @endforeach
			 <div class="clearfix"></div>
		 </div>
	</div>
</div>
<!--landing-->
<div class="landing">
		 <h3 style="color: #FCB531">{{$settings->description_title}}</h3>
		 <div class="alnding-sec">
			 <div class="col-md-6 slades">
				 <img src="{{asset('assets/front/images/shape2.jpg')}}" alt=""/>
			 </div>
			 <div class="col-md-6 landing-info">
				 <p style="text-align: right">{{$settings->description}}.</p>
			 </div>
			 <div class="clearfix"></div>
	 </div>
</div>
<!--screenshots-->
<div id="screenshots" class="screen-shots">
	 <div class="container">
		 <h3 style="color: #FCB531">SCREEN SHOTS</h3>
		  <div class="review-slider">
			 <ul id="flexiselDemo1">
			 	@foreach($screens as $screen)
				<li><img width="233" height="394" src="{{$screen->image}}" alt=""/></li>		
				@endforeach
			 </ul>
				<script type="text/javascript">
			 $(window).load(function() {
				
			  $("#flexiselDemo1").flexisel({
					visibleItems: 4,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed: 3000,    		
					pauseOnHover: true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: { 
						portrait: { 
							changePoint:480,
							visibleItems: 2
						}, 
						landscape: { 
							changePoint:640,
							visibleItems: 3
						},
						tablet: { 
							changePoint:768,
							visibleItems: 4
						}
					}
				});
				});
			 </script>
			 <script type="text/javascript" src="{{asset('assets/front/js/jquery.flexisel.js')}}"></script>	
		  </div>
	  </div>
</div>
<!--team-->
<div id="team" class="team">
	<div class="container">
		 <h3 style="color: #FCB531">TEAM</h3>
		 <div class="team-grids">
		 	@foreach($team as $member)
			 <div class="col-md-4 team-grid text-center">
				 <img src="{{$member->image}}" width="150" height="150" alt=""/>
				 <h4>{{$member->name}}</h4>
				 <p>{{$member->description}}</p>
				 <div class="social-icons">
					 <a href="{{$member->fb_url}}"><span class="fb"></span></a>
					 <a href="{{$member->tw_url}}"><span class="tweet"></span></a>
				 </div>
			 </div>
			@endforeach
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>
<!--team-->
<div class="subscribe">
	 <div class="container">
		 <h3 style="color: #FCB531">SUBSCRIBE</h3>
		 <form>
			 <input type="text" value="Subscride" onfocus="this.value=''" onblur="this.value='Subscride'">
			 <input type="submit" value="Send" style="background-color: #FCB531;border:1px solid #FCB531">
		 </form>
	 </div>
</div>
<!--footer-->
<footer class="footer-distributed">

	<div class="footer-left" style="margin-top:50px">

		<img src="http://bekyaaa.hostingerapp.com/assets/admin/images/logo.png" width="200" height="100">
	</div>

	<div class="footer-center">

		<div>
			<i class="fa fa-map-marker"></i>
			<p><span>{{$settings->street}}</span> {{$settings->gov}}, {{$settings->country}}</p>
		</div>

		<div>
			<i class="fa fa-phone"></i>
			<p>{{$settings->mobile}}</p>
		</div>

		<div>
			<i class="fa fa-envelope"></i>
			<p><a href="mailto:support@company.com">{{$settings->email}}</a></p>
		</div>

	</div>

	<div class="footer-right">

		<p class="footer-company-about">
			<span>About the company</span>
			{{$settings->about}}
		</p>

		<div class="footer-icons">

			<a href="{{$settings->facebook}}"><i class="fa fa-facebook"></i></a>
			<a href="{{$settings->twitter}}"><i class="fa fa-twitter"></i></a>
			<a href="{{$settings->linkedin}}"><i class="fa fa-linkedin"></i></a>
			<a href="{{$settings->github}}"><i class="fa fa-github"></i></a>

		</div>

	</div>

</footer>

</body>
</html>