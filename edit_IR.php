<?php

error_reporting(0);
session_start();
// $_SESSION['index10'] = 0;
$bin = 0;
   $insert= false;
   $update = false;
  $delete = false;
  $empty_stock_alert= false;

  $dbhost= "localhost";
  $dbuser= "root";
  $dbpass= "";
  $dbname= "MY_IMS";
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if($mysqli->connect_errno){
      echo "Error Occured" . $mysqli->connect_error;
  }

  if(isset($_GET['delete'])){
    $sno = $_GET['delete'];

    $sql1= "SELECT `item_name` ,`quantity_issued` FROM `issue_recurring` WHERE `sno` = $sno";  
    $result10 = mysqli_query($mysqli, $sql1);                                                      
    $row = mysqli_fetch_assoc($result10);                                                         
    $item_name_IR= $row["item_name"];                                                  
    $quantity_ir= $row["quantity_issued"];
      
      // updating the current stock
      $sql12= "SELECT `quantity` FROM `current_stock` WHERE `item_name` = '$item_name_IR'";
        $result11 = mysqli_query($mysqli, $sql12);
        if($result11){ 
          }
          else{
          echo "Successfully Updated ---> ". mysqli_error($mysqli);
        }
        $row = mysqli_fetch_assoc($result11);
        $quantity_cs= $row["quantity"];
        $quantity_new= $quantity_cs+$quantity_ir;
        $sql3 = "UPDATE `current_stock` SET `quantity` = '$quantity_new' WHERE `item_name` = '$item_name_IR'";
        $result3 = mysqli_query($mysqli, $sql3);
        if($result3){ 
          }
          else{
          echo "Successfully Updated ---> ". mysqli_error($mysqli);
        }
        // delete from ISSURE reccuring _ Actually hiding from the user side.
        $bin2=2;
        $sql = "UPDATE `issue_recurring` SET `bin` = '$bin2'  WHERE `issue_recurring`.`sno` = $sno";
        $result = mysqli_query($mysqli, $sql);
        $delete = true;
  }

  

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (isset( $_POST['snoEdit'])){
            // update the record
          $sno= $_POST["snoEdit"];
          // $_SESSION['sino']=$sno;
          $requisition_no = $_POST['requisition_noEdit'];
          $item_name = $_POST['item_nameEdit'];
          $to_whom_issued = $_POST["to_whom_issuedEdit"];
          $quantity_issued = $_POST["quantity_issuedEdit"];
          $accumulation = $_POST["accumulationEdit"];
          $ref_if_any = $_POST["ref_if_anyEdit"];
          $remarks = $_POST["remarksEdit"];
          $bin = 0;
          $bin1 = 1;
          // UPDATING ISSUE RECC. (ACTUALLY INSERT NEW ROW INTO ISSUE RECCURING).
           $sql = "INSERT INTO `issue_recurring`(  `requisition_no` ,`item_name` , `to_whom_issued`, `quantity_issued`, `accumulation`,`ref_if_any`, `remarks`, `bin`) 
           VALUES ('$requisition_no', '$item_name', '$to_whom_issued', '$quantity_issued', '$accumulation', '$ref_if_any', '$remarks', '$bin')";
           $result = mysqli_query($mysqli, $sql);
           if($result){
            //   $insert= true;
            }

            // Sql query to be executed
            $sql = "UPDATE `issue_recurring` SET `bin` = '$bin1' WHERE `sno` = $sno";
            $result = mysqli_query($mysqli, $sql);
            if($result){ 
              } else{
              echo "Successfully Updated ---> ". mysqli_error($mysqli);
            }

        //  Updating the current stk depends upon how much less or greater value of quantity you issued
        $sql1= "SELECT `item_name` ,`quantity_issued`, `tstamp` FROM `issue_recurring` WHERE `sno` = $sno";  
        $result10 = mysqli_query($mysqli, $sql1);                                                      
        $row = mysqli_fetch_assoc($result10);                                                         
        $item_name_ir= $row["item_name"];                                                  
        $quantity_ir= $row["quantity_issued"];
        $tstamp= $row["tstamp"];
        $_SESSION['tstamp']=$tstamp;


        $sql2= "SELECT `quantity` FROM `current_stock` WHERE `item_name` = '$item_name'";
        $result1 = mysqli_query($mysqli, $sql2);
        $row = mysqli_fetch_assoc($result1);
        $quantity_cs= $row["quantity"];
            
        if($quantity_issued > $quantity_ir){
            //edit increse the quantity
            $quantity_net=$quantity_issued-$quantity_ir;
            $quantity_new= $quantity_cs-$quantity_net;
            $sql3 = "UPDATE `current_stock` SET `quantity` = '$quantity_new' WHERE `current_stock`.`item_name` = '$item_name'";
            $result3 = mysqli_query($mysqli, $sql3);
            if($result3){ 
                $update= true;
              }
              else{
              echo "Successfully Updated ---> ". mysqli_error($mysqli);
            }

        } else if( $quantity_issued < $quantity_ir) {
            //delete decrease the quantity
              $quantity_net=$quantity_ir-$quantity_issued;
              $quantity_new= $quantity_cs+$quantity_net;
              $sql6 = "UPDATE `current_stock` SET `quantity` = '$quantity_new' WHERE `current_stock`.`item_name` = '$item_name'";
              $result6 = mysqli_query($mysqli, $sql6);
              if($result6){ 
                $update= true;
                }
                else{
                echo "Successfully Updated ---> ". mysqli_error($mysqli);
              }

        } else {
        
        }


      } else {
          $item_name = $_POST['item_name'];
          $sql5= "SELECT * FROM `current_stock` WHERE `item_name` = '$item_name'";
          $result5 = mysqli_query($mysqli, $sql5);
          $row = mysqli_fetch_assoc($result5);

          if($row>0){
           // echo "present"; // INSERT INTO ISSUE RECC AND CURR STK
           $requisition_no = $_POST['requisition_no'];
              $to_whom_issued = $_POST['to_whom_issued'];
              $_SESSION['to_whom_issued']=$to_whom_issued;
              $quantity_issued = $_POST['quantity_issued'];
              $accumulation = $_POST['accumulation'];
              $ref_if_any = $_POST['ref_if_any'];
              $remarks = $_POST['remarks'];
              $bin = 0;

              // Sql query to be executed
              $sql = "INSERT INTO `issue_recurring`(`requisition_no` , `item_name` , `to_whom_issued`, `quantity_issued`, `accumulation`,`ref_if_any`, `remarks`, `bin`) 
              VALUES ('$requisition_no', '$item_name',  '$to_whom_issued', '$quantity_issued', '$accumulation', '$ref_if_any', '$remarks', 'bin')";
              $result = mysqli_query($mysqli, $sql);

              if($result){ 
                  
                // UPDATING CURR. STK
                  $sql2= "SELECT `quantity` FROM `current_stock` WHERE `item_name` = '$item_name'";
                  $result1 = mysqli_query($mysqli, $sql2);
                  $row = mysqli_fetch_assoc($result1);
                  $quantity_cs= $row["quantity"];
                  $quantity_new= $quantity_cs-$quantity_issued;
                  $sql3 = "UPDATE `current_stock` SET `quantity` = '$quantity_new' WHERE `current_stock`.`item_name` = '$item_name'";
                  $result3 = mysqli_query($mysqli, $sql3);

                  if($result3){ 
                    
                  } else{
                    echo "Successfully Updated ---> ". mysqli_error($mysqli);
                  }
                  $insert= true;
                } else {
                  echo "not insert";
                echo "The record was not inserted successfully because of this error ---> ". mysqli_error($mysqli);
                }

                

                if($insert){
         
                 }

          } else {
            $empty_stock_alert= true;
          } 
     
      } // else
 
  } //post top
?>


          


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap CSS -->


  <!-- form1 previous build forms css source bootstrap -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

  <!-- features  css -->

  <!-- head -->

  <!-- Bootstrap core CSS -->
  <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#7952b3">

  <!-- fontawesome -->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
    .inr_top_bar {
                    width: 100%;
                    display: inline-block;
                    border-bottom: 1px solid #eaeaea;
                    position: relative;
                    margin-top: -34px;
                }
                                /* @media (max-width: 1280px) */
                .containerr {
                    padding: 0 10px;
                    box-sizing: border-box;
                }
                .containerr {
                    width: 100%;
                    padding: 0 7%;
                    display: inline-block;
                    font-family: Arial;
                    margin-right: auto;
                    margin-left: auto;
                }
              .inr_top_bar ul {
                  width: 100%;
                  display: inline-block;
                  background: #DBEDED;
                  border-radius: 15px 15px 0 0;
              }
              .ull {
                  list-style: none inside;
                  margin: 0;
                  font-family: Arial;
                  margin-top: 0;
                  margin-bottom: 10px;
                  
              }
              .lii {
                  list-style: none inside;
                  margin: 0;
                  font-family: Arial;
                  margin-top: 0;
                  margin-bottom: 10px;
              }
              }

              /* user agent stylesheet */
              .ull {
                  display: block;
                  list-style-type: disc;
                  margin-block-start: 1em;
                  margin-block-end: 1em;
                  margin-inline-start: 0px;
                  margin-inline-end: 0px;
                  padding-inline-start: 40px;
              }


  </style>

<style>
                .btnn {
                    display: inline-block;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #ffffff;
                    text-align: center;
                    text-decoration: none;
                    vertical-align: middle;
                    cursor: pointer;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    user-select: none;
                    height: 200px;
                    background-color: #4b5563;
                    border: 1px solid transparent;
                    padding: .375rem .75rem;
                    font-size: 1rem;
                    border-radius: .25rem;
                    width: 150px;
                    font-size: x-large;
                    font-family: system-ui;
                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                }
                div.mbb-5{
                    position: relative;
                    margin-bottom: 3rem!important;
                    margin-top: 150px;
                    margin-left: 50px;
                }
            </style>

  <!-- Custom styles for this template -->
  <link href="features.css" rel="stylesheet">


  <title>IMS-NITTTR KOLKATA</title>
</head>

<body>


    <!-- navigation bar testing okay! -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-3 pb-3">
    <img src="/ims-nitttr-kolkata/logo/logo.jpg" height="55px" width="55px" alt="">
        <div class="container-fluid">
        <h1>
        <a class="navbar-brand" href="">Inventory Management System</a>
        </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            <!-- <a class="nav-link" href="index.php">Home</a> -->
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
            <!-- <a class="nav-link" href="admin.php">Admin</a> -->
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
            <a class="nav-link active" href="store_keeper.php">Store-Keeper</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
            <a class="nav-link active" href="fic_iws.php">FIC-IWS</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
            <a class="nav-link active" href="fic_electrical.php">FIC-Electrical</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
            <a class="nav-link active" href="requisition.php">Faculty And Others</a>
            </div>
        </div>     
 
        <form class="d-flex" form action= "login.php">
              <a href="login.php">
                <button class="btn btn-danger" type="submit">Logout</button>
                </a>
        </form>
  </nav>





    <!-- Webpage Sidebar (Dashboard ) -->
    <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
</div>
      <h1><a href="" class="logo"></a></h1>
<ul class="list-unstyled components mb-5">
  <li class="active">
    <a href="edit_SNR.php"><span class="fa fa-shopping-cart mr-3"></span>  Stock Non Recurring</a>
  </li>
  <li class="active">
      <a href="edit_SR.php"><span class="fa fa-shopping-cart mr-3"></span> Stock Recurring</a>
  </li>
  <li class="active">
    <a href="edit_IR.php"><span class="fa fa-shopping-cart mr-3"></span> Issue Recurring </a>
  </li>
  <li class="active">
    <a href="sk_report_CSR.php"><span class="fa fa-shopping-cart mr-3"></span> Current Stock </a>
  </li>
  <li class="active">
    <a href="edit_SR_IWS.php"><span class="fa fa-shopping-cart mr-3"></span>  IWS Recurring </a>
  </li>
  <li class="active">
    <a href="edit_SR_Electrical.php"><span class="fa fa-shopping-cart mr-3"></span> Electrical Recurring </a>
  </li>
  <li class="active">
    <a href="requisition_SK.php"><span class="fa fa-paper-plane mr-3"></span> Requisition </a>
  </li>
  <li class="active">
    <a href="sk_report_search.php"><span class="fa fa-paper-plane mr-3"></span>  Report and Search </a>
  </li>
</ul>
 
<div class="wrapper d-xl-inline-flex">
    <div class="mbb-5">
        <h3 class="h6 mb-3"> 
            <button class="btnn" type="submit">Welcome <br> Stock Keeper </button>
        </h3>
    </div>
    </div>

</nav>



    <!-- editModal -->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
Edit Modal
</button> -->

    <!-- editModal -->
    <div class="modal fade" id="editModal" tabindx="-1" aria-labelled_by="editModalLabel"
      aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit this Entry</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="/ims-nitttr-kolkata/edit_IR.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="snoEdit" id="snoEdit">

              <div class="form-group">
                <label for="requisition_no">Reference No</label>
                <textarea class="form-control" id="requisition_noEdit" name="requisition_noEdit" rows="3"></textarea>
              </div>
              
              <div class="form-group">
                <label for="item_name">Item Name</label>
                <textarea class="form-control" id="item_nameEdit" name="item_nameEdit" rows="3"></textarea>
              </div>           
               
              <div class="form-group">
                <label for="date_of_issue">Date Of Issue</label>
                <textarea class="form-control" id="date_of_issueEdit" name="date_of_issueEdit" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="to_whom_issued">To Whom Issued</label>
                <textarea class="form-control" id="to_whom_issuedEdit" name="to_whom_issuedEdit" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="quantity_issued">Quantity Issued</label>
                <textarea class="form-control" id="quantity_issuedEdit" name="quantity_issuedEdit" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="accumulation">Accumulation</label>
                <textarea class="form-control" id="accumulationEdit" name="accumulationEdit" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="ref_if_any">Ref If Any</label>
                <textarea class="form-control" id="ref_if_anyEdit" name="ref_if_anyEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea class="form-control" id="remarksEdit" name="remarksEdit" rows="3"></textarea>
              </div>
            </div>

            <div class="modal-footer d-block mr-auto">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <div>
      <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Succes</strong> Your entry has been added Succesfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
      <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
      <?php
  if($empty_stock_alert){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>This Item is not available in the Current Stock</strong> .
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>×</span>
      </button>
    </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
//   $_SESSION['index10'] = 1;
   }
  ?>
   <br><br><br>
 <div class="inr_top_bar">
	<div class="container">
        <h4> 
            <ull>
            	<a href="store_keeper.php">  Store Keeper  </a> >
                 <lii><a href="edit_IR.php"> Issue Recuring </a></lii>
            </ull>
        </h4>
    	</div>
    </div>
    <br>

      <br> 
      <center>
        <h1>Issue Recuring</h1>
      </center>
      <hr>
  <div class="container my-4">
        <h2>Item Issue</h2>

        <form action="/ims-nitttr-kolkata/edit_IR.php?update=true" method="POST">

          <div class="form-group">
            <label for="requisition_no">Requisition No</label>
            <textarea class="form-control" id="requisition_no" name="requisition_no" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="item_name">Item Name</label>
            <textarea class="form-control" id="item_name" name="item_name" rows="3"></textarea>
          </div>


          <div class="form-group">
            <label for="to_whom_issued">To Whom Issued</label>
            <!-- <textarea class="form-control" id="to_whom_issued" name="to_whom_issued" rows="3"></textarea> -->
            <select id="to_whom_issued" name="to_whom_issued" class="form-select">
              <option selected>Choose...</option>
              <option id=1 value="Faculty 1">Faculty 1</option>
              <option id=2 value="Faculty 2">Faculty 2</option>
            </select>
          </div>
          <div class="form-group">
            <label for="quantity_issued">Quantity Issued</label>
            <textarea class="form-control" id="quantity_issued" name="quantity_issued" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="accumulation">Accumulation (Optional)</label>
            <textarea class="form-control" id="accumulation" name="accumulation" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="ref_if_any">Ref If Any (Optional)</label>
            <textarea class="form-control" id="ref_if_any" name="ref_if_any" rows="3"></textarea>
          </div>

      
      <div class="form-group">
        <label for="remarks">Remarks</label>
        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
      </div>

      <div class="mb-3">
      </div>
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
      </form>
    </div>

    <div class="container my-4">

      <table class="table" assign="center" id="myTable">
        <thead class="table-dark">
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Requisition No</th>
            <th scope="col">Item Name</th>
            <th scope="col">Date Of Issue</th>
            <th scope="col">To Whom Issued</th>
            <th scope="col">Quantity Issued</th>
            <th scope="col">Accumulation</th>
            <th scope="col">Ref. if any</th>
            <th scope="col">Remarks</th>
            
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM issue_recurring WHERE `bin` = 0";
          $result = mysqli_query($mysqli, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>".$row["requisition_no"]."</td>
            <td>".$row["item_name"]."</td>
            <td>".$row["date_of_issue"]."</td>
            <td>".$row["to_whom_issued"]."</td>
            <td>".$row["quantity_issued"]."</td>
            <td>".$row["accumulation"]."</td>
            <td>".$row["ref_if_any"]."</td>
            <td>".$row["remarks"]."</td>
            
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
              
            </tr>";
                        
          } 
          ?>
        </tbody>
      </table>
    </div>
    </div>
    </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  </script>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        requisition_no = tr.getElementsByTagName("td")[0].innerText;
        item_name = tr.getElementsByTagName("td")[1].innerText;
        date_of_issue = tr.getElementsByTagName("td")[2].innerText;
        to_whom_issued = tr.getElementsByTagName("td")[3].innerText;
        quantity_issued = tr.getElementsByTagName("td")[4].innerText;
        accumulation = tr.getElementsByTagName("td")[5].innerText;
        ref_if_any = tr.getElementsByTagName("td")[6].innerText;
        remarks = tr.getElementsByTagName("td")[7].innerText;
        console.log(requisition_no, item_name,  to_whom_issued, quantity_issued, accumulation, ref_if_any, remarks);
        requisition_noEdit.value = requisition_no;
        item_nameEdit.value = item_name;
        date_of_issueEdit.value = date_of_issue;
        to_whom_issuedEdit.value = to_whom_issued;
        quantity_issuedEdit.value = quantity_issued;
        accumulationEdit.value = accumulation;
        ref_if_anyEdit.value = ref_if_any;
        remarksEdit.value = remarks;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/ims-nitttr-kolkata/edit_IR.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>








  <!-- footer -->
  <footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">
      
        <!-- Facebook -->
		<a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/NITTTR.Kolkata/" role="button"
			><i class="fab fa-facebook-f"></i
		></a>
        <!-- Twitter -->
		<a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/nitttr_kolkata" role="button"
			><i class="fab fa-twitter"></i
		></a>
  
        <!-- YouTube -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.youtube.com/watch?v=UMscytEBEaA" role="button"
			><i class="fab fa-youtube"></i
		></a>
  
         
  
        <!-- Linkedin -->
		<a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/nitttr-kolkata-520769211/" role="button"
			><i class="fab fa-linkedin-in"></i
		></a>
    
  
  
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(8, 2, 94, 0.2);">
    Website Designed at NITTTR, Kolkata and All Rights Reserved
      <a class="text-white" href="www.nitttrkol.ac.in"> </a>
    </div>
    <!-- Copyright -->
  </footer>






  <span class="border border-dark"></span>
  <!-- javascript source of sidebar -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  </script>

  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->



</body>

</html>