<?php
    include('connection.php');
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

</head>
<style>
.flogo {
      text-align: center;
    }

#inventorylogo {
  width: 25%;
  height: auto;
}
</style>
<body>
    <!-- MODAL -->
<div class="modal" id="myModal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <p>This is the content of the modal.</p>    
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"  data-dismiss="modal"> Close</button>
            </div>

        </div>
    </div>
</div>
<!-- MODAL -->

<div class="container-fluid">
<div class="flogo">
    <img  src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
</div>
    <div class="d-flex flex-row gap-2 m-2">
        <div class="d-flex align-items-center flex-row gap-2 col-sm-2">
            <span><strong>Name:</strong></span>
            <input class="text-center form-control" placeholder="Input Name" id="inputName" type="text">
        </div>
    <div class="d-flex align-items-center flex-row gap-2 col-sm-2">
        <span><strong>Branch:</strong></span>
        <select id="branch" class="form-select text-center">
            <option value="">All</option>
            <option value="Head Office">Head Office</option>
            <option value="Magallanes">Magallanes</option>
            <option value="Manggahan">Manggahan</option>
            <option value="Maragondon">Maragondon</option>
            <option value="Noveleta">Noveleta</option>
            <option value="Poblacion">Poblacion</option>
            <option value="Ternate">Ternate</option>
        </select>
    </div>  
</div>



<div>


</div>
<div   id="result" class="responsive-table">
</div>

<span style="margin-top:10px;" class="loader"></span>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> -->

<!-- Custom -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script> -->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script>
$(document).ready(function(){

   // Disable search button by default
   $("#searchButton").prop("disabled", true);

   // ✅ ADDED: Restore saved branch value after page reload
   var savedBranch = localStorage.getItem('selectedBranch');
   if (savedBranch !== null) {
       $('#branch').val(savedBranch);
   }

   // ✅ ADDED: Always trigger submitData on load to populate results
   submitData();

$('#inputName').off('keyup').on('keyup', function() {
    submitData();
})

$('#branch').change(function(){
    // ✅ ADDED: Save selected branch to localStorage whenever it changes
    localStorage.setItem('selectedBranch', $(this).val());
    submitData()
});

$('.btnBack').click(function(){
    window.location.href = "payearnings.php";   

});

function submitData(){
    var query = $('#inputName').val();
    var branch = $('#branch').val();
    console.log('Query:', query, 'Branch:', branch);

    // Clear previous results
    $('#searchResults').empty();
    $('#result').empty();
    $.ajax({
        url: 'pay-readearning.php',
        type: 'post',
        data: {
            query: query,
            branch: branch
        },
        success: function(response){
            $('#result').html(response);
        }
    });
}
// SAVE BUTTON ~ TEST 
$.ajax({
url: "pay-updateBalance.php?",
type: "POST",
success: function(data) {
},
error: function() {
    console.log('Failed');
    alert('Failed');
}
});

$(document).on('click', '.delete-link', function(e){
    e.preventDefault(); // Prevent the default link behavior
    var href = $(this).attr('href');
    if (confirm('Are you sure you want to delete this record?')) {
        window.location.href = href;
    }
});

});

$(document).on('click', '#deleteDeduct', function(e) {

<?php if($_SESSION['department'] == '1' || $_SESSION['department'] == '2'|| $_SESSION['department'] == '5'){ ?>
    e.preventDefault();
    var idDeduct = $(this).data('id');
    var row = $(this).closest('tr');
    console.log(idDeduct);
    var confirmation = confirm("Are you sure you want to delete this deduction?");

    if (confirmation) {  $.ajax({
        url: 'pay-deletededuction.php',
        method: 'POST',
        data: {
        id : idDeduct
        },
        success: function(response) {
          console.log('Data deleted successfully');
          console.log(response);
          row.hide();
          
        },
        error: function(xhr, status, error) {
          console.error('Error updating data: ', error);
        }
      });
      e.preventDefault();
    }
   
<?php } ?>
});

$(document).on('click', '#deletePay', function(e) {

<?php if($_SESSION['department'] == '1' || $_SESSION['department'] == '2'|| $_SESSION['department'] == '5'){ ?>

    e.preventDefault();
    var idPay = $(this).data('id');
    var row = $(this).closest('tr');
    var tablepay = document.getElementById("otherpaytable");
    console.log(idPay);
    var confirmation = confirm("Are you sure you want to delete this payment entry?");

    if (confirmation) {  $.ajax({
        url: 'pay-deleteother.php',
        method: 'POST',
        data: {
        id : idPay
        },
        success: function(response) {
       
          row.hide();
          e.preventDefault();
        },
        error: function(xhr, status, error) {
          console.error('Error updating data: ', error);
        }
      });
    }

<?php } ?>
});
</script>



<style>
.custom-modal-body {
    max-width:1500px;
   
}
</style>
</body>
</html>