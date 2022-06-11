<?php

error_reporting(0);
session_start();
// $_SESSION['index10'] = 0;
$bin = 0;
   $insert= false;
   $update = false;
  $delete = false;

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
        $delete = true;
  
        $sql1= "SELECT `detailed_description`, `quantity` FROM `stock_issue_recurring_iws` WHERE `sno` = $sno";
        $result1 = mysqli_query($mysqli, $sql1);
        $row = mysqli_fetch_assoc($result1);
        $item_name= $row["detailed_description"];
        $quantity_sr= $row["quantity"];
  
        // $sql2= "SELECT `quantity` FROM `current_stock` WHERE `item_name` = '$item_name'";
        //   $result1 = mysqli_query($mysqli, $sql2);
        //   $row = mysqli_fetch_assoc($result1);
        //   $quantity_cs= $row["quantity"];
        //   $quantity_new= $quantity_cs-$quantity_sr;
        //   $sql3 = "UPDATE `current_stock` SET `quantity` = '$quantity_new' WHERE `current_stock`.`item_name` = '$item_name'";
        //   $result3 = mysqli_query($mysqli, $sql3);
        //   if($result3){ 
        //     }
        //     else{
        //     echo "Successfully Updated ---> ". mysqli_error($mysqli);
        //   }
      }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (isset( $_POST['snoEdit'])){
        // update the record
      $sno= $_POST["snoEdit"];
      $requisition_no = $_POST["requisition_noEdit"];
      $challan_No = $_POST["challan_NoEdit"];
      $item_date = $_POST["item_dateEdit"];
      $detailed_description = $_POST["detailed_descriptionEdit"];
      $name_of_supplier = $_POST["name_of_supplierEdit"];
      $order_no = $_POST["order_noEdit"];
      $order_date = $_POST["order_dateEdit"];
      $quantity = $_POST["quantityEdit"];
      $unit_price = $_POST["unit_priceEdit"];
      $total_price = $_POST["total_priceEdit"];
      $reference_to_issue_voucher = $_POST["reference_to_issue_voucherEdit"];
      $quantity_issued = $_POST["quantity_issuedEdit"];
      $balance = $_POST["balanceEdit"];
      $remarks = $_POST["remarksEdit"];
      $bin = 1;

      // TO UPDATE ENTRY FROM CURRENT STOCK (TRAVERSING BY detailed_description)
      $sql1= "SELECT `detailed_description` FROM `stock_issue_recurring_iws` WHERE `sno` = $sno";
      $result1 = mysqli_query($mysqli, $sql1);
      $row = mysqli_fetch_assoc($result1);
      $item_name= $row["detailed_description"];   

        $sql1 = "UPDATE `current_stock` SET `item_name`= '$detailed_description', `quantity` = '$quantity', `remarks` = '$remarks' WHERE `item_name` = '$item_name'";
        $result1 = mysqli_query($mysqli, $sql1);
          if ($result1) {
          } else {
            echo "Error deleting record: " . mysqli_error($mysqli);
          }
          

        // Sql query to be executed
        $sql = "UPDATE `stock_issue_recurring_iws` SET `requisition_no` = '$requisition_no', `challan_No` = '$challan_No', `item_date` = '$item_date',`detailed_description` = '$detailed_description',
        `name_of_supplier` = '$name_of_supplier',`order_no` = '$order_no',`order_date` = '$order_date',`quantity` = '$quantity',`unit_price` = '$unit_price', 
        `total_price` = '$total_price',`reference_to_issue_voucher` = '$reference_to_issue_voucher',`quantity_issued` = '$quantity_issued',
        `balance` = '$balance', `remarks` = '$remarks', `bin` = '$bin'  WHERE `stock_issue_recurring_iws`.`sno` = $sno";
        $result = mysqli_query($mysqli, $sql);
        if($result){ 
          $update= true;
          }
          else{
           echo "Successfully Updated ---> ". mysqli_error($mysqli);
         }

  
      } else {
        $requisition_no = $_POST['requisition_no'];
        $challan_No = $_POST['challan_No'];
        $item_date = $_POST['item_date'];
        $detailed_description = $_POST['detailed_description'];
        $name_of_supplier = $_POST['name_of_supplier'];
        $order_no = $_POST['order_no'];
        $order_date = $_POST['order_date'];
        $quantity = $_POST['quantity'];
        $unit_price = $_POST['unit_price'];
        $total_price = $_POST['total_price'];
        $reference_to_issue_voucher = $_POST['reference_to_issue_voucher'];
        $quantity_issued = $_POST['quantity_issued'];
        $balance = $_POST['balance'];
        $remarks = $_POST['remarks'];
        $bin = 0;

        // Sql query to be executed
        $sql = "INSERT INTO `stock_issue_recurring_iws`(`requisition_no`, `challan_No`, `item_date`,`detailed_description`, `name_of_supplier`, `order_no`,`order_date`, `quantity`, `unit_price`, `total_price`, `reference_to_issue_voucher`, `quantity_issued`, `balance`, `remarks`, `bin`) 
        VALUES ('$requisition_no', '$challan_No', '$item_date','$detailed_description', '$name_of_supplier', '$order_no','$order_date', '$quantity', '$unit_price', '$total_price', '$reference_to_issue_voucher', '$quantity_issued', '$balance', '$remarks', 'bin')";
      $result = mysqli_query($mysqli, $sql);
      if($result){ 
          $insert= true;
      }
  }
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <!-- Bootstrap CSS -->
    

    <!-- form1 previous build forms css source bootstrap -->
    <script 
    src="https://code.jquery.com/jquery-3.6.0.js" 
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <!-- features  css -->

                <!-- head -->
            
                <!-- Bootstrap core CSS -->
            <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
  <div class="modal fade" id="editModal" tabindx="-1" aria-labelled_by="editModalLabel" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Entry</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/ims-nitttr-kolkata/edit_SR_IWS.php" method="POST">
          <div class="modal-body">
              <input type="hidden" name="snoEdit" id="snoEdit">
              <div class="form-group">
                <label for="requisition_no">Requisition No</label>
                <input type="text" class="form-control" id="requisition_noEdit" name="requisition_noEdit"
                  aria-describedby="emailHelp">
              </div>

              <div class="form-group">
                <label for="challan_No">Challan No</label>
                <textarea class="form-control" id="challan_NoEdit" name="challan_NoEdit" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="item_date">Challan Date</label>
                <textarea class="form-control" id="item_dateEdit" name="item_dateEdit" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="detailed_description">Detailed Description</label>
                <textarea class="form-control" id="detailed_descriptionEdit" name="detailed_descriptionEdit"
                  rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="name_of_supplier">Name of Supplier</label>
                <textarea class="form-control" id="name_of_supplierEdit" name="name_of_supplierEdit"
                  rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="order_no">Order No</label>
                <textarea class="form-control" id="order_noEdit" name="order_noEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="order_date">Order Date</label>
                <textarea class="form-control" id="order_dateEdit" name="order_dateEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="quantity">Quantity</label>
                <textarea class="form-control" id="quantityEdit" name="quantityEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <textarea class="form-control" id="unit_priceEdit" name="unit_priceEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="total_price">Total Price</label>
                <textarea class="form-control" id="total_priceEdit" name="total_priceEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="reference_to_issue_voucher">Reference to Issue Voucher</label>
                <textarea class="form-control" id="reference_to_issue_voucherEdit" name="reference_to_issue_voucherEdit"
                  rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="quantity_issued">Quantity Issued</label>
                <textarea class="form-control" id="quantity_issuedEdit" name="quantity_issuedEdit" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="balance">Balance</label>
                <textarea class="form-control" id="balanceEdit" name="balanceEdit" rows="3"></textarea>
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
                 <lii><a href="edit_SR_IWS.php"> IWS Recurring </a></lii>
            </ull>
        </h4><hr>
    	</div>
    </div>
    

      <center><h1>IWS Recurring (Stock/Issue)</h1></center><hr>
  <div class="container my-4 "><br>

    <h2>Item Stock and Issue</h2>
    <form action="/ims-nitttr-kolkata/edit_SR_IWS.php?update=true" method="POST">
      <div class="form-group">
        <label for="requisition_no" class="form-label">Requisition No</label>
        <input type="text" class="form-control" id="requisition_no" name="requisition_no" >
      </div>
      <div class="form-group">
        <label for="challan_No" class="form-label">Challan No</label>
        <input type="text" class="form-control" id="challan_No" name="challan_No">
      </div>
      <div class="form-group">
        <label for="item_date" class="form-label">Challan Date</label>
        <input type="text" class="form-control" id="item_date" name="item_date" placeholder="DD/MM/YYYY">
      </div>
      <div class="mb-3">
        <label for="detailed_description" class="form-label">Detailed Description</label>
        <textarea class="form-control" id="detailed_description" name="detailed_description" rows="4"></textarea>
      </div>
      <div class="form-group">
        <label for="name_of_supplier" class="form-label">Name of Supplier</label>
        <input type="text" class="form-control" id="name_of_supplier" name="name_of_supplier">
      </div>
      <div class="form-group">
        <label for="order_no" class="form-label">Order No</label>
        <input type="text" class="form-control" id="order_no" name="order_no">
      </div>
      <div class="form-group">
        <label for="order_date" class="form-label">Order Date</label>
        <input type="text" class="form-control" id="order_date" name="order_date" placeholder="DD/MM/YYYY">
      </div>
      <div class="form-group">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity">
      </div>
      <div class="form-group">
        <label for="unit_price" class="form-label">Unit Price</label>
        <input type="text" class="form-control" id="unit_price" name="unit_price">
      </div>
      <div class="form-group">
        <label for="total_price" class="form-label">Total Price</label>
        <input type="text" class="form-control" id="total_price" name="total_price">
      </div>
      <div class="form-group">
        <label for="reference_to_issue_voucher" class="form-label">Reference to Issue Voucher (Optional)</label>
        <input type="text" class="form-control" id="reference_to_issue_voucher" name="reference_to_issue_voucher" placeholder="DD/MM/YYYY">
      </div>
      <div class="form-group">
        <label for="quantity_issued" class="form-label">Quantity Issued (Optional)</label>
        <input type="text" class="form-control" id="quantity_issued" name="quantity_issued">
      </div>
      <div class="form-group">
        <label for="balance" class="form-label">Balance (Optional)</label>
        <input type="text" class="form-control" id="balance" name="balance">
      </div>
      <div class="mb-3">
        <label for="remarks" class="form-label">Remarks</label>
        <textarea class="form-control" id="remarks" rows="4" name="remarks"></textarea>
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
            <th scope="col">Sl.No</th>
            <th scope="col">Requisition No</th>
            <th scope="col">Entry Date</th>
            <th scope="col">Challan No</th>
            <th scope="col">Challan Date</th>
            <th scope="col">Detailed Description</th>
            <th scope="col">Name of Supplier</th>
            <th scope="col">Order No</th>
            <th scope="col">Order Date</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Total Price</th>
            <th scope="col">Reference to Issue Voucher (Date)</th>
            <th scope="col">Quantity Issued</th>
            <th scope="col">Balance</th>
            <th scope="col">Remarks</th>
            <th scope="col">Acknowledgement Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM stock_issue_recurring_iws";
            $result = mysqli_query($mysqli, $sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
              $sno = $sno + 1;
              echo "<tr>
              <th scope='row'>". $sno . "</th>
              <td>".$row["requisition_no"]."</td>
              <td>".$row["ent_date"]."</td>
              <td>".$row["challan_No"]."</td>
              <td>".$row["item_date"]."</td>
              <td>".$row["detailed_description"]."</td>
              <td>".$row["name_of_supplier"]."</td>
              <td>".$row["order_no"]."</td>
              <td>".$row["order_date"]."</td>
              <td>".$row["quantity"]."</td>
              <td>".$row["unit_price"]."</td>
              <td>".$row["total_price"]."</td>
              <td>".$row["reference_to_issue_voucher"]."</td>
              <td>".$row["quantity_issued"]."</td>
              <td>".$row["balance"]."</td>
              <td>".$row["remarks"]."</td>
              <td>".$row["acknowledgement_date"]."</td>
              
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
          challan_No = tr.getElementsByTagName("td")[1].innerText;
          item_date = tr.getElementsByTagName("td")[2].innerText;
          detailed_description = tr.getElementsByTagName("td")[3].innerText;
          name_of_supplier = tr.getElementsByTagName("td")[4].innerText;
          order_no = tr.getElementsByTagName("td")[5].innerText;
          order_date = tr.getElementsByTagName("td")[6].innerText;
          quantity = tr.getElementsByTagName("td")[7].innerText;
          unit_price = tr.getElementsByTagName("td")[8].innerText;
          total_price = tr.getElementsByTagName("td")[9].innerText;
          reference_to_issue_voucher = tr.getElementsByTagName("td")[10].innerText;
          quantity_issued = tr.getElementsByTagName("td")[11].innerText;
          balance = tr.getElementsByTagName("td")[12].innerText;
          remarks = tr.getElementsByTagName("td")[13].innerText;
          console.log(requisition_no, challan_No, item_date, detailed_description, name_of_supplier, order_no, order_date, quantity, unit_price, total_price, reference_to_issue_voucher, quantity_issued, balance, remarks);
          requisition_noEdit.value = requisition_no;
          challan_NoEdit.value = challan_No;
          item_dateEdit.value = item_date;
          detailed_descriptionEdit.value = detailed_description;
          name_of_supplierEdit.value = name_of_supplier;
          order_noEdit.value = order_no;
          order_dateEdit.value = order_date;
          quantityEdit.value = quantity;
          unit_priceEdit.value = unit_price;
          total_priceEdit.value = total_price;
          reference_to_issue_voucherEdit.value = reference_to_issue_voucher;
          quantity_issuedEdit.value = quantity_issued;
          balanceEdit.value = balance;
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
            window.location = `/ims-nitttr-kolkata/edit_SR_IWS.php?delete=${sno}`;
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
          $(document).ready( function () {
          $('#myTable').DataTable();
    } );
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

  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


    
</body>
</html>