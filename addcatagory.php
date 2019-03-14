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
    $role=$dataes['role'];
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
font-size: 16px;">WELCOME:<span style="color: skyblue;"><?php echo $fullname; ?></span><span style="color: yellow;"> Last Logged In</span> <?php echo $data['logged_in_date']; echo " "; ?><a href="logout.php" class="btn btn-danger square-btn-adjust"> Logout</a> </div>
<?php } ?>
  
        <?php


        include("navigation.php")?>
        <!-- /. NAV SIDE  -->

    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h2>Add Product Category</h2>   
                        <h5>Welcome SISTec Product Stock Web </h5>
                       
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <?php 
               if($role == 'CAdmin' or $role == 'SAdmin' or $role == 'Admin')
               {
               ?> 
               <div class="row pull-left">
                <div class="col-md-12" style="    width: 164%;">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add Product Caterory
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <form role="form" action="addcatagory.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                                       <div class="form-group">
                                            <label>Serial No :  </label> 
                                             <input class="form-control" placeholder="Enter Serial No" autofocus="autofocus"  type="text" name="S_No" required="required">
                                            
                                         
                                        </div>
                                       
                                       <div class="form-group">
                                            <label> Product Catagory : </label>
                                            <input class="form-control"  type="text" name="Pro_Cat" placeholder="Enter Product Category" required="required">
                                         
                                        </div>
                                        <input type="hidden" name="name" value=<?php echo $dataes['full_name'];?>>
                                         
                                          
                                         
                                         
                                   
                                        <input type="submit" class="btn btn-default" name="submit" value="Save" />
                                        <input type="reset" class="btn btn-primary" name="reset" value="Cancel" />

                                </form>
                                    <br />
                                     
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- End Form Elements -->
                </div>
            </div>
            <?php
}
            ?>
            
                    <div class="row pull-right" ">
                <div class="col-md-12" >
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Added Category
                        </div>
                        <div class="panel-body">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                          <th>Catagory</th>
                                            <th>Inserted By</th>
                                           
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      
                                      include("config.php");
                                     
                                         $qury = "SELECT * FROM tbl_product_category order by sno";
                                        if(!$run = mysqli_query($con,$qury))
                                        {
                                          var_dump($con->error);
                                        }
                                        else{
                                          while($dataer = mysqli_fetch_assoc($run))
                                          {
                                           
                                            ?>
                                             <tr class="odd gradeX">
                                           
                                           
                                            <td class="center"><?php echo $dataer['sno']; ?></td>
                                             <td class="center"><?php echo $dataer['category']; ?></td>
                                            <td class="center"><?php echo $dataer['inserted_by'] ?></td>
                                             
                                             
                                            

                                           </tr>
                                           <?php
                                       
                                              


                                           
                                          }
                                        }
                                        ?>
                                      
                                    </tbody>
                                    
                                </table>

                            </div>
                        </div>
                    </div>
                    
                     <!-- End Form Elements -->
                </div>
            </div>
           
                <!-- /. ROW  -->
                
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
<?php

include("config.php");

if(isset($_POST['submit']))
{
  $names = $_POST['name'];
  $cat = $_POST['Pro_Cat'];
  $Serial = $_POST['S_No'];
 
  $qry = "INSERT INTO `tbl_product_category`(`sno`, `category`, `inserted_by`) VALUES ('$Serial',upper('$cat'),'$names')";
  
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
        alert("Category Added Successful");
        window.open('addcatagory.php','_self');
      </script>

      <?php
    }
    else{
      ?>
      <script type="text/javascript">
        alert("Category Not Added");
        
      </script>

      <?php
    }

  }

}



?>