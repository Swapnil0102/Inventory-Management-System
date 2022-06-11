<?php
  $dbhost= "localhost";
  $dbuser= "root";
  $dbpass= "";
  $dbname= "my_ims";
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if($mysqli->connect_errno){
      echo "Error Occured" . $mysqli->connect_error;
    }

require "FPDF/fpdf.php";

class mypdf extends FPDF{
    function header(){
      //  $this->Image('.png', 10,6);
        $this->SetFont('Arial', 'B', 25);
        $this->Cell(400, 5, 'Stock Non Recurring',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',15);
        $this->Cell(400, 10 , 'NITTTR, Kolkata',0,0, 'C');
        $this->Ln(20);
    }
    
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0, 0,'C');
    }

    function headerTable(){
        $this->SetFont('Times', 'B', 12);
        $this->Cell(20,10,'sno', 1, 0, 'C');
        $this->Cell(30,10,'Entry Date', 1, 0, 'C');
        $this->Cell(25,10,'Challan No', 1, 0, 'C');
        $this->Cell(20,10,'Item Date', 1, 0, 'C');
        $this->Cell(50,10,'Detailed Description', 1, 0, 'C');
        $this->Cell(40,10,'Name of Supplier', 1, 0, 'C');
        $this->Cell(20,10,'Order No', 1, 0, 'C');
        $this->Cell(25,10,'Order Date', 1, 0, 'C');
        $this->Cell(20,10,'Quantity', 1, 0, 'C'); 
        $this->Cell(20,10,'Unit Price', 1, 0, 'C');
        $this->Cell(20,10,'Total Price', 1, 0, 'C');
        $this->Cell(50,10,'Reference to Issue Voucher', 1, 0, 'C');
        $this->Cell(30,10,'Quantity Issued', 1, 0, 'C');
        $this->Cell(20,10,'Balance', 1, 0, 'C');
        $this->Cell(20,10,'Remarks', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable($mysqli){
        $this->SetFont('Times', '', 12);
        $stmt = $mysqli->query('select * from stock_recurring');
        while($row= $stmt->fetch(PDO::FETCH_OBJ)){
        // $sql = "SELECT * FROM stock_recurring";
        // $result = $mysqli->query($sql);
        // $sno = 0;
        // while($row = $mysqli_result->fetch_assoc()){
            $this->Cell(20,10,$row->sno, 1, 0, 'C');
            $this->Cell(30,10,$row->Entry_Date, 1, 0, 'L');
            $this->Cell(25,10,$row->Challan_No, 1, 0, 'L');
            $this->Cell(20,10,$row->Item_Date, 1, 0, 'L');
            $this->Cell(50,10,$row->Detailed_Description, 1, 0, 'L');
            $this->Cell(40,10,$row->Name_of_Supplier, 1, 0, 'L');
            $this->Cell(20,10,$row->Order_No, 1, 0, 'L');
            $this->Cell(25,10,$row->Order_Date, 1, 0, 'L');
            $this->Cell(20,10,$row->Quantity, 1, 0, 'L'); 
            $this->Cell(20,10,$row->Unit_Price, 1, 0, 'L');
            $this->Cell(20,10,$row->Total_Price, 1, 0, 'L');
            $this->Cell(50,10,$row->Reference_to_Issue_Voucher, 1, 0, 'L');
            $this->Cell(30,10,$row->Quantity_Issued, 1, 0, 'L');
            $this->Cell(20,10,$row->Balance, 1, 0, 'L');
            $this->Cell(20,10,$row->Remarks, 1, 0, 'L');
            $this->Ln();

        }

    }



}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A3', 0);
$pdf->headerTable();
$pdf->viewTable($mysqli);
$pdf->Output();