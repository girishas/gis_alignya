<?php 
include 'db.php';
$record_per_page = 5;
$page = '';
if(isset($_POST['page'])){
	$page = $_POST['page'];
}else{
	$page = 1;
}
?>