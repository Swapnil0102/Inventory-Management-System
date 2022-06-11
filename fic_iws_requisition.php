<?php
 include_once('connection.php');
 error_reporting(0);

// && $_SESSION['username']== "fic_elec" || $_SESSION['username']== "fic_iws"
if(!isset($_SESSION)){ 
  session_start();
  if($_SESSION['loggedin'] && $_SESSION['username']== "fic_iws"){
  } else {
    $_SESSION['status']= false;
    header("Location: login.php");
    exit();
  }
} else {
  if($_SESSION['loggedin'] && $_SESSION['username']== "fic_iws"){
  } else {
    $_SESSION['status']= false;
    header("Location: login.php");
    exit();
  }
  if($_SESSION['loggedin']){
    $username=$_SESSION['username'];
    if($_SESSION['username']){
      $sql= "SELECT `name`, `department_Section_Cell`, `designation` FROM `login` WHERE `username`= '$username'";
      $result = mysqli_query($mysqli, $sql);
      $row = mysqli_fetch_assoc($result);
        $_POST['Name']= $row["name"];
        $_POST['Department/Section/Cell']= $row["department_Section_Cell"];
        $_SESSION['faculty_name']= $row["department_Section_Cell"];
        $_POST['Designation']= $row["designation"];
    // } else if ($_SESSION['username']== "fic_iws"){
    //   $sql= "SELECT `name`, `department_Section_Cell`, `designation` FROM `login` WHERE `username`= '$username'";
    //   $result = mysqli_query($mysqli, $sql);
    //   $row = mysqli_fetch_assoc($result);
    //     $_POST['Name']= $row["name"];
    //     $_POST['Department/Section/Cell']= $row["department_Section_Cell"];
    //     $_POST['Designation']= $row["designation"];
    } else {
    $_SESSION['status']= false;
    header('Location: login.php');
    exit();
    // include_once 'requisition_pdf.php';
  }}
?>
<?php
      if (isset( $_POST['itemno'])){ 
        $_SESSION['index']= $_POST['itemno'];
            header('Location: requisition_iws_submit.php');
            exit();
}}?>



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
    src="https://code.jquery.com/jquery-3.5.1.js" 
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
  


    <!-- features  css -->

  <style>
          body {
        margin: 0;
        font-family: var(--bs-font-sans-serif);
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #f9fafb;
        background-color: #e5e7eb;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
    }
          .table{
            margin:auto;
            width:100%;
            border:3px solid #d1d5db;
            padding:5px;
            float: left;
          }
          table.dataTable {
        width: 100%;
        margin: 0 auto;
        clear: both;
        border-collapse: separate;
        border-spacing: 0;
        float: center;
    }
    table#myTable {
        text-align: -webkit-center;
        column-width: 100px;
    }

    .tablesize{
      height: 30px;
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
                    margin-top: 350px;
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

            <!-- Custom styles for this template -->
            <link href="features.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
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
            login.php">Home</a>
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
 
            <form class="d-flex" form action= "fic_iws_requisition.php" method="POST">
                <input type="submit" class="btn btn-danger" name="logout" value="Logout" >
            </form>
  </nav>






<!-- Webpage Sidebar (Dashboard ) -->
<div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Togglse Menu</span>
        </button>
    </div>
          <h1><a href="" class="logo"></a></h1>
    <ul class="list-unstyled components mb-5">
      <li class="active">
        <a href="fic_iws_requisition.php"><span class="fa fa-home mr-3"></span> IWS Requisition</a>
      </li>
      <li class="active">
          <a href="fic_iws_approval.php"><span class="fa fa-user mr-3"></span> Acknowledge</a>
      </li>
    </ul>


    <div class="wrapper d-xl-inline-flex">
        <div class="mbb-5">
            <h3 class="h6 mb-3"> 
                <button class="btnn" type="submit">Welcome! <br> FIC <br> IWS </button>
            </h3>
        </div>
        </div>


</nav>



 



<!-- Page Content  -->
<!-- <style>
div.container {

  display: flex;
  align-items: center;
  justify-content: center }
div.container6 p {
  margin: 0 }
}
</style> -->

<div class="container m-10">
  <br>
 <div class="inr_top_bar">
	<div class="container">
        <h4> 
            <ull>
            	<a href="fic_electrical.php">  FIC Electrical </a> >
                 <lii><a href="fic_elec_requisition.php"> Requisition </a></lii>
            </ull>
        </h4>
    	</div>
    </div>
    <br>
    <br>
 
  <?php 

if($_SESSION['insertreq']== "iws_inserted"){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Succes</strong> Your request has been proceeded Succesfully "."&nbsp&nbsp"."<a href=".$_SESSION['pdflink']." class='badge badge-success'>PDF Link</a>"
    ."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>" ;  
  } else {
    $_SESSION['insertreq']= "not inserted";
    echo "";
  }

?>

  <div class="container my-4">
  <form action="/ims-nitttr-kolkata/fic_iws_requisition.php" method="post">
    <center>
    <h1>FIC IWS Requisition</h1>
    </center>
    <hr><br>
    <h2>Add New Request</h2><br>
    <!-- <form class="row g-3" action="/ims-nitttr-kolkata/fic_iws_requisition.php" method="POST"> -->
    <!-- <form class="row g-3" action="/ims-nitttr-kolkata/pdf.php" method="POST"> -->

      <div class="col-md-6">
        <label for="exampleInputPassword1" class="form-label"><h5>Name</h5></label>
        <input type="text" class="form-control" id="name_of_person" name="name_of_person" value= "<?php echo $_POST['Name'] ?>" disabled>
      </div><br>

      <div class="col-md-6">
        <label for="exampleInputPassword1" class="form-label"><h5>Department/Section/Cell</h5></label>
        <input type="text" class="form-control" id="department_Section_Cell" name="department_Section_Cell" value= "<?php echo $_POST['Department/Section/Cell'] ?> " disabled>
      </div><br>

      <div class="col-md-6">
        <label for="exampleInputPassword1" class="form-label"><h5>Designation</h5></label>
        <input type="text" class="form-control" id="designation" name="designation" value= "<?php echo $_POST['Designation'] ?>" disabled>
      </div><br>


    <div class="col-md-12">
      <label for="itemno" name="itemno"class="form-label"><h5>No. of items</h5></label>
      <select id="itemno"name="itemno" class="form-select">
       <option selected>Choose...</option>
       <option id=1 value=1>1</option>
       <option id=2 value=2>2</option>
       <option id=3 value=3>3</option>
       <option id=4 value=4>4</option>
       <option id=5 value=5>5</option>
       <option id=6 value=6>6</option>
       <option id=7 value=7>7</option>
       <option id=8 value=8>8</option>
       <option id=9 value=9>9</option>
       <option id=10 value=10>10</option>
       <option id=11 value=11>11</option>
       <option id=12 value=12>12</option>
      </select>
      <!-- <input type="submit" name="itemno" id="itemno" action="/ims-nitttr-kolkata/fic_iws_requisition.php" formvalue="Submit" /> -->
      
    </div>  

        <!-- <div class="col-md-6">
          <label for="exampleInputPassword1" class="form-label">ALAKH</label>
          <input type="text" class="form-control" id="quantity" name="quantity">
        </div> -->

      <?php
      //  $x++;}
    // } 
       ?>

      <div class="mb-3">
      </div>
      <!-- <a class="btn btn-primary btn-lg" href="/ims-nitttr-kolkata/requisition_submit.php" name="edit" value="Enter" role="button">Submit</a> -->
      <input type="submit" class="btn btn-primary btn-lg"  action="/ims-nitttr-kolkata/fic_iws_requisition.php" formvalue="Submit" value="Enter"/>


      <!-- <button type="submit" class="btn btn-primary" name="submit">Submit</button> -->
      
      <!-- <button type="submit" class="btn btn-primary" formaction="pdf.php" name="submit">Submit</button> -->

    </form>
    <br>

   <br>
    
    
    <h2>List of Requisitions</h2>
 
    <div class="table">
    <br>
    <table class="table" assign="center" id="myTable">
        <thead class="table-dark">
          <tr>
          <th scope="col">Sl. No</th>
            <th scope="col">Requisition No</th>
            <th scope="col">Category of Indenter</th>
            <th scope="col">Date of Requisitions</th>
            <th scope="col">Requisition detail</th>
            <th scope="col">Date of Isuue</th>
            <th scope="col">Status</th>
            <th scope="col">Remarks</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $ok=$_SESSION['faculty_name'];

            $sql = "SELECT * FROM requisition_pdf WHERE `faculty_name` = '$ok'";
            $result = mysqli_query($mysqli, $sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
              if(!($row["remarks"]== NULL)){
                $status= "Issued";
              } else {
                $status= "Pending";
              }
              $sl_no = $sl_no + 1;
              echo "<tr>
              <th scope='row'>". $sl_no . "</th>
              <td>".$row["requisition_no"]."</td>
              <td>".$row["indenter"]."</td>
              <td>".$row["date"]."</td>
              <td> <a href=".$row["pdf_path"]." class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>PDF Link</a></td>
              <td>".$row["date_of_issue"]."</td>
              <td>".$status."</td>
              <td>".$row["remarks"]."</td>
              </tr>";
            } 

            // <td> <a href=".$row["pdf_path"]."> <button  class='btn btn-secondary ' value='PDF'>PDF</button></a></td>
            ?>
        </tbody>
      </table>

      
      </div>
  <div class="container my-4">

     
    </div>
    

    </div>
    </div>

    </div>




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
   
  
    <script>
        $(document).ready(function() {
        $('#myTable').DataTable( {
            "scrollY":        "300px",
            "scrollCollapse": true,
            "paging":         false
        } );
    } );
    </script>
     <script src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  </script>


  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

</body>
</html>