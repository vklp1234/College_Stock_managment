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
                           Add Rooms/LABs
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <form role="form" action="addrooms.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                                       <div class="form-group">
                                            <label>Room Name :  </label> 
                                             <input class="form-control" placeholder="Enter Room Name" autofocus="autofocus"  type="text" name="room_name" required="required">
                                            
                                         
                                        </div>
                                       
                                       <div class="form-group">
                                            <label>Institute Code : </label>
                                            <select  name="code" class="form-control" id="combo">
                                               <option  value="">-- Select --</option>
                                               <?php  
                                                if($role != 'SAdmin')
                                                {
                                                  $query="select * from tbl_institute where inst_name = '$inst_name' ";
                                                 }
                                                 else{
                                                  $query="select * from tbl_institute";
                                                 }
                                                      $result=mysqli_query($con,$query);
                                                      while ($row = mysqli_fetch_array($result)) 
                                                      {
                                                     echo '<option value = "' . $row['inst_name'] . '">' . 
                                                     $row['inst_name'] . '</option>';
                                                      }
                                                
                                                ?>
                                          </select>
                                         
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
                                            <th>Room Name</th>
                                          <th>Institute Code</th>
                                            <th>Inserted By</th>
                                           
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      
                                      include("config.php");
                                     $count=1;
                                         $qury = "SELECT * FROM tbl_rooms";
                                        if(!$run = mysqli_query($con,$qury))
                                        {
                                          var_dump($con->error);
                                        }
                                        else{
                                          while($dataer = mysqli_fetch_assoc($run))
                                          {
                                           
                                            ?>
                                             <tr class="odd gradeX">
                                           
                                           
                                            <td class="center"><?php echo $count++; ?></td>
                                             <td class="center"><?php echo $dataer['room_name']; ?></td>
                                             <td class="center"><?php echo $dataer['code']; ?></td>
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
  $names = $_POST['room_name'];
  $inst = $_POST['code'];
  $insert = $_POST['name'];
  $quty = "SELECT * from tbl_institute WHERE inst_name='$inst'";
  //echo " $quty";
  if(!$qr_run = mysqli_query($con,$quty))
  {
    var_dump($con->error);
  }
  $data_fetch = mysqli_fetch_assoc($qr_run);
  $institute = $data_fetch['code'];
 
  $qry = "INSERT INTO `tbl_rooms`(`room_name`, `code`, `inserted_by`) VALUES (upper('$names'),'$institute','$insert')";
 // echo "$qry";
  
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
        alert("room added Successful");
        window.open('addrooms.php','_self');
      </script>

      <?php
    }
    else{
      ?>
      <script type="text/javascript">
        alert("room Not Added");
        
      </script>

      <?php
    }

  }

}



?>