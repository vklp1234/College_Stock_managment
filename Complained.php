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
    $college_name = $dataes['inst_name'];
    $role = $dataes['role'];
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
font-size: 16px;"> WELCOME:<span style="color: skyblue;"><?php echo $fullname; ?></span><span style="color: yellow;"> Last Logged In </span> <?php echo $data['logged_in_date'];?><a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
<?php } ?>

        <?php


        include("navigation.php")?>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h2>Complain/Request Protal</h2>   
                        <h5>Welcome SISTec Product Stock Web </h5>
                        <div class="pull-right">
                          <label>SAdmin = <span style="color: blue;"> Sagar Group Admin/Head </span> </label> <br>
                          <label>CAdmin = <span style="color: blue;"> Principal, Vice Principal </span> </label><br>
                          <label>SAdmin = <span style="color: blue;"> College or School Admin </span> </label>
                       
                    </div>
                        
                </div>
              </div>
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           New Complain/request
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <form role="form" action="Complained.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                                        <div class="form-group">
                                            <label>TO <span style="color: red;">*</span> :</label>
                                            <select class="form-control" name = "compln_to">
                                              <option value ="Admin">Admin</option>
                                              <option value ="CAdmin">CAdmin</option>
                                              <option value ="SAdmin">SAdmin</option>
                                            </select>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Message<span style="color: red;">*</span> :</label>
                                           <textarea class="form-control" type="text" name="ms" placeholder="Write Your Complain here.........." >
                                           </textarea>
                                         
                                        </div>
										                    
                                        
                                       
                                         
                                            
                                           <input  type="hidden" name="to_name" value=<?php echo $role; ?>  />
                                           <input type="hidden" name="by_userid" value=<?php echo $userid; ?> />
                                         
                                                                               
                                         
                                        <input type="submit" class="btn btn-success" name="submit" value="Complain" />
                                        <a  href="dashboard.php" class="btn btn-primary" >Cancle</a>

                                </form>
                                    <br />
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
                <!-- /. ROW  -->
                          <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             All Complains
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Complain Id</th>
                                            <th>Massege</th>
                                            <th>Complain To</th>
                                            <th>Complain Date</th>
                                            <th>Status</th>
                                            <th>Process/Solved Date</th>
                                            <th>Levels</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      include("config.php");
                                     
                                           $count=0; 
                                        //$qury = "SELECT * FROM `tbl_complain` WHERE `complain_by`='$runed' ";
                                        $qury = "select cid, c_message, concat(complain_to, ', ',inst_name) ComplainTo, complain_date, status, resolved_date, levels from tbl_user t1, tbl_complain t2 where t1.userid = t2.complain_by and t1.userid = '$userid' ";
                                        if(!$run = mysqli_query($con,$qury))
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
                                           <th><?php echo $data['cid'];?></th>
                                           <th><?php echo $data['c_message']?></th>
                                            <th><?php echo $data['ComplainTo']?></th>
                                            <th><?php echo $data['complain_date']?></th>
                                            <th><?php echo $data['status']?></th>
                                            <th><?php echo $data['resolved_date']?></th>
                                            <th><?php echo $data['levels']?></th>
                                               
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
<?php
include("config.php");
if(isset($_POST['submit']))
{
 
  $massege = $_POST['ms'];
  $to = $_POST['compln_to'];
  $name = $_POST['by_userid'];
  
  $qry = "INSERT INTO `tbl_complain`(`c_message`, `complain_to`,`complain_by`) VALUES ('$massege','$to','$name')";
  //$qry = "INSERT INTO `tbl_complain`(`c_message`, `complain_to`,`complain_by`) VALUES ('$massege','$to','$name')";
  
  if(!$run = mysqli_query($con,$qry))
  {

    var_dump($con->error);
  }
  else{

    if($run == true)
    {
      ?>

        <script type="text/javascript">
          alert("Complain has been Registered.. ");
          window.open('Complained.php','_self');

        </script>
      <?php
    }
  }

}



?>

