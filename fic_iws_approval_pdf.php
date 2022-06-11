<?php
    if (isset($_POST['logout'])){
      header("Location: login.php");
      session_unset();
      session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS-NITTTR KOLKATA</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body>
<?php
session_start();
require('vendor/autoload.php');
$con=mysqli_connect('localhost','root','','my_ims');

$sql2= "SELECT * FROM `stock_issue_recurring_iws` ORDER BY sno DESC LIMIT 1";
        $result1 = mysqli_query($con, $sql2);
        $row = mysqli_fetch_assoc($result1);
        $last_si_no= $row["sno"];
        

$sql = "SELECT * FROM `stock_issue_recurring_iws` WHERE `sno` = '$last_si_no'";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0){
  $row=mysqli_fetch_array($res);
  $requisition_no= $row['requisition_no'];
  $ent_date=$row['ent_date'];
  $challan_No=$row['challan_No'];
  $item_date=$row['item_date'];
  $detailed_description=$row['detailed_description'];
  $name_of_supplier=$row['name_of_supplier'];
  $order_no=$row['order_no'];
  $order_date=$row['order_date'];
  $quantity=$row['quantity'];
  $unit_price=$row['unit_price'];
  $total_price=$row['total_price'];
  $reference_to_issue_voucher=$row['reference_to_issue_voucher'];
  $quantity_issued=$row['quantity_issued'];
  $balance=$row['balance'];
  $remarks=$row['remarks'];


  $html="<h1> NITTTR KOLKATA</h1>";
  $html.="<h6>FC Block,Sector 3,Saltlake City,Kolkata-700106</h6>";
  $html.="<h2>FIC IWS - Approval</h2>";
  $html.= '<hr>';
  
  //  $html.= '<strong> ent_date : </strong>'.$ent_date;
  //  $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  ';
  //  $html.= '<strong> challan_No : </strong>' $challan_No ;
  //  $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;    &nbsp; &nbsp; &nbsp; &nbsp; ';
  //  $html.= '<strong> Item Date : </strong>'.$item_date. '<br><br>';

  $html.= '<strong> Requisition No : </strong>'.$requisition_no;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> '; 
  $html.= '<strong> Entry Date : </strong>'.$ent_date;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Challan No.  : </strong>'.$challan_No;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Item Date  : </strong>'.$item_date;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Detailed Description  : </strong>'.$detailed_description;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Name of supplier : </strong>'.$name_of_supplier;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Order No : </strong>'.$order_no;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Order Date : </strong>'.$order_date;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Quantity : </strong>'.$quantity;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Unit Price : </strong>'.$unit_price;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Total Price : </strong>'.$total_price;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Reference to issue voucher : </strong>'.$reference_to_issue_voucher;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Quantity Issued : </strong>'.$quantity_issued  ;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';

   $html.= '<strong> Balance : </strong>'.$balance;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';

   $html.= '<strong> Remarks : </strong>'.$remarks. '<br><br>';
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  ';


	// $html.='<style></style><table class="table" cellpadding="15" cellspacing="15" style="page-break-before : always;">';
	// 	$html.='<tr><td>Entry Date</td><td>Challan No.</td><td>Item Date</td><td>Detailed Description</td><td>Name of Supplier</td><td>Order No</td><td>Order Date
  //   </td><td>Quantity</td><td>
  //   Unit Price</td><td>Total Price</td><td>Reference to Issue Voucher</td><td>Quantity Issued</td><td>Balance</td><td>Remarks</td></tr>';
  //   $sql = "SELECT * FROM `stock_issue_recurring_iws` WHERE `sno` = '$last_si_no'";
  //   $result=mysqli_query($con,$sql);
	// 	while($row=mysqli_fetch_assoc($result)){
  //     $_SESSION['row']=$row;
	// 		$html.='<tr><td>'.$row['ent_date'].'</td><td>'.$row['challan_No'].'</td><td>'.$row['item_date'].'</td><td>'.$row['detailed_description'].'</td><td>'.$row['name_of_supplier'].'</td><td>'.$row['order_no'].'</td><td>'.$row['order_date'].'</td><td>'.$row['unit_price'].'</td><td>'.$row['total_price'].'</td><td>'.$row['reference_to_issue_voucher'].'</td><td>'.$row['quantity_issued'].'</td><td>'.$row['balance'].'</td><td>'.$row['remarks'].'</td></tr>';
	// 	$date=$row['date'];
  //   }
	// $html.='</table>';
}else{
	$html="Data not found";
}


$mpdf=new Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='Approval_IWS/'.time().'.pdf';
$pdf_link = "<a href='$file'/a>";
// $mpdf->output($file,'I');
$mpdf->output($file,'F');



$sql="INSERT INTO `fic_approval_iws`(`pdf_path`) 
VALUES ('$file')";


// Sql query to be executed
$result = mysqli_query($con, $sql);
if($result){ 
  $insert= true;
  header('Location: edit_SR_IWS.php');
}
else{
	echo "The record was not inserted successfully because of this error ---> ". mysqli_error($con);
  }


//D
//I
//F
//S$file='D:\requisitions/'.time().'.pdf';
?>
<style>
 
        </style>
</body>
</html>
