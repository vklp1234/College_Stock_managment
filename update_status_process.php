<?php
  include ("config.php");
  session_start();
  if(isset($_SESSION['userid'])){
    
  }else{
    header('Location: index.php');
  }
?>
<?php

if(isset($_POST['submit']))
{
	$stu=$_POST['status'];
	$id = $_POST['id'];
	$qry = "UPDATE tbl_complain set status='$stu' where cid = '$id'";
	$run = mysqli_query($con,$qry);
	
	if($run==true)
	{
		?> <script type="text/javascript">
        alert("Complained has been <?php echo $stu;?>")
        window.open('viewcomplained.php','_self');

        
      </script>


		<?php
	}

}



?>