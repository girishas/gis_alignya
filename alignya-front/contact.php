<?php 
 $show = false;
include 'header.php';
	use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['submit'])){
	
	require 'Phpmailer/Phpmailer/vendor/autoload.php'; 
	$mail = new PHPMailer();                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'support@alignya.com';                     // SMTP username
    $mail->Password   = 'Loz95153';                               // SMTP password
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('support@alignya.com', 'Contact Alignya');
    $mail->addAddress('kunal@alignya.com', 'kunal');     // Add a recipient
    $mail->addReplyTo('kunal@alignya.com', 'kunal');
   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Contact Us';
    $mail->Body    = '<div style= "width:100%"><div style ="width:100%;"><h2 style="text-align:center">Alignya</h2></div><div style="width:100%;"><div style="margin:30px"><label style="font-weight:600">Hi, </label><br/>Someone want to contact you via alignya platform. Here are the information!<br/><br/><label style="font-weight:600">Name : </label>'.$_POST['name'].'<br/><br/><label style="font-weight:600">Email : </label>'.$_POST['email'].'<br/><br/><label style="font-weight:600">Subject : </label>'.$_POST['subject'].'<br/><br/><label style="font-weight:600">Message : </label>'.$_POST['message'].'<br/><br/><br/><b>Thanks<br/><br/>Alignya</b></div></div></div>';
    $mail->AltBody = 'Someone want to contact you via alignya platform. Here are the information:- Email:'.$_POST['email'].',Subject:'.$_POST['subject'].',Name:'.$_POST['name'].',Message:'.$_POST['message'];
    $mail->send();
	$show = true;
}
?><!DOCTYPE html><html lang="en"><div class="contact-form-area pd-top-112">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center w-100">
                    <h2 class="title">Send you <span>inquiry</span></h2>
                    <p>Got a Question? We love to hear from you. Please send us your message and we will respond as soon as possible.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5">
                <img src="assets/img/others/21.png" alt="blog">
            </div>
            <div class="col-lg-7 offset-xl-1">
			<?php if($show){ ?>
				<p style="color:green">Thank you for getting in touch!</p>
			<?php } ?>
                <form class="riyaqas-form-wrap mt-5 mt-lg-0" action ="" method ="post">
                    <div class="row custom-gutters-16">
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <input type="text" name="name" class="single-input" required>
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <input type="text" name = "email" class="single-input" required>
                                <label>E-mail</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-wrap">
                                <input type="text" name="subject" class="single-input" required>
                                <label>Subject</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-wrap">
                                <textarea class="single-input textarea" name = "message" cols="20" required></textarea>
                                <label class="single-input-label">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-red mt-0" href="#">Send</button>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- map area start -->
<!--<div class="map-area pd-top-120">
    <div class="container">
        <div class="map-area-wrap">
            <div class="row no-gutters">
                <div class="col-lg-8">
                   
				   
				   
				   
				   
                </div>  
                <div class="col-lg-4 desktop-center-item">
                    <div>
                        <div class="contact-info">
                            <h4 class="title">Contact info:</h4>
                            
                            <p><span>E-mail:</span> hello@etailz.com</p>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>-->
<!-- map area End -->

<!-- footer area start -->
<footer class="footer-area footer-area-2 style-two mg-top-120"> 
 
    <div class="copyright-inner">
        <div class="copyright-text">
            &copy; Alignya 2020 All rights reserved
        </div>
    </div>
</footer>
<!-- footer area end -->

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->

    <!-- jquery -->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <!-- popper -->
    <script src="assets/js/popper.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <!-- wow -->
    <script src="assets/js/wow.min.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- cssslider slider -->
    <script src="assets/js/jquery.cssslider.min.js"></script>
    <!-- waypoint -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- counterup -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- imageloaded -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- world map -->
    <script src="assets/js/worldmap-libs.js"></script>
    <script src="assets/js/worldmap-topojson.js"></script>
    <!-- google map js -->
    <script src="assets/js/goolg-map-activate.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVyNXoXHkqAwBKJaouZWhHPCP5vg7N0HQ&callback=initMap"></script>
    <script src="assets/js/mediaelement.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>
</body>
</html>
