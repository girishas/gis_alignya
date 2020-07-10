<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alignya - Strategy Execution, Alignment and Collaboration Platform</title>
    <!-- favicon -->
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">
    <!-- animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <!-- animated slider -->
    <link rel="stylesheet" href="assets/css/animated-slider.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<div class="body-overlay" id="body-overlay"></div>

<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>


<div class="search-popup" id="search-popup">
    <form action="index.html" class="search-form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>

<nav class="navbar navbar-area navbar-expand-lg nav-style-01">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper mobile-logo">
                <a href="index.php" class="logo">
                    <h4 class="sticky-logo" style="color:#01358D">Alignya</h4>
                </a>
            </div>
             <div class="nav-right-content">
            <ul>
                <li class="notification">
                     <a class="logo" href="{!!url('/login')!!}">
                   
					<p class= "sticky-logo" style="color:#01358D;text-transform:uppercase;font-weight:500">
                        Sign In
                    </p>
					</a>
                </li>
            </ul>
        </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Riyaqas_main_menu" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggle-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="Riyaqas_main_menu">
            <div class="logo-wrapper desktop-logo">
                <a href="index.php" class="logo">
                    <h4 class="sticky-logo" style="color:#01358D">Alignya</h4>
                </a>
            </div>
            <ul class="navbar-nav">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Features</a>
                    <ul class="sub-menu">
                        <li><a href="{!!url('/features-strategy-development')!!}">Strategy Development</a></li>
                        <li><a href="{!!url('/features-alignment-target-initiative')!!}">Alignment of Goals, Targets and Initiatives </a></li>
                        <li><a href="{!!url('/features-progress-tracking-and-insights')!!}">Progress Tracking and Insights</a></li>
                        <li><a href="{!!url('/features-collaboration')!!}">Collaboration Platform</a></li>
                        <li><a href="{!!url('/features-collaboration')!!}"> Strategy Execution Platform</a></li>
                        <li><a href="{!!url('/alignya-process')!!}"> The Alignya Process</a></li>
                     </ul>
                </li>
                <!--<li>
                    <a href="{!!url('/blog')!!}">Blog</a>
                </li> -->
                <li>
                    <a href="{!!url('/contact')!!}">Contact</a>
                </li>
            </ul>
        </div>
        <div class="nav-right-content">
            <ul>
                <li class="notification">
                     <a class="logo" href="{!!url('/login')!!}">
                   
					<p class= "sticky-logo" style="color:#01358D;text-transform:uppercase;font-weight:500">
                        Sign In
                    </p>
					</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')
