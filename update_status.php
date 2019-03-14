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
?>
<!DOCTYPE php>
<php xmlns="http://www.w3.org/1999/xphp">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>product</title>
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
                <a class="navbar-brand" href="dashboard.php">SISTec - Stock</a>
            </div>
            <?php 
            $temp  = $_SESSION['userid'];
              $qryes = "select date_format(logged_in_date,'%d-%m-%Y  %H:%i:%s') logged_in_date from tbl_loggedin_hist where userid = '$temp'";
            
              $runes = mysqli_query($con,$qryes);

              if($data = mysqli_fetch_assoc($runes))
              {
                             ?>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> WELCOME:<span style="color: skyblue;"><?php echo $fullname; ?></span><span style="color: yellow;"> Last Logged In</span> <?php echo $data['logged_in_date']; echo " "; ?><a href="logout.php" class="btn btn-danger square-btn-adjust"> Logout</a> </div>
<?php } ?>
  
       <?php


        include("navigation.php")?>
        <!-- /. NAV SIDE  -->

    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h2> Update Product Status</h2>   
                        <h5>Welcome SISTec Stock Product Web </h5>
                       
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
             
               <div class="row pull-left">
                <div class="col-md-12" style="width: 156%">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Status Process Or Solved
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                
    
  <?php
$c_id = $_GET['cid'];

$qury = "SELECT * FROM `tbl_complain` WHERE `cid`='$c_id' ";

$run = mysqli_query($con,$qury);
if($data = mysqli_fetch_assoc($run))
  {  ?>
    

                                    <form role="form" action="update_status_process.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                                       <div class="form-group">
                                            <label>Product Status :  </label> 
                                      <select class="form-control" style="width: 180%" name="status">
                                               <option value="">----------------<span style="color: red;">Select</span>-------------</option>
                                               <option value="Process">Process</option>
                                               <option value="Solved">Solved</option>
                                             </select>
                                  
                                        </div>
                                        <input type="hidden" name="id" value=<?php echo $data['cid']?>>
                                          <?php
                                   }
                                   ?>
                                     
                                       
                                         
                                        <input type="submit" class="btn btn-success" name="submit" value="Update" />                                        
                                </form>
                                    <br />
                                     
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- End Form Elements -->
                </div>
            </div>
        
                    
                <div class="row">
                    <div class="col-md-12">
                        <h3>More Customization</h3>
                         <p>
                        For more customization for this template or its components please visit official bootstrap website i.e getbootstrap.com or <a href="http://getbootstrap.com/components/" target="_blank">click here</a> . We hope you will enjoy our template. This template is easy to use, light weight and made with love by binarycart.com 
                        </p>
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
    
   
</body>
</php>
