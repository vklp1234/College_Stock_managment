<?php
  include ("config.php");
  session_start();
  if(isset($_SESSION['userid'])){
  	$user = $_SESSION['userid'];
  	 $qry2 = "update tbl_loggedin_hist set logged_in_date=now() where userid ='$user'";
   $execute = mysqli_query($con,$qry2);
   session_destroy();
header('Location: index.php');
    
  }

?>