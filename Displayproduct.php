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
  $inst_name=$dataes['inst_name'];  
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
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="Displayproduct.php">SISTec - Stock</a> 
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
font-size: 16px;">WELCOME:<span style="color: skyblue;"><?php echo $fullname; ?></span><span style="color: yellow;"> Last Logged In</span> <?php echo $data['logged_in_date']; echo " ";?><a href="logout.php" class="btn btn-danger square-btn-adjust"> Logout</a> </div>
<?php } ?>
  
        <?php


        include("navigation.php")?>
        </nav>  
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Display Record</h2>   
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
                             Inventry Stock
                        </div>
                        <form role="form" action="Displayproduct.php" onsubmit="validation()" enctype="multipart/form-data" method="POST" name="Form3">
                           <div class="form-group">
                                            <label>  Product Category <span style="color: red;">*</span></label>
                                           <select name="combo"  id="combo">
                                               <option  value="">-- Select Category --</option>
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
                                        <label style="color: brown;">Or</label>
                                         <div class="form-group">
                                            <label>  LAB/Room No <span style="color: red;">*</span></label>
                                           <select name="LAb_no"  id="combo">
                                               <option  value="">-- Select LAB/Room No --</option>
                                               <?php  

                                                  $query="select * from tbl_product";
                                                      $result=mysqli_query($con,$query);
                                                      while ($row = mysqli_fetch_array($result)) {
                                                     echo '<option value = "' . $row['lab_room_no'] . '">' . 
                                                     $row['lab_room_no'] . '</option>';
                                                      }
                                                ?>
                                          </select>
                                         
                                        </div>
                                        <input type="hidden" name="inst" value=<?php $inst_name;?>>
                                         <input type="submit" class="btn btn-success" name="serach" value="Display" />



                        </form>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                          <th>Product Name</th>
                                            <th>Product Type</th>
                                            
                                            <th>Purchasing Date</th>

                                            <th>Order No</th>
                                            <th>Product Cost</th>
                                            <th>Ip Address</th>
                                            <th>Lab No/Room No</th>
                                            <th>Product Company</th>
                                            <th>Maintained By</th>
                                            <th>College Name</th>
                                            <th>Inserted By</th>
                                            <th>Inserted On</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      include("config.php");
                                      if(isset($_POST['serach']))
                                      {
                                        $product = $_POST['combo'];
                                        $lab = $_POST['LAb_no'];
                                      $insti_name = $_POST['inst'];
                                        $qury = "SELECT * FROM `tbl_product` WHERE `category`='$product' or lab_room_no='$lab' and college_group ='$insti_name'  ";
                                        if(!$run = mysqli_query($con,$qury))
                                        {
                                          var_dump($con->error);
                                        }
                                        else{
                                          while($data = mysqli_fetch_assoc($run))
                                          {
                                            ?>
                                             <tr class="odd gradeX">
                                           
                                            <td class="center"><?php echo $data['pid'] ; ?></td>
                                            <td class="center"><?php echo $data['pname']; ?></td>
                                             <td class="center"><?php echo $data['category'] ?></td>
                                            
                                            <td class="center"><?php echo $data['purchasing_date'] ?></td>
                                            <td class="center"><?php echo $data['order_no'] ?></td>
                                            <td class="center"><?php echo "&#8377; "; echo $data['Product_cost']; echo "/-" ?></td>
                                            <td class="center"><?php echo $data['ip_add_serial_no'] ?></td>
                                            <td class="center"><?php echo $data['lab_room_no'] ?></td>
                                            <td class="center"><?php echo $data['product_company'] ?></td>
                                             <td class="center"><?php echo $data['incharge_name'] ?></td>
                                              <td class="center"><?php echo $data['college_group'] ?></td>
                                              <td class="center"><?php echo $data['inserted_by'] ?></td>
                                              <td class="center"><?php echo $data['inserted_on'] ?></td>
                                               
                                        </tr>

                                            <?php
                                          }
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
            </div>
                <!-- /. ROW  -->
        </div>
     
             <!-- /. PAGE INNER  -->
            
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
