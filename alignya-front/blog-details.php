<!DOCTYPE html>
<html lang="en">
<?php include 'header.php';

include 'db.php';

$id = base64_decode($_GET['b']); 
$sql = "SELECT * FROM al_blogs WHERE id = ".$id;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$sql = "SELECT * FROM al_blogs WHERE id != ".$id." ORDER BY id DESC LIMIT 5";
$recent_post = $conn->query($sql);

?>

<!-- breadcrumb area start -->
<div class="breadcrumb-area" style="background-image:url(assets/img/page-title-bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?=$row['title']?></h1>
                    <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li><?=$row['title']?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->

<div class="blog-details-page pd-top-120">
    <div class="container">
        <div class="row custom-gutters-60">
            <div class="col-lg-8">
                <div class="single-blog-content">
                    <div class="thumb">
					<?php
								if(!empty($row['image']) && file_exists(FILE_EXIST_PATH.$row['image'])){ ?>
									
                                <img src="<?=API_URL."images/".$row['image']?>" alt="blog">
								<?php }else{ ?>
                                <img src="assets/img/blog/1.png" alt="blog">
									
								<?php } ?>
                        
                    </div>
                    <div class="single-blog-details">
                        <ul class="post-meta">
                            <li class="admin">Admin</li>
                            <li><?=date('F d, Y', strtotime($row['created_at']))?> </li>
                        </ul>
                        <h5><?=$row['title']?></h5>
                        <p><?=$row['description']?></p>
                       
                       
                    </div>
                </div>
                <!--<div class="comments-area">
                    <h3 class="comments-title">Comments <span>(10)</span></h3>
                    <ul class="comment-list mg-bottom-0-991">
                        <li>
                            <div class="single-comment-wrap">
                                <div class="thumb">
                                    <img src="assets/img/blog/comments/1.png" alt="comment">
                                </div>
                                <div class="content">
                                    <h4 class="title">Charles</h4>
                                    <span class="date">17 SEP 2019</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                                    <a href="#" class="reply">Reply</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="single-comment-wrap">
                                <div class="thumb">
                                    <img src="assets/img/blog/comments/2.png" alt="comment">
                                </div>
                                <div class="content">
                                    <h4 class="title">Laurie</h4>
                                    <span class="date">17 SEP 2019</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                                    <a href="#" class="reply">Reply</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="single-comment-wrap">
                                <div class="thumb">
                                    <img src="assets/img/blog/comments/3.png" alt="comment">
                                </div>
                                <div class="content">
                                    <h4 class="title">David V</h4>
                                    <span class="date">17 SEP 2019</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                                    <a href="#" class="reply">Reply</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> -->

                <!-- contact form start -->
                <!--<div class="comment-form-area mg-top-80">
                    <form class="riyaqas-form-wrap">
                        <div class="row custom-gutters-16">
                            <div class="col-md-6">
                                <div class="single-input-wrap">
                                    <input type="text" class="single-input">
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-input-wrap">
                                    <input type="text" class="single-input">
                                    <label>E-mail</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-input-wrap">
                                    <textarea class="single-input textarea" cols="20"></textarea>
                                    <label class="single-input-label">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-input-wrap input-checkbox">
                                   <input type="checkbox">
                                   <span class="input-checkbox-text">I agree that my submitted data is being <span>collected and stored</span></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-red mt-0" href="#">Leave A Comment</a>
                            </div> 
                        </div>
                    </form>
                </div>-->
            </div>
            <div class="col-lg-4">
                <aside class="sidebar-area">
                    <div class="widget widget-recent-post">
                        <h2 class="widget-title">Recent Post</h2>
                        <ul>
							<?php if($row = $recent_post->num_rows > 0){
								while($row = $recent_post->fetch_assoc() ){ ?>
                             <li>
                                <div class="media">
								<?php if(!empty($row['image']) && file_exists(FILE_EXIST_PATH.$row['image'])){ ?>
									
                                <img src="<?=API_URL."images/".$row['image']?>" alt="widget">
								<?php }else{ ?>
                                    <img src="assets/img/blog/4.png" alt="widget">
									
								<?php } ?>
                                    <div class="media-body">
                                        <h6 class="title"><a href="blog-details.php?b=<?=base64_encode($row['id'])?>"><?=$row['title']?></a></h6>
                                        <span class="post-date"><?=date('F d, Y',strtotime($row['created_at']))?></span>
                                    </div>
                                </div>
                            </li>
							<?php }}?>
                            
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<!-- footer area start -->
<footer class="footer-area footer-area-2 mg-top-120">
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
    <!-- nice-select -->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!-- world map -->
    <script src="assets/js/worldmap-libs.js"></script>
    <script src="assets/js/worldmap-topojson.js"></script>
    <script src="assets/js/mediaelement.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>
</body>
</html>
