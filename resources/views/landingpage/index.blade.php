@extends('landingpage/layouts/default')
@section('title')
	Streamer Studio
@stop
@section('content')
	<section id="home-area" data-scroll-index="1">
		<div class="container">
			<div class="row">
				<!--start caption-->
				<div class="col-lg-6 col-md-8">
					<div class="caption">

						<h4>{!! getLabels('see_whats_next') !!}</h4>
						<h1>{!! getLabels('watch_Football_other_Live_Sports') !!}</h1>
						<h5>{!! getLabels('stream_the_top_sportsnetworks_and_live_games') !!}</h5>
						<div class="caption-btn">
							<a class="bg" href="javascript:void(0);">{!! getLabels('start_your_free_trial') !!}</a><a href="javascript:void(0);">{!! getLabels('read_more') !!}</a>
						</div>
					</div>
				</div>
				<!--end caption-->
				<!--start video button-->
				<div class="col-lg-6 col-md-4">
					<div class="video-ply-btn">
						<a class="popup-video mfp-iframe" href="https://www.youtube.com/watch?v=mHhrZxLWOHc"><i class="icofont-ui-play"></i></a>
					</div>
				</div>
				<!--end video button-->
			</div>
			<div class="core-features row">
				<!--start core feature single-->
				<div class="col-lg-3 col-md-4">
					<div class="core-feat-single text-center">
						<div class="icon">
							<?php $aa = pageImage('icon-folder');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<h6>{!! getLabels('no_commitments_cancel_online_at_anytime') !!}</h6>
					</div>
				</div>
				<!--end core feature single-->
				<!--start core feature single-->
				<div class="col-lg-3 col-md-4">
					<div class="core-feat-single text-center">
						<div class="icon">
							<?php $aa = pageImage('icon-responsive');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<h6>{!! getLabels('Watch_anywhere_on_your_own_time') !!}</h6>
					</div>
				</div>
				<!--end core feature single-->
				<!--start core feature single-->
				<div class="col-lg-3 col-md-4">
					<div class="core-feat-single text-center">
						<div class="icon">
							<?php $aa = pageImage('icon-token');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<h6>{!! getLabels('Pick_your_price_watch_everything') !!}</h6>
					</div>
				</div>
				<!--end core feature single-->
			</div>
		</div>
		<div class="home-img">
		<?php $aa = pageImage('home-img');?>
		{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
		</div>
	</section>
	<!--end home area-->
	<!--start streaming platform-->
	<section id="strm-flatfrm" data-scroll-index="2">
		<div class="container">
			<div class="row">
				<div class="offset-md-6 col-md-6">
					<div class="strm-cont">
						<h4>{!! getLabels('Top_networks_for_sports') !!}</h4>
						<h2>{!! getLabels('Your_Live_Sports_Streaming_Platform') !!}</h2>
						<h5>{!! getLabels('catch_live_and_on_demand_channels') !!}</h5>
					</div>
					<div class="flatfrm-list">
						<ul>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('1-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('2-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('3-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('4-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('5-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('6-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
							<li><a href="javascript:void(0);"><?php $aa = pageImage('7-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}<br></a></li>
						</ul>
						<h5><a href="javascript:void(0);">{!! getLabels('view_channels_in_your_area') !!} <i class="icofont-long-arrow-right"></i></a></h5>
					</div>
				</div>
			</div>
		</div>
		<div class="strm-flatfrm-img">
			{!! HTML::image("public/upload/page_images/". pageImage('flatform-img'), "", array("class"=>"img-fluid")) !!}
		</div>
	</section>
	<!--end streaming platform-->
	<!--start counter area-->
	<section id="counter-area">
		<div class="container">
			<div class="row">
				<!--start section heading-->
				<div class="col-md-8 offset-md-2">
					<div class="sec-heading text-center">
						<h4>{!! getLabels('Some_Fact') !!}</h4>
						<h2 class="counter-title">{!! getLabels('Continuous_in_Number') !!}</h2>
						<h5>{!! getLabels('take_entertainment_with_you') !!}</h5>
					</div>
				</div>
				<!--end section heading-->
			</div>
			<div class="row justify-content-center">
				<!--start counter single-->
				<div class="col-md-4 col-8">
					<div class="counter-single text-center">
						<div class="icon">
							<div class="icon-inner">
								<?php $aa = pageImage('icon-user');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
						</div>
						<h2>80,500</h2>
						<p>{!! getLabels('TOTAL_MEMBERS') !!}</p>
					</div>
				</div>
				<!--end counter single-->
				<!--start counter single-->
				<div class="col-md-4 col-8">
					<div class="counter-single text-center">
						<div class="icon">
							<div class="icon-inner">
								<?php $aa = pageImage('icon-glass');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
						</div>
						<h2>50,199</h2>
						<p>{!! getLabels('VISITORS_ONLINE') !!}</p>
					</div>
				</div>
				<!--end counter single-->
				<!--start counter single-->
				<div class="col-md-4 col-8">
					<div class="counter-single text-center">
						<div class="icon">
							<div class="icon-inner">
							<?php $aa = pageImage('icon-user-single');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
						</div>
						<h2>80,510</h2>
						<p>{!! getLabels('TOTAL_ACCOUNTS') !!}</p>
					</div>
				</div>
				<!--end counter single-->
			</div>
		</div>
	</section>
			<div class="platform-area">
				<div class="container">
					<div class="row">
						<!--start section heading-->
						<div class="col-md-8 offset-md-2">
							<div class="sec-heading text-center">
								<h4>{!! getLabels('Explore_Amazing_Features') !!}</h4>
								<h2 class="counter-title">{!! getLabels('Seamless_Sports_Streaming_Platform') !!}</h2>
								<h5>{!! getLabels('build_sports_streaming_platform') !!}</h5>
							</div>
						</div>
						<!--end section heading-->
					</div>
				</div>
			</div>
			<div class="platform-section">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="platform-slider-area">
								<div class="platform-slider">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<div class="platform-item">
												<?php $aa = pageImage('instant-setup');?>
												{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
												<h5 class="title">{!! getLabels('Instant_Setup') !!}</h5>
												<p>{!! getLabels('pick_your_favorite_teams') !!}</p>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="platform-item">
												<?php $aa = pageImage('hd-quality');?>
												{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
												<h5 class="title">{!! getLabels('HD_Quality') !!}</h5>
												<p>{!! getLabels('pick_your_favorite_teams') !!}</p>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="platform-item">
												<?php $aa = pageImage('thousand-channel');?>
												{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!} 
												<h5 class="title">{!! getLabels('Thousand_Channels') !!}</h5>
												<p>{!! getLabels('pick_your_favorite_teams') !!}</p>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="platform-item">
												<?php $aa = pageImage('multi-devices');?>
												{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!} 
												<h5 class="title">{!! getLabels('Multi_Devices') !!}</h5>
												<p>{!! getLabels('pick_your_favorite_teams') !!}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<!--end counter area-->
	<!--start feature area-->
	<section id="feat-area">
		<div class="container">
			<div class="row">
				<!--start section heading-->
				<div class="col-md-8 offset-md-2">
					<div class="sec-heading feat text-center">
						<h4>{!! getLabels('An_Exhaustive_list_of') !!}</h4>
						<h2>{!! getLabels('Amazing_Features') !!}</h2>
						<h5>{!! getLabels('watch_the_game_live') !!}</h5>
					</div>
				</div>
				<!--end section heading-->
			</div>
		</div>
		<!--start feature single-->
		<div class="feat-single">
			<!-- <div class="feat-bg">
				<img src="assets/images/shape-2.png" class="img-fluid" alt="">
			</div> -->
			<div class="container-fluid">
				<div class="row mb-30-none">
					<div class="col-md-6 mb-30">
						<div class="feat-cont left">
							<h5>{!! getLabels('OUR_BEST_STREAMING_EXPERIENCE') !!}</h5>
							<h3>{!! getLabels('Get_a_fan_experience_like_no_others') !!}</h3>
							<p>{!! getLabels('pick_your_favorite_teams') !!}</p>
							<a href="javascript:void(0);" class="cmn-btn">{!! getLabels('watch_now') !!}</a>
						</div>
					</div>
					<div class="col-lg-5 offset-lg-1 col-md-6 mb-30">
						<div class="feat-img feat-img--style right">
							<?php $aa = pageImage('home_amazing_feature_image');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end feature single-->
		<!--start feature single-->
		<div class="feat-single">
		<div class="container-fluid">
				<div class="row mb-30-none">
					<div class="col-lg-5 col-md-6 mb-30">
						<div class="feat-img left">
							<div class="feat-element-one">
								<?php $aa = pageImage('Play');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<div class="feat-element-two">
							<?php $aa = pageImage('Phone2');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<div class="feat-element-three">
								<?php $aa = pageImage('Star');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<div class="feat-element-four">
								<?php $aa = pageImage('like');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<?php $aa = pageImage('feature');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
					</div>
					<div class="col-md-6 offset-lg-1 mb-30">
						<div class="feat-cont right">
							<h5>{!! getLabels('LIVE_SPORTS_ON_ANY_SCREEN') !!}</h5>
							<h3>{!! getLabels('Worldwide_channels_in_your_hand') !!}</h3>
							<p>{!! getLabels('keep_up_with_live_sports') !!}</p>
							<a href="javascript:void(0);" class="cmn-btn">{!! getLabels('try_it_now') !!}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end feature single-->
		<!--start feature single-->
		<div class="feat-single">
			<div class="container-fluid">
				<div class="row mb-30-none">
					<div class="col-md-6 mb-30">
						<div class="feat-cont left">
							<h5>{!! getLabels('PUSH_NOTIFICATIONS') !!}</h5>
							<h3>{!! getLabels('Find_out_when_its_game_time') !!}</h3>
							<p>{!! getLabels('get_mobile_push_notifications') !!}</p>
							<a href="javascript:void(0);" class="cmn-btn">{!! getLabels('try_it_now') !!}</a>
						</div>
					</div>
					<div class="col-lg-5 offset-lg-1 col-md-6 mb-30">
						<div class="feat-img right">
							<div class="feat-element-five">
								<?php $aa = pageImage('bell');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<?php $aa = pageImage('feature-3');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end feature single-->
		<!--start feature single-->
		<div class="feat-single">
			<div class="container-fluid">
				<div class="row mb-30-none">
					<div class="col-md-5 mb-30">
						<div class="feat-img left record">
							<div class="feat-element-six">
								<?php $aa = pageImage('record');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<div class="feat-element-seven">
								<?php $aa = pageImage('Man');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<?php $aa = pageImage('feature-4');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							<!-- <div class="rec-icon">
								<i class="icofont-disc"></i><span>RECORD</span>
							</div> -->
						</div>
					</div>
					<div class="col-md-6 offset-md-1 mb-30">
						<div class="feat-cont right">
							<h5>{!! getLabels('RECORD_&_WATCH') !!}</h5>
							<h3>{!! getLabels('Watch_everything_on_your_own_time') !!}</h3>
							<p>{!! getLabels('record_the_sports') !!}</p>
							<a href="javascript:void(0);" class="cmn-btn">{!! getLabels('try_it_now') !!}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end feature single-->
	</section>
	<!--end feature area-->
	<!--start pricing area-->
	<section id="pricing-area" data-scroll-index="3">
		<div class="pricing-top">
			<div class="container">
				<div class="row">
					<!--start section heading-->
					<div class="col-lg-7 col-md-8">
						<div class="sec-heading">
							<h4>{!! getLabels('Meet_Your_New_TV_Experience') !!}</h4>
							<h2 class="text-white">{!! getLabels('ALL_YOUR_TV_IN_ONE_PLACE') !!}</h2>
							<h5 class="text-light">{!! getLabels('get_full_access_to_the_entire_livesports') !!}</h5>
						</div>
					</div>
					<!--end section heading-->
				</div>
			</div>
		</div>
		<div class="pricing-btm">
			<div class="container">
				<div class="row">
					<!--start pricing table single-->
					<div class="col-md-4">
						<div class="pricing-tbl-single text-center">
							<h4>STANDARD</h4>
							<div class="price-amount">
								<h2><sup>$ </sup>16 <sub>/ m</sub></h2>
							</div>
							<div class="price-details">
								<ul>
									<li>Top 70+ Live US Channels</li>
									<li>1 Simultaneous Stream</li>
									<li>7 Day Replay</li>
									<li>50 Hours DVR</li>
									<li>8 Premium Channels</li>
									<li>Showtime & Showtime Extreme</li>
								</ul>
							</div>
							<div class="price-btn">
								<a href="javascript:void(0);">Start Your Free Trial</a>
							</div>
						</div>
					</div>
					<!--end pricing table single-->
					<!--start pricing table single-->
					<div class="col-md-4">
						<div class="pricing-tbl-single recom text-center">
							<div class="ribbon">Most Popular</div>
							<h4>BEST VALUE</h4>
							<div class="price-amount">
								<h2><sup>$ </sup>32 <sub>/ m</sub></h2>
							</div>
							<div class="price-details">
								<ul>
									<li>Top 70+ Live US Channels</li>
									<li>1 Simultaneous Stream</li>
									<li>7 Day Replay</li>
									<li>50 Hours DVR</li>
									<li>8 Premium Channels</li>
									<li>Showtime & Showtime Extreme</li>
								</ul>
							</div>
							<div class="price-btn">
								<a href="javascript:void(0);">Start Your Free Trial</a>
							</div>
						</div>
					</div>
					<!--end pricing table single-->
					<!--start pricing table single-->
					<div class="col-md-4">
						<div class="pricing-tbl-single text-center">
							<h4>PREMIUM</h4>
							<div class="price-amount">
								<h2><sup>$ </sup>64 <sub>/ m</sub></h2>
							</div>
							<div class="price-details">
								<ul>
									<li>Top 70+ Live US Channels</li>
									<li>1 Simultaneous Stream</li>
									<li>7 Day Replay</li>
									<li>50 Hours DVR</li>
									<li>8 Premium Channels</li>
									<li>Showtime & Showtime Extreme</li>
								</ul>
							</div>
							<div class="price-btn">
								<a href="javascript:void(0);">Start Your Free Trial</a>
							</div>
						</div>
					</div>
					<!--end pricing table single-->
				</div>
			</div>
		</div>
		<!--start addon-->
		<!-- <div class="addons text-center">
			<h4>AVAILABLE ADD-ONS</h4>
			<ul>
				<li>Enhanced Cloud DVR</li>
				<li>Unlimited Screens</li>
				<li>Entertainment Add-on</li>
				<li>HBO<sup>R</sup></li>
				<li>CINEMAX<sup>R</sup></li>
				<li>SHOWTIME<sup>R</sup></li>
			</ul>
		</div> -->
		<!--end addon-->
		<div class="add-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="add-section-header">
							<h4>AVAILABLE ADD-ONS</h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="add-slider-area">
							<div class="add-slider">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="add-item">
											<h5 class="title">Enhanced Cloud DVR</h5>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="add-item">
											<h5 class="title">Unlimited Screens</h5>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="add-item">
											<h5 class="title">Entertainment Add</h5>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="add-item">
											<h5 class="title">HBO<sup>R</sup></h5>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="add-item">
											<h5 class="title">CINEMAX<sup>R</sup></h5>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="add-item">
											<h5 class="title">SHOWTIME<sup>R</sup></h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end pricing area-->
	<!--start download area-->
	<section id="download-area">
		<div class="container">
			<div class="download-cont-area">
				<div class="row">
					<div class="col-md-6">
						<div class="download-thumb">
							<div class="download-element">
								<?php $aa = pageImage('phone');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
							</div>
							<?php $aa = pageImage('download');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="down-cont">
							<h5>{!! getLabels('ANYTIME_ANYWHERE') !!}</h5>
							<h3>{!! getLabels('Stream_you_ hear_ out') !!}</h3>
							<p>{!! getLabels('get_the_entertainment_you') !!}</p>
							<div class="down-btn">
								<a href="javascript:void(0);"><span class="icon"><i class="fab fa-google-play"></i></span> <span class="cont"><small>GET IT ON</small><br>Appstore</span></a>
								<a class="apple" href="javascript:void(0);"><span class="icon"><i class="fab fa-apple"></i></span> <span class="cont"><small>GET IT ON</small><br>Appstore</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end download area-->
	<!--start sport schedule area-->
	<section id="sport-schdul-area" data-scroll-index="4">
		<div class="container">
			<div class="row">
				<!--start section heading-->
				<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
					<div class="sec-heading text-center">
						<h4>{!! getLabels('Take_a_look_on') !!}</h4>
						<h2>{!! getLabels('Latest_Sports_schedule') !!}</h2>
						<h5>{!! getLabels('view_the_schedule_below') !!}</h5>
					</div>
				</div>
				<!--end section heading-->
			</div>
			<div class="row">
				<!--start schedule search form-->
				<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
					<div class="schedule-search">
						<div class="row">
							<div class="col-md-6">
								<div class="search-left row">
									<div class="col-md-3 col-4">
										<div class="month">
											<p>Month:</p>
										</div>
									</div>
									<div class="col-md-6 col-8 p-0">
										<div class="selc-month">
											<select class="form-control">
											<option>January</option>
											<option>February</option>
											<option>March</option>
											<option>April</option>
										</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="search-right row">
									<div class="col-md-4 col-4 offset-md-2">
										<div class="sort-by">
											<p>Sort by :</p>
										</div>
									</div>
									<div class="col-md-6 col-8">
										<div class="selc-sports">
											<span><i class="fa fa-angle-down"></i></span>
											<select class="form-control">
											<option>All Sports</option>
											<option>Popularity</option>
											<option>Most View</option>
											<option>Best Rated</option>
										</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end schedule search form-->
				<!--start schedule date-->
				<div class="col-lg-12">
					<div class="calendr-carousel owl-carousel">
						<div class="calendr-item text-center">
							<h3>15</h3>
							<p>Today</p>
						</div>
						<div class="calendr-item text-center">
							<h3>16</h3>
							<p>WED</p>
						</div>
						<div class="calendr-item text-center">
							<h3>17</h3>
							<p>THU</p>
						</div>
						<div class="calendr-item text-center">
							<h3>18</h3>
							<p>FRI</p>
						</div>
						<div class="calendr-item text-center">
							<h3>19</h3>
							<p>SAT</p>
						</div>
						<div class="calendr-item text-center">
							<h3>20</h3>
							<p>SUN</p>
						</div>
						<div class="calendr-item text-center">
							<h3>21</h3>
							<p>MON</p>
						</div>
						<div class="calendr-item text-center">
							<h3>22</h3>
							<p>TUE</p>
						</div>
						<div class="calendr-item text-center">
							<h3>23</h3>
							<p>WED</p>
						</div>
						<div class="calendr-item text-center">
							<h3>24</h3>
							<p>THU</p>
						</div>
						<div class="calendr-item text-center">
							<h3>25</h3>
							<p>FRI</p>
						</div>
					</div>
				</div>
				<!--end schedule date-->
			</div>
			<div class="row">
				<!--start channel single-->
				<div class="col-lg-4 col-md-6">
					<div class="chanl-single">
						<?php $aa = pageImage('chanl-img-1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						<div class="chanl-cont-area">
							<div class="chanl-cont">
								<h5 class="m-0"><a href="javascript:void(0);">{!! getLabels('BEIN_SPORTS_EN_ESPANOL') !!}</a></h5>
								<p>{!! getLabels('beIN_SPORTS | Live now') !!}</p>
							</div>
							<div class="chanl-single-logo">
								<a href="javascript:void(0);"><?php $aa = pageImage('1-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}</a>
							</div>
						</div>
					</div>
				</div>
				<!--end channel single-->
				<!--start channel single-->
				<div class="col-lg-4 col-md-6">
					<div class="chanl-single">
						<?php $aa = pageImage('chanl-img-1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						<div class="chanl-cont">
							<h5 class="m-0"><a href="javascript:void(0);">{!! getLabels('BEIN_SPORTS') !!}</a></h5>
							<p>{!! getLabels('beIN_SPORTS_| Live now') !!}</p>
						</div>
						<div class="chanl-single-logo">
							<a href="javascript:void(0);"><?php $aa = pageImage('2-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}</a>
						</div>
					</div>
				</div>
				<!--end channel single-->
				<!--start channel single-->
				<div class="col-lg-4 col-md-6">
					<div class="chanl-single">
						<?php $aa = pageImage('chanl-img-1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						<div class="chanl-cont">
							<h5 class="m-0"><a href="javascript:void(0);">{!! getLabels('NFL_NETWORK') !!}</a></h5>
							<p>{!! getLabels('Football_|_Live now') !!}</p>
						</div>
						<div class="chanl-single-logo">
							<a href="javascript:void(0);"><?php $aa = pageImage('3-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}</a>
						</div>
					</div>
				</div>
				<!--end channel single-->
				<!--start channel single-->
				<div class="col-lg-4 col-md-6">
					<div class="chanl-single">
						<?php $aa = pageImage('chanl-img-1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						<div class="chanl-cont">
							<h5 class="m-0"><a href="javascript:void(0);">{!! getLabels('MLB_NETWORK') !!}</a></h5>
							<p>{!! getLabels('MLB_Network | Live now') !!}</p>
						</div>
						<div class="chanl-single-logo">
							<a href="javascript:void(0);"><?php $aa = pageImage('4-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}</a>
						</div>
					</div>
				</div>
				<!--end channel single-->
				<!--start channel single-->
				<div class="col-lg-4 col-md-6">
					<div class="chanl-single">
						<?php $aa = pageImage('chanl-img-1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						<div class="chanl-cont">
							<h5 class="m-0"><a href="javascript:void(0);">{!! getLabels('REAL_SOCIEDAD V ESPANYOL') !!}</a></h5>
							<p>{!! getLabels('Soccer_|_Watch live at 2:00') !!}</p>
						</div>
						<div class="chanl-single-logo">
							<a href="javascript:void(0);"><?php $aa = pageImage('5-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}</a>
						</div>
					</div>
				</div>
				<!--end channel single-->
				<!--start channel single-->
				<div class="col-lg-4 col-md-6">
					<div class="chanl-single">
						<?php $aa = pageImage('chanl-img-1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						<div class="chanl-cont">
							<h5 class="m-0"><a href="javascript:void(0);">{!! getLabels('MASTERS- DAY_3') !!}</a></h5>
							<p>{!! getLabels('Snooker_|_Watch live at 19:00') !!}</p>
						</div>
						<div class="chanl-single-logo">
							<a href="javascript:void(0);"><?php $aa = pageImage('6-img');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}</a>
						</div>
					</div>
				</div>
				<!--end channel single-->
			</div>
		</div>
	</section>
	<!--end sport schedule area-->
	<!--start faq area-->
	<section id="faq-area" data-scroll-index="5">
		<div class="container">
			<div class="row">
				<!--start section heading-->
				<div class="col-md-8 offset-md-2">
					<div class="sec-heading text-center">
						<h4>{!! getLabels('Got_any_Questions?') !!}</h4>
						<h2>{!! getLabels('We’ve_got_answers!') !!}</h2>
						<h5>{!! getLabels('were_here_to_help') !!}</h5>
					</div>
				</div>
				<!--end section heading-->
			</div>
			<div class="row">
				<!--start faq accordian-->
				<div class="col-lg-10 offset-lg-1">
					<div id="accordion" role="tablist"><?php
						$faqs  = getFAQs(); 
						$i=1; ?>
						<!--start faq single-->
						
						@foreach($faqs as $faq)
							
							<div class="card">
								<div class="card-header" role="tab" id="faq{!! $i !!}">
									<a data-toggle="collapse" href="#collapse{!! $i !!}" aria-expanded="true" aria-controls="collapse{!! $i !!}">{!! $faq['question'] !!}</a>
								</div>
								<div id="collapse{!! $i !!}" class="collapse" role="tabpanel" aria-labelledby="faq{!! $i !!}" data-parent="#accordion">
									<div class="card-body">{!! $faq['answer'] !!}</div>
								</div>
							</div><?php
							$i++; ?>
						@endforeach
					</div>
				</div>
				<!--end faq accordian-->
			</div>
		</div>
	</section>
	<!--end faq area-->


	<section class="testimonial-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
					<div class="sec-heading text-center">
						<h4>{!! getLabels('TESTIMONIALS1') !!}</h4>
						<h2>5000+ Happy Customers</h2>
						<h5>View the schedule below to find out about the live sport you can see on Reloj in the next two weeks</h5>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="client-item-area">
						<div class="client-element-one">
							<?php $aa = pageImage('asset_1');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<div class="client-element-two">
							<?php $aa = pageImage('asset_4');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<div class="client-element-three">
							<?php $aa = pageImage('Asset_5');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<div class="client-icon-one">
							<?php $aa = pageImage('Asset_2');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<div class="client-icon-two">
							<?php $aa = pageImage('Asset_3');?>
							{!! HTML::image("public/upload/page_images/".$aa, "", array("class"=>"img-fluid")) !!}
						</div>
						<div class="client-slider">
							<div class="swiper-wrapper"><?php
								$testimonialsIndex  = testimonials(); ?>
								@foreach($testimonialsIndex as $testimonialIndex)
									<div class="swiper-slide">
										<div class="client-item">
											<div class="client-thumb">
												{!! showImage($testimonialIndex->image, "img-fluid", "","", $testimonialIndex->name, 'testimonials') !!}
											</div>
											<h5 class="title">{!! $testimonialIndex->name !!}</h5>
											<span class="sub-title">{!! $testimonialIndex->designation !!}</span>
											<p>{!! $testimonialIndex->content !!}</p>
										</div>
									</div>
								@endforeach
							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop