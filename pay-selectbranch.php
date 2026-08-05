<?php
  include('connection.php');

  $empid = $_SESSION['employeeId'];
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="devCiao">
<meta name="description" content="A payslip for OUR Bank.">
<link rel="icon" href="images/favicon.ico">

<title>Online Payslip</title>

<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

</head>

<body>
<div class="container-fluid">
    <h1>Payslip Report <smalL class="text-muted">HRIS SYSTEM</small></h1>
    <div class="row row-cols-1 row-cols-md-3 ">


<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/Head.jpg" class="card-img-top" alt="...">
    <div class="card-body text-center">
      <a href="pay-Report.php?branch=Head Office" class="btn btn-secondary" type="button">Head Office</a>
    </div>
  </div>
</div>
<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/magallanes.jpg" class="card-img-top" alt="...">
    <div class="card-body text-center">
      <a href="pay-Report.php?branch=Magallanes" class="btn btn-secondary" type="button">Magallanes</a>
    </div>
  </div>
</div>
<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/manggahan.jpg" class="card-img-top" alt="...">
    <div class="card-body text-center">
    <a href="pay-Report.php?branch=Manggahan" class="btn btn-secondary" type="button">Manggahan</a>
    </div>
  </div>
</div>
<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/maragondon.jpg" class="card-img-top" alt="...">
    <div class="card-body text-center">
    <a href="pay-Report.php?branch=Maragondon" class="btn btn-secondary" type="button">Maragondon</a>
    </div>
  </div>
</div>
<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/noveleta.jpg" class="card-img-top" alt="...">
    <div class="card-body text-center">
    <a href="pay-Report.php?branch=Noveleta" class="btn btn-secondary" type="button">Noveleta</a>
    </div>
  </div>
</div>
<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/poblacion.jpg" class="card-img-top" alt="...">
    <div class="card-body text-center">
    <a href="pay-Report.php?branch=Poblacion" class="btn btn-secondary" type="button">Poblacion</a>
    </div>
  </div>
</div>
<div class="col mb-4">
  <div class="card h-100 shadow">
    <img src="images/branches/ternate.jpeg" class="card-img-top" alt="...">
    <div class="card-body text-center">
    <a href="pay-Report.php?branch=Ternate" class="btn btn-secondary" type="button">Ternate</a>
    </div>
  </div>
</div>
</div>  
</div>
</body>

 <!-- jquery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <!-- Custom -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</html>