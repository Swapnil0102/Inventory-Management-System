
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

$sql2= "SELECT * FROM `issue_recurring` ORDER BY sno DESC LIMIT 1";
  $result1 = mysqli_query($con, $sql2);
  $row = mysqli_fetch_assoc($result1);
  $last_si_no= $row["sno"];

$sql = "SELECT * FROM `issue_recurring` WHERE `sno` = '$last_si_no'";

$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0){
  $row=mysqli_fetch_array($res);
  $item_name=$row['item_name'];
  $date_of_issue=$row['date_of_issue'];
  $to_whom_issued=$row['to_whom_issued'];
  $quantity_issued=$row['quantity_issued'];
  $accumulation=$row['accumulation'];
  $ref_if_any=$row['ref_if_any'];
  $remarks=$row['remarks'];


  $html="<h1> NITTTR KOLKATA</h1>";
  $html.="<h6>FC Block,Sector 3,Saltlake City,Kolkata-700106</h6>";
  $html.="<h2>Faculty and Others - Issue</h2>";
  $html.= '<hr>';
  
   $html.= '<strong> Item Name : </strong>'.$item_name;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Date Of Issue  : </strong>'.$date_of_issue;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> To Whom Issued  : </strong>'.$to_whom_issued;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Quantity Issued  : </strong>'.$quantity_issued;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Accumulation : </strong>'.$accumulation;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Ref If Any : </strong>'.$ref_if_any;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';
   $html.= '<strong> Remarks : </strong>'.$remarks;
   $html.= '&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; <br><br> ';

}else{
	$html="Data not found";
}


$mpdf=new Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='Approval_Faculty/'.time().'.pdf';
$pdf_link = "<a href='$file'/a>";
// $mpdf->output($file,'I');
$mpdf->output($file,'F');



$sql="INSERT INTO `faculty_approval`(`pdf_path`) 
VALUES ('$file')";


// Sql query to be executed
$result = mysqli_query($con, $sql);
if($result){ 
  $insert= true;
  header('Location: edit_IR.php');
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
