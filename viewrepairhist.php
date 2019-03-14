<?php
  include ("config.php");
  session_start();
  if(isset($_SESSION['userid'])){
    
  }else{
    header('Location: index.php');
  }
?>
<?php
$runed = $_SESSION['userid'];
$Qry = "SELECT * FROM `tbl_user` WHERE `userid`='$runed'";
$runer = mysqli_query($con,$Qry);
$dataes = mysqli_fetch_assoc($runer);
    $fullname = $dataes['full_name'];
    $userid = $dataes['userid'];
    $role = $dataes['role'];
    $inst_name = $dataes['inst_name'];
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="newproduct.php">SISTec - Stock</a> 
            </div>
            <?php 
            $temp  = $_SESSION['userid'];
              $qryes = "select date_format(logged_in_date,'%d-%m-%Y  %H:%i:%s') logged_in_date from tbl_loggedin_hist where userid = '$temp'";
              $runes = mysqli_query($con , $qryes);
              if($data = mysqli_fetch_assoc($runes))
              {

             ?>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> WELCOME:<span style="color: skyblue;"><?php echo $fullname; ?> </span><span style="color: yellow;"> Last Logged In </span> <?php echo $data['logged_in_date'];?><a href="logout.php" class="btn btn-danger square-btn-adjust"> Logout</a> </div>
<?php } ?>

        <?php


        include("navigation.php")?>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h2>Repair History </h2>   
                        <h5>Welcome SISTec Product Stock Web </h5>
                       
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View All Repaired/Upgraded Product
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Product ID</th>
                                            <th>Repair Date</th>
                                           
                                            <th>Repair/Upgrade Detail</th>
                                            <th>Repair Cost</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                      <?php
                                      include("config.php");
                                     
                                           $count=0; 
                                           $qry = "SELECT * FROM tbl_repair;";

                                        if(!$run = mysqli_query($con,$qry))
                                        {
                                          var_dump($con->error);
                                        }
                                        else{
                                          while($data = mysqli_fetch_assoc($run))
                                          {
                                            $count++;
                                            ?>
                                             <tr class="odd gradeX">
                                           <th><?php echo $count;?></th>
                                           <th><?php echo $data['pid'];?></th>
                                           <th><?php echo $data['repair_date']?></th>
                                           
                                            <th><?php echo $data['repair_upgrade_detail']?></th>
                                            <th><?php echo "&#8377; "; echo $data['repair_cost'];  echo "/-"; ?></th>
                                            
                                            


                                            
                                               
                                        </tr>
                                        
                                       
                                            <?php
                                          }
                                        
                                      }
                                      ?>

                                    
                                      
                                    </tbody>
                                </table>
                                <hr>
                                  <?php
                                   $qiry = "SELECT sum(repair_cost) total_amount FROM tbl_repair;";
                                    if(!$runp = mysqli_query($con,$qiry))
                                        {
                                          var_dump($con->error);
                                        }else{
                                          if($datal = mysqli_fetch_assoc($runp))
                                          {
                                            ?>

                                              <div class="pull-right">
                                                <div>
                                                  <label style="color: #31708f;" >Total Repairing Cost</label>
                                                </div>
                                                <div>
                                                  <label style="color: #31708f;"  ><?php echo "&#8377; "; echo $datal['total_amount'];  echo "/-"; ?></label>
                                                </div>
                                              </div>

                                            <?php
                                          }
                                        }
                                  ?>

                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript">
      function validation()
      {
        var empty = document.Form3.name.value;
    var empty1 = document.Form3.pass.value;
    var empty2 = document.Form3.img.value; 
    var empty3 = document.Form3.username.value;
    
        if(empty3 == "")
          {
              alert("please enter username/email");
              return false;
            }
            else
            {
                  if(empty1 == "")
                  {
                    alert("please enter password");
                    return false;
                  }
                  else
                  {
                    if( empty2 == "")
                    {
                      alert("please choose a image");
                    return false;
                    }
                    else
                    {
                      if(empty =="")
                      {
                        alert("Please enter Your Name");
                        return false;
                      }
                      else{
                        return true;
                      }
                    }
                  }
              
            }
      }
  
    </script>
    
   
</body>
</html>


