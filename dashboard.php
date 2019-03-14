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
    $role = $dataes['role'];
    $full_name = $dataes['full_name'];
    $inst_name = $dataes['inst_name'];
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
font-size: 16px;">WELCOME:<span style="color: skyblue;"><?php echo $full_name; ?></span><span style="color: yellow;"> Last Logged In</span> <?php echo $data['logged_in_date']; echo " "; ?><a href="logout.php" class="btn btn-danger square-btn-adjust"> Logout</a> </div>
<?php } ?>
  
        <?php


        include("navigation.php")
        ?>
        <!-- /. NAV SIDE  -->

    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       <h2> Dashboard</h2>   
                        <h5>Welcome SISTec Product Stock Web </h5>
                       
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <?php 
               if($role == 'Admin' || $role == 'SAdmin' || $role == 'CAdmin' )
               {

               ?>  
               <div class="row pull-left" style="width: 53%;">
                <div class="col-md-12" >
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add New User/Admin
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <form role="form" action="dashboard.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                                       <div class="form-group">
                                            <label>Username :  </label> 
                                             <input class="form-control"  type="text" name="username" required="required">
                                            
                                         
                                        </div>
                                       
                                       <div class="form-group">
                                            <label> Password : </label>
                                            <input class="form-control"  type="text" name="pass" required="required">
                                         
                                        </div>
                                         <div class="form-group">
                                            <label> Full Name: </label>
                                            <input class="form-control"  type="text" name="name" required="required">
                                         
                                        </div>
                                        <div class="form-group">
                                            <label> Contact No: </label>
                                            <input class="form-control"  type="number" name="number" required="required">
                                         
                                        </div>
                                       
                                         <div class="form-group">
                                            <label> Email Address: </label>
                                            <input class="form-control"  type="email" name="email" required="required">
                                         
                                        </div>
                                        <div class="form-group">
                                            <label> Department Name: </label>
                                            <input class="form-control"  type="text" name="DPname" required="required">
                                         
                                        </div>
                                       <div class="form-group">
                                            <label> Active: </label>
                                            <select name="status"  class="form-control">
                                              <option value="YES">YES</option>
                                              <option value="NO">NO</option>
                                            </select>
                                         
                                        </div>
                                         <div class="form-group">
                                            <label>Institute Name : <span style="color: red;">*</span></label>
                                           <select  name="institute" class="form-control" id="combo">
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
                                        <div class="form-group">
                                            <label> ROLE: </label>
                                            <select  name="role" class="form-control">
                                              <?php
                                              if($role=='SAdmin')
                                              {
                                                ?>
                                                 <option value="">---SELECT---</option>
                                              <option value="SAdmin">SAdmin</option>
                                               <option value="CAdmin">CAdmin</option>
                                              <option value="Admin">Admin</option>
                                               <option value="Faculty">Faculty</option>
                                                <option value="Technical">Technical</option>
                                              
                                              
                                              <?php
                                              }
                                              else
                                                {
                                                  if($role == 'CAdmin')
                                                  {
                                                    ?>
                                                    <option value="">---SELECT---</option>
                                              <option value="CAdmin">CAdmin</option>
                                              <option value="Admin">Admin</option>
                                               <option value="Faculty">Faculty</option>
                                                <option value="Technical">Technical</option>
                                                    <?php


                                                  }else{
                                                    if($role == 'Admin')
                                                      {?>

                                                        <option value="">---SELECT---</option>
                                                <option value="Admin">Admin</option>
                                               <option value="Faculty">Faculty</option>
                                                <option value="Technical">Technical</option>
                                                  <?php
                                                      }
                                                      else
                                                      {
                                                        ?>
                                                        <option value="">---SELECT---</option>
                                                
                                               <option value="Faculty">Faculty</option>
                                                <option value="Technical">Technical</option>



                                                        <?php
                                                      }
                                                  }

                                                  
                                              
                                            }

                                              ?>
                                             
                                            </select>
                                         
                                        </div>
                                          
                                         
                                         
                                   
                                        <input type="submit" class="btn btn-default" name="submit" value="Add" />
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
                    <div ng-controller="TodoController" class="row pull-right" style="width: 51%;">
                <div class="col-md-12" >
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          All Added Users
                        </div>
                        <div class="panel-body">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                            <?php
                                              if($role == 'SAdmin')
                                              {
                                            ?><tr>
                                            <th>S.No</th>
                                           <th>Userid</th>
                                            <th>Full Name</th>
                                            <th>Role</th>                                          
                                            <th>Contact No</th>                                            
                                            <th>Institute Name</th>
                                            <th>Active</th>
                                            <th>Created Date</th>                                                        
                                             </tr>
                                        <?php
                                      }else
                                      {
                                        if($role == 'CAdmin' || $role == 'Admin')
                                        {

                                            ?><tr>
                                            <th>S.No</th>
                                           <th>Userid</th>
                                            <th>Full Name</th>
                                            <th>Role</th>                                          
                                            <th>Contact No</th>                                            
                                            
                                            <th>Created Date</th>                                                        
                                             </tr>
                                        <?php
                                        }else{
                                          ?><tr>
                                            <th>S.No</th>
                                           <th>Userid</th>
                                            <th>Full Name</th>
                                            <th>Role</th>                                          
                                            <th>Contact No</th>                                            
                                            
                                                                                                  
                                             </tr>
                                        <?php
                                        }
                                      }
                                      ?>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $count=0;
                                      include("config.php");
                                      if($role == 'SAdmin')
                                      {
                                        $qury = "SELECT userid, full_name,role, contact_no, inst_name, Active, date_format(created_date,'%d-%m-%Y') created_date FROM tbl_user";

                                      }
                                         elseif($role == 'CAdmin' || $role == 'Admin')
                                         {
                       
                                         $qury = "SELECT userid, full_name,role, contact_no, date_format(created_date,'%d-%m-%Y') created_date FROM tbl_user WHERE inst_name = '$inst_name' and role <> 'SAdmin' ";
                                         }
                                         else 
                                         {
                                           $qury = "SELECT userid, full_name,role, contact_no FROM tbl_user WHERE inst_name = '$inst_name' and role <> 'SAdmin' ";
                                         }
                                       
                                        if(!$run = mysqli_query($con,$qury))
                                        {
                                          var_dump($con->error);
                                        }
                                        else{
                                          while($dataer = mysqli_fetch_assoc($run))
                                          {
                                            $count++;
                                            if($role == 'SAdmin')
                                              {?>
                                                  <pagination 
                                                    ng-model="currentPage"
                                                    total-items="todos.length"
                                                    max-size="maxSize"  
                                                    boundary-links="true">
                                               <tr class="odd gradeX">
                                            
                                           
                                            <td class="center"><?php echo $count ; ?></td>
                                            <td class="center"><?php echo $dataer['userid']; ?></td>
                                             <td class="center"><?php echo $dataer['full_name']; ?></td>
                                            <td class="center"><?php echo $dataer['role']; ?></td>
                                             <td class="center"><?php echo $dataer['contact_no']; ?></td>
                                             <td class="center"><?php echo $dataer['inst_name']; ?></td>
                                             <td class="center"><?php echo $dataer['Active']; ?></td>
                                            <td class="center"><?php echo $dataer['created_date']; ?></td>

                                           </tr>
                                           <?php
                                         }else{
                                          if($role == 'CAdmin' || $role == 'Admin')
                                          {
                                            ?>
                                            <tr class="odd gradeX">
                                            
                                           
                                            <td class="center"><?php echo $count ; ?></td>
                                            <td class="center"><?php echo $dataer['userid']; ?></td>
                                             <td class="center"><?php echo $dataer['full_name']; ?></td>
                                            <td class="center"><?php echo $dataer['role']; ?></td>
                                             <td class="center"><?php echo $dataer['contact_no']; ?></td>
                                           
                                             <td class="center"><?php echo $dataer['created_date']; ?></td>

                                           </tr>


                                            <?php
                                          }
                                          else{
                                            ?>
                                            <tr class="odd gradeX">
                                            
                                           
                                            <td class="center"><?php echo $count ; ?></td>
                                            <td class="center"><?php echo $dataer['userid']; ?></td>
                                             <td class="center"><?php echo $dataer['full_name']; ?></td>
                                            <td class="center"><?php echo $dataer['role']; ?></td>
                                             <td class="center"><?php echo $dataer['contact_no']; ?></td>
                                           
                                              </tr>
                                                </pagination>

                                            <?php
                                          }
                                         }
                                       
                                              


                                           
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
            <div class="row pull-right ">
              <div class="col-md-12 " style="    margin-right: 12px;">                                      <label> Edit Your Profile <a href="Editprofile.php">Click Here</a></label>
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
  $usern = $_POST['username'];
  $Pass = $_POST['pass'];
  $Fname = $_POST['name'];
  $Cno = $_POST['number'];
  $email = $_POST['email'];
  $dpname = $_POST['DPname'];
  $sttu = $_POST['status'];
  $int_n = $_POST['institute'];

  $ROLE = $_POST['role'];
  $qry = "INSERT INTO `tbl_user`(`userid`, `password`, `full_name`, `contact_no`, `email`, `inst_name`, `department`, `role`,  `Active`) VALUES ('$usern','$Pass', upper('$Fname'),'$Cno','$email','$int_n','$dpname','$ROLE','$sttu');";
  $qry2 = "insert into tbl_loggedin_hist (userid) values('$usern')";
  $run2= mysqli_query($con,$qry2);
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
        alert("User Added Successful");
        
      </script>

      <?php
    }
    else{
      ?>
      <script type="text/javascript">
        alert("User not added");
        
      </script>

      <?php
    }

  }

}



?>