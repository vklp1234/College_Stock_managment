
<?php
  include ("config.php");
  session_start();
  if(isset($_SESSION['userid'])){
    
  }else{
    header('Location: index.php');
  }
?>
<?php

include("config.php");
$usern=$_SESSION['userid'];
if(isset($_POST['submit']))
{
  
  $Pass = $_POST['pid'];
  $Fname = $_POST['Rdate'];
  $Cno = $_POST['cost'];
  $email = $_POST['dics'];
 
  $qry = "INSERT INTO `tbl_repair`(`pid`, `repair_date`, `repair_upgrade_detail`, `repair_cost`) VALUES ('$Pass','$Fname','$email','$Cno'); ";
 
  if(!$run = mysqli_query($con,$qry))
  {
    var_dump($con->error);
  }
  else
  {
    if($run ==true)
    {
      ?>
      <script type="text/javascript">
        alert("Repair and Upgrade successful")
        window.open('searchproduct.php','_self');

        
      </script>

      <?php
    }
    else{
      ?>
      <script type="text/javascript">
        alert("User not added");
        window.open('Update.php','_self');
        
      </script>

      <?php
    }

  }

}



?>