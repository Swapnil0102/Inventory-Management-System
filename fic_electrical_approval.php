<?php

error_reporting(0);
session_start();
  $dbhost= "localhost";
  $dbuser= "root";
  $dbpass= "";
  $dbname= "my_ims";
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if($mysqli->connect_errno){
      echo "Error Occured" . $mysqli->connect_error;
    }

    if($_SESSION['loggedin'] && $_SESSION['username']== "fic_elec"){
    } else {
      $_SESSION['status']= false;
      header("Location: login.php");
      exit();
    }
    
?>


<?php
$delete=false;


if(isset($_POST['submit']))
{
 
  if(isset($_POST['check'])){
        // $remarks = $_POST["remarks"];
        $date = $_POST["date"];
        $checked_array=$_POST['check'];
        // $requisition_no=$_SESSION['requisition_no'];
        // $indenter1= $_SESSION['indenter'];
        // echo $_SESSION['indenter'];s
        

        foreach ($_POST['check'] as  $value) {
        
          $sql = "SELECT * FROM `requisition_pdf` WHERE requisition_no='$value'";
        $result1 = mysqli_query($mysqli, $sql);
        $row1 = mysqli_fetch_array($result1);
        $indenter=$row1['indenter'];
        $requisition_no=$row1['requisition_no'];
        // echo $indenter;
        // echo $date;


        if($indenter== "FIC IWS"){
          $sql1 = "UPDATE `stock_issue_recurring_iws` SET `acknowledgement_date`='$date' WHERE `requisition_no`='$value'";
          $result1 = mysqli_query($mysqli, $sql1);
          // if($result1){
          //   echo "okay1";
          // } else{
          //   echo "not okay1";
          //   }
        } elseif($indenter== "FIC Electrical"){
          $sql1 = "UPDATE `stock_issue_recurring_electrical` SET `acknowledgement_date`='$date'  WHERE `requisition_no`='$value'";
          $result2 = mysqli_query($mysqli, $sql1);
          // if($result2){
          //   echo "okay2";
          // } else{
          //   echo "not okay2";
          //   }
        
        } else {}
        
       

        $sql1 = "UPDATE `requisition_pdf` SET `approval`= 'Approved' WHERE requisition_no='$value'";
        $result = mysqli_query($mysqli, $sql1);
        if($result){
        } else{
          echo "not okay";
          }
        // $sql = "UPDATE `storekeeper_pdf` SET `bin`= '0' WHERE pdf_path='$value'";
        // $result = mysqli_query($mysqli, $sql);
        // if($result){ 
        //   $delete= true;
        //   }
        //   else{
        //   echo "Successfully Updated ---> ". mysqli_error($mysqli);
        //   }
        }
    }
}
?>



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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

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
            <a class="nav-link active" aria-current="page" href="
            p">Home</a>
            <!-- <a class="nav-link" href="login.php">Home</a> -->
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
 
            <form class="d-flex" form action= "fic_electrical_approval.php" method="POST">
                <input type="submit" class="btn btn-danger" name="logout" value="Logout" >
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
    <a href="fic_elec_requisition.php"><span class="fa fa-home mr-3"></span> Electrical Requisition </a>
  </li>
  <li class="active">
      <a href="fic_electrical_approval.php"><span class="fa fa-user mr-3"></span> Acknowledge </a>
  </li>
</ul>


<div class="wrapper d-xl-inline-flex">
    <div class="mbb-5">
        <h3 class="h6 mb-3"> 
            <button class="btnn" type="submit">Welcome! <br> FIC <br> Electrical </button>
        </h3>
    </div>
    </div>


</nav>






<div class="container m-10">
<br>
 <div class="inr_top_bar">
	<div class="container">
        <h4> 
            <ull>
            	<a href="fic_electrical.php">  FIC Electrical </a> >
                 <lii><a href="fic_electrical_approval.php"> FIC Electrical Acknowledge </a></lii>
            </ull>
        </h4>
    	</div>
    </div>
    <br> <br>
<form action="/ims-nitttr-kolkata/fic_electrical_approval.php" method="post">
 
<div class="container my">

<?php 
if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Succes</strong> The request has been approved Succesfully"
    ."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>" ;  
  } else {
  }
?>

  <br>
    <center>
      <h1>Acknowledge</h1>
    </center>
    </div>
    <div class="container my-4">
        <div class="container">

          <table class="table" id="myTable">
            <thead class="table-dark">
              <tr>
                <th scope="col">Sl.No</th>
                <th scope="col">Requisition No</th>
                <!-- <th scope="col">Category of Indenter</th> -->
                <th scope="col">Date of Requisitions</th>
                <th scope="col">Date of Issue</th>
                <th scope="col">Acknowledgement Date</th>
                <th scope="col">Remarks</th>
                <th scope="col">CheckBox</th>
                
              </tr>
            </thead>
            <tbody>
              <?php

            $sql = "SELECT * FROM `requisition_pdf` WHERE `approval` =  'Not Approved' && `indenter` =  'FIC Electrical'  ORDER BY `sno` DESC LIMIT 100 ";
            $result = mysqli_query($mysqli, $sql);
            $sno = 0;
            
            while($row = mysqli_fetch_assoc($result)){
              $_SESSION['requisition_no'] = $row["requisition_no"];
              // $_SESSION['indenter'] = $row["indenter"];
              
              $sno = $sno + 1;
              echo "<tr>
              <th scope='row'>". $sno . "</th>
              <td>".$row["requisition_no"]."</td>
              <td>".$row["date"]."</td>
             <td>".$row["date_of_issue"]."</td>
                          
            ";
            

            ?>
          <td>
          <div class="form-check">
              <div class="form-check-input" name="date" >
              <input type="date" id="dates" name="date">
              </div>
              </div>
          </td>

          <?php
             echo "<td>".$row["remarks"];
            ?>

             <td>
            <div class="container my-4">
                <div class="form-check">
              <input class="form-check-input" type="checkbox" name="check[]" value ="<?php echo $row["requisition_no"];?>">
              <label class="form-check-label" for="flexCheckChecked">
                Checkout
              </label>
            </div>
            </div>
          </td>

          
          </tr>
          <?php }  ?>

            </tbody>
          </table>


          </div>
          </div>
      <div class="container my-4">
        <center>
          <div>
              <input type ="submit" class="btn btn-primary btn-lg" name="submit" value="Enter"/>
          </div>
        </center>
      </div> 
     <hr><br>
   




      </div> 
      </form>
      </div> 


<!-- footer -->
<footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">
      <br>
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
    
  
    <br>
      </section><br>
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