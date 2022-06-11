<?php
session_start();
if($_SESSION['loggedin'] && $_SESSION['username']== "admin"){
} else {
  $_SESSION['status']= false;
  header("Location: login.php");
  exit();
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
                .container {
                    padding: 0 10px;
                    box-sizing: border-box;
                }
                .container {
                    width: 100%;
                    padding: 0 7%;
                    display: inline-block;
                    font-family: Arial;
                    margin-right: auto;
                    margin-left: auto;
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
            <a class="nav-link active" aria-current="page" href="login.php">Home</a>
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
 
        <form class="d-flex" form action= "admin.php" method="POST">
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
            <a href="report_SNR.php"><span class="fas fa-file-pdf mr-3"></span>  Stock Non Recurring</a>
        </li>
        <li class="active">
            <a href="report_SR.php"><span class="fas fa-file-pdf mr-3"></span> Stock Recurring</a>
        </li>
        <li class="active">
            <a href="report_IR.php"><span class="fas fa-file-pdf mr-3"></span> Issue Recurring </a>
        </li>
        <li class="active">
            <a href="report_CSR.php"><span class="fas fa-file-pdf mr-3"></span> Current Stock </a>
        </li>
        <li class="active">
            <a href="report_IWS.php"><span class="fas fa-file-pdf mr-3"></span> IWS Recurring </a>
        </li>
        <li class="active">
            <a href="report_ER.php"><span class="fas fa-file-pdf mr-3"></span> Electrical Recurring </a>
        </li> <li class="active">
            <a href="report_requisition.php"><span class="fas fa-file-pdf mr-3"></span> Requisitions</a>
        </li> 
        
        </ul>

    <div class="wrapper d-xl-inline-flex">
    <div class="mbb-5">
        <h3 class="h6 mb-3"> 
            <button class="btnn" type="submit">Welcome <br> Admin</button>
        </h3>
    </div>
    </div>
</nav>



 



<!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">

<div class="inr_top_bar">
	<div class="container">
        <br>
        <a href="admin.php"><h3>Admin ></h3></a>
            <!-- <h3>Home</h3> -->
        <!-- <a href="login.php"><h3>Home</h3></a> -->
            	<!-- <li><i class="fa fa-home"></i></li> -->
                 <!-- <li><a href="academicCentresCells.php">Centres and Cells</a></li> -->
            
    	</div>
    </div>

<!-- <h2 class="mb-4">Sidebar #04</h2> -->
<!-- <h2 class="pb-2 border-bottom">Columns with icons</h2> -->
                <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

                <div class="feature col">
                    <div class="container p-3 my-3 border "><style>.div{
                        background-color: greenyellow;}</style>
                 <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                    </div>
                    <a href="report_SNR.php" class="icon-link">
                    <h2>Stock Non Recurring</h2>
                    </a>
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                </div>
                </div>
                <div class="feature col">
                    <div class="container p-3 my-3 border">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                    </div>
                    <a href="report_SR.php" class="icon-link">
                    <h2>Stock Recurring</h2>
                </a>
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                </div>
                </div>
                <div class="feature col">
                    <div class="container p-3 my-3 border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                    </div>
                    <a href="report_IR.php" class="icon-link">
                    <h2>Issue Recurring</h2>
                </a>
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                </div>
            </div>
                <div class="feature col">
                    <div class="container p-3 my-3 border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                    </div>
                    <a href="report_CSR.php" class="icon-link">
                    <h2>Current Stock Recurring</h2>
                </a>
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>

                </div>
                </div>
                <div class="feature col">
                    <div class="container p-3 my-3 border">
                                  <!-- <span class="border border-dark"></span> -->
                                  <i class="fas fa-users" style='font-size:68px'></i>
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
                    </div>
                    <a href="report_IWS.php" class="icon-link">
                    <h2>IWS Recurring (Stock/Issue)</h2>
                </a>
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>

                </div>
                </div>


                    

                <div class="feature col">
                    <div class="container p-3 my-3 border">
                        <!-- <span class="border border-dark"></span> -->
                    <i class="fas fa-users" style='font-size:68px'></i>
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
                    </div>
                    <a href="report_ER.php" class="icon-link">
                    <h2>Electrical Recurring (Stock/Issue)</h2> <br>
                    </a>    
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                    </div>
                </div>

                <div class="feature col">
                    <div class="container p-3 my-3 border">
                    <!-- <span class="border border-dark"></span> -->
                    <i class="fas fa-users" style='font-size:68px'></i>
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#toggles2" />
                        </svg>
                    </div>
                    <a href="report_requisition.php" class="icon-link">
                        <h2>Requisitions</h2> <br>
                    </a>
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#chevron-right" />
                    </svg>
                    </div>
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