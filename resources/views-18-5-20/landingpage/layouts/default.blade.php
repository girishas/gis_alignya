<!doctype html>
<html lang="zxx">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="keywords" content="">
			<meta name="description" content="">
			<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
			<title>@yield('title')</title>
			<?php /* <link rel="shortcut icon" type="image/png" href="{!! url('public/assets/images/favicon.png') !!}" /> */ ?>
			{!! HTML::style('public/assets/css/bootstrap.min.css') !!}
			{!! HTML::style('public/assets/css/owl.carousel.min.css') !!}
			{!! HTML::style('public/assets/css/magnific-popup.css') !!}
			{!! HTML::style('public/assets/css/fontawesome-all.min.css') !!}
			{!! HTML::style('public/assets/css/icofont.min.css') !!}
			{!! HTML::style('public/assets/css/animate.css') !!}
			{!! HTML::style('public/assets/css/swiper.min.css') !!}
			{!! HTML::style('public/assets/css/dark-version.css') !!}
			{!! HTML::style('public/assets/css/style.css') !!}
			{!! HTML::style('public/assets/css/responsive.css') !!}
			{!! HTML::script('public/assets/js/jquery-3.3.1.min.js') !!}
			<script>
				var SITE_URL_BASE = "{!! config('constants.SITE_URL') !!}";
			</script>
		</head>
		
		<body>
			
			 <div class="preloader">
				<div class="d-table">
					<div class="d-table-cell align-middle">
						<div class="spinner">
							<div class="double-bounce1"></div>
							<div class="double-bounce2"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="main-dark-verson">
			@include('landingpage/layouts/header')
			
			@yield('content')
			
			@include('landingpage/layouts/footer')
			</div>
			
			{!! HTML::script('public/assets/js/popper.min.js') !!}	
			{!! HTML::script('public/assets/js/bootstrap.min.js') !!}	
			{!! HTML::script('public/assets/js/waypoints.js') !!}	
			{!! HTML::script('public/assets/js/counterup.min.js') !!}	
			{!! HTML::script('public/assets/js/ripples-min.js') !!}	
			{!! HTML::script('public/assets/js/typed.js') !!}	
			{!! HTML::script('public/assets/js/magnific-popup.min.js') !!}	
			{!! HTML::script('public/assets/js/owl.carousel.min.js') !!}	
			{!! HTML::script('public/assets/js/scrollIt.min.js') !!}	
			{!! HTML::script('public/assets/js/contact.js') !!}	
			{!! HTML::script('public/assets/js/validator.min.js') !!}	
			{!! HTML::script('public/assets/js/wow.min.js') !!}	
			<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
			{!! HTML::script('public/assets/js/swiper.min.js') !!}	
			{!! HTML::script('public/assets/js/custom.js') !!}	
			{!! HTML::script('public/js/app.js') !!}	
		</body>
	</html>