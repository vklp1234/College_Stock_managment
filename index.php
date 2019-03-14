<?php
session_start();
if(isset($_SESSION['userid']))
{
  header('location: dashboard');
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin login</title>

      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Product</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body style="background-color: #999;">
  <li class="text-center" style="text-decoration-style: none;">
        <h3> WELCOME TO SISTec STOCK REPAIR AND UPGRADE SERVICES</h3>
                     <img src="Dataimages/SISTec_Logo.png" class="user-image img-responsive"/>
                    </li>
<div class="fram1" >
	<div class="panel-heading "  >
		<span class="fa fa-sign-in"></span> Admin Login
	</div>
	<hr>
	
<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="Form3">
	<div style="    margin-left: 20%;" >
                                            <label>Username :</label> 
                                            <input  style="width: 75%; border: 1px solid #dddddd; border-radius: 3px;" type="text" name="username" required="required" />
                                         
                                        </div>
                                        <div style="    margin-left: 20%;" >
                                            <label>Password :</label> 
                                            <input  style="width: 75.05%; border: 1px solid #dddddd; border-radius: 3px;" type="password" name="Pass" required="required" />
                                         
                                        </div>
                                        <div style="    margin:2% 38%;">
                                        <input type="submit" class="btn btn-success" name="submit" value="Login" />
                                    </div>
</form>
</div>
</body>
</html>
<?php
include("config.php");
if(isset($_POST['submit']))
{
  $user = $_POST['username'];
  $Pass = $_POST['Pass'];
  $Qry = "SELECT * FROM `tbl_user` WHERE `userid`='$user' AND `password` = '$Pass'";

  
  if(!$run = mysqli_query($con,$Qry))
  {
    var_dump($con->error);
  }
  $row = mysqli_num_rows($run);
  if ($row<1)
  {

    ?>
    <script type="text/javascript">
      alert("Username And Password Are Not Match");
      window.open('index.php','_self');
    </script>
     <?php
 
    
  }
  else
  {
    
   $_SESSION['userid']= $user;
  
  
  
  ?>
    <script type="text/javascript">
      
      window.open('dashboard.php','_self');
    </script>
     <?php
  }

 }
?>
