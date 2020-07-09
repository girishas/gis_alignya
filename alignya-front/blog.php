<!DOCTYPE html>
<html lang="en">
<?php include 'header.php';
include 'db.php';

$sql = "SELECT * FROM al_blogs ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!-- breadcrumb area start -->
<div class="breadcrumb-area" style="background-image:url(assets/img/page-title-bg.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">Blog</h1>
                    <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->

<div class="blog-page-area pd-top-120">
    <div class="container">
        <div class="row custom-gutters-60">
            <div class="col-lg-8">
                <div class="row">
					<?php if ($result->num_rows > 0) {
						  while($row = $result->fetch_assoc()) {
							
					?>
                    <div class="col-lg-6">
                        <div class="single-blog-content style-two">
                            <div class="thumb" style="min-height: 337px; max-height: 337px;">
								<?php
								if(!empty($row['image'])){ ?>
									
                                <img src="<?=API_URL."images/".$row['image']?>" alt="blog" style="max-height: 337px;">
								<?php }else{ ?>
                                <img src="assets/img/blog/blog-grid/1.png" alt="blog">
									
								<?php } ?>
                            </div>
                            <div class="single-blog-details">
                                <ul class="post-meta">
                                    <li class="admin">Admin</li>
                                    <li><?=date('F d, Y', strtotime($row['created_at']))?> </li>
                                     </ul>
                                <h5><a href="blog-details.php?b=<?=base64_encode($row['id'])?>"><?=$row['title']?></a></h5>
                                <p><?=strlen($row['description'])>100?html_entity_decode(substr($row['description'],0,100))."...":html_entity_decode($row['description'])?></p>
                                <a href="blog-details.php?b=<?=base64_encode($row['id'])?>">Read More <span><i class="la la-long-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                   
						<?php }
						}
						?>
                    
                    <div class="col-12">
                        <div class="riyaqas-pagination mg-top-45">
                            <ul>
							<?php 
		$sql = "SELECT * FROM al_blogs ORDER BY id DESC";
		$all_data = $conn->query($sql);							
		$count = $result->num_rows;   
        $total_records = $count;   
          
        // Number of pages required. 
        $total_pages = ceil($total_records / LIMIT);   
        $pagLink = "";                         
        for ($i=1; $i<=$total_pages; $i++) { 
          if ($i==$pn) { 
              $pagLink .= "<li class='active'><a href='index.php?page="
                                                .$i."'>".$i."</a></li>"; 
          }             
          else  { 
              $pagLink .= "<li><a href='index.php?page=".$i."'> 
                                                ".$i."</a></li>";   
          } 
        };   
        echo $pagLink;   
      ?> 
                                <li><a class="prev page-numbers" href="#"><i class="ti-angle-left"></i></a></li>
                                <li><span class="page-numbers">1</span></li>
                                <li><span class="page-numbers current">2</span></li>
                                <li><a class="page-numbers" href="#">3</a></li>
                                <li><a class="page-numbers" href="#">4</a></li>
                                <li><a class="next page-numbers" href="#"><i class="ti-angle-right"></i></a></li>
                            </ul>                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar-area">
                   
                    <div class="widget widget-recent-post">
                        <h2 class="widget-title">Recent Post</h2>
                        <ul>
						<?php 
						$result1 = $conn->query($sql);
						if ($result1->num_rows > 0) {
							$i = 0;
							$row1 = $result1->fetch_assoc();
							
								  while($row1 = $result1->fetch_assoc() ) {
								if($i<5){
							?>
                            <li>
                                <div class="media">
								<?php if(!empty($row1['image'])){ ?>
									
                                <img src="<?=API_URL."images/".$row1['image']?>" alt="widget">
								<?php }else{ ?>
                                    <img src="assets/img/blog/4.png" alt="widget">
									
								<?php } ?>
                                    <div class="media-body">
                                        <h6 class="title"><a href="blog-details.php?b=<?=base64_encode($row1['id'])?>"><?=$row1['title']?></a></h6>
                                        <span class="post-date"><?=date('F d, Y',strtotime($row1['created_at']))?></span>
                                    </div>
                                </div>
                            </li>
                            	  <?php 
								  $i++;
								}
									}
						}?>
                        </ul>
                    </div>
                   
                </aside>
            </div>
        </div>
    </div>
</div>
<?php $conn->close();
?>

<!-- footer area start -->
<footer class="footer-area footer-area-2 style-two pd-top-120">
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
<script>
$(document).ready(function(){
	function load_data(page){
		$.ajax({
			url:'pagination.php',
			method:'POST',
			data:{page:page},
			success:function(data){

			}
		})
	}
});
</script>
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
