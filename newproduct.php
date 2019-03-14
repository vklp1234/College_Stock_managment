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
    $inst_name = $dataes['inst_name'];
    $role =$dataes['role'];
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
                       <h2>Add New Product</h2>   
                        <h5>Welcome SISTec Product Stock Web </h5>
                       
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add New Product
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <form role="form" action="newproduct.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                                        <div class="form-group">
                                            <label>Product ID <span style="color: red;">*</span></label> 
                                            <input class="form-control" type="text" autofocus="autofocus" placeholder="123XXX56" name="Pid" required="required" />
                                         
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Product Name <span style="color: red;">*</span></label>
                                           <input class="form-control" type="text" name="pname" required="required" />
                                         
                                        </div>
										                     <div class="form-group">
                                            <label>Product Category <span style="color: red;">*</span></label>
                                           <select name="combo" class="form-control" id="combo">
                                               <option  value="">-- Select --</option>
                                               <?php  

                                                  $query="select * from tbl_product_category";
                                                      $result=mysqli_query($con,$query);
                                                      while ($row = mysqli_fetch_array($result)) {
                                                     echo '<option value = "' . $row['category'] . '">' . 
                                                     $row['category'] . '</option>';
                                                      }
                                                ?>
                                          </select>
                                         
                                        </div>
                                        <div class="form-group">
                                            <label>Product Cost <span style="color: red;">*</span></label>
                                            <input class="form-control" type="text" placeholder="xxxx/-"  name="pcost" required="required" />
                                        </div>
                                       
                                         <div class="form-group ">
                                            <label>Purchasing Date <span style="color: red;">*</span></label>
                                           <input class="form-control" type="date" name="pdate" required="required"  />
                                         
                                        </div>
                                       
                                         <div class="form-group">
                                            <label>Order No <span style="color: red;">*</span></label>
                                           <input class="form-control" type="text" name="ono" required="required"  />
                                         
                                        </div>
                                       
                                           <div class="form-group ">
                                            <label>IP Address / Serial No <span style="color: red;">*</span></label>
                                           <input class="form-control" type="text" placeholder="xxx.xx.xx.x" name="ip" required="required"  />
                                         
                                        </div>
                                         
                                         <div class="form-group ">
                                            <label>Lab No/Room No <span style="color: red;">*</span></label>
                                           <select  name="lno" class="form-control" id="combo">
                                               <option  value="">-- Select --</option>
                                               <?php  
                                                
                                                  $query="select * from tbl_rooms";
                                   
                                                      $result=mysqli_query($con,$query);
                                                      while ($row = mysqli_fetch_array($result)) 
                                                      {
                                                     echo '<option value = "' . $row['room_name'] . '">' . 
                                                     $row['room_name'] . '</option>';
                                                      }
                                                
                                                ?>
                                          </select>
                                         
                                        </div>
                                       
                                            <div class="form-group">
                                            <label>Maintained /incharged By <span style="color: red;">*</span></label>
                                           <input class="form-control " type="text" name="mname" required="required"  />
                                         
                                        </div>
                                        <div class="form-group">
                                            <label>Product Company : <span style="color: red;">*</span></label>
                                            <input  class="form-control" type="text"  name="pcom" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>College/School Name : <span style="color: red;">*</span></label>
                                           <select  name="clg" class="form-control" id="combo">
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
                                        
                                       <input type="hidden" name="cname" value=<?php echo $dataes['full_name'];?>>
                                        
                                        
                                        
                                   
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
                <!-- /. ROW  -->
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
  $in_by=$_POST['cname'];
  $p_id = $_POST['Pid'];
  $p_Name = $_POST['pname'];
  $P_type = $_POST['combo'];
  $p_cost = $_POST['pcost'];
  $P_date = $_POST['pdate'];
  $O_No = $_POST['ono'];
  $ip_a = $_POST['ip'];
  $l_no = $_POST['lno'];
  $main = $_POST['mname'];
  $p_C = $_POST['pcom'];
    $college = $_POST['clg'];
  $qry = "INSERT INTO `tbl_product`(`pid`, `pname`, `category`, `purchasing_date`,`Product_cost`, `order_no`, `ip_add_serial_no`, `lab_room_no`, `product_company`, `incharge_name`, `college_group`,`inserted_by`) VALUES ('$p_id','$p_Name','$P_type','$P_date','$p_cost','$O_No','$ip_a','$l_no','$p_C','$main','$college','$in_by')";
  
  if(!$run = mysqli_query($con,$qry))
  {

    var_dump($con->error);
  }
  else{

    if($run == true)
    {
      ?>

        <script type="text/javascript">
          alert("Product Added");

        </script>
      <?php
    }
  }

}



?>

