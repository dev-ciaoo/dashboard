<?php
  include('connection.php');
  $branchName = $_GET['branch'];
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
<body>
    <!-- MODAL -->
<div class="modal" id="myModal">
    <div class="modal-dialog ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4>
            </div>

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


<button class="btn btn-secondary btn-md btnBack">Back</button>  
<div class="container">
    <div class="d-flex justify-content-center align-items-center"><h3><?php echo $branchName; ?></h3></div>
    <input id="branch" type="hidden" value="<?php echo $branchName; ?>">
    <div class="d-flex flex-row gap-2 m-2">
    <span>Name: </span>
    <input id="inputName" type="text">
    <button id="searchButton" class="btn btn-success" disabled>Search</button>
</div>
<div>
            <?php require_once('payreadearning.php') ?>
   
</div>
<div >
<div class="pagination" id="pagination"></div>
</div>
</div>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){

   // Disable search button by default
   $("#searchButton").prop("disabled", true);

$('#inputName').keyup(function(){
    var input = $(this).val(); // Get the value of the input field

    // Check if input is empty
    if(input.trim() === ""){
        // If input is empty, disable the search button
        $("#searchButton").prop("disabled", true);
    } else {
        // If input is not empty, enable the search button
        $("#searchButton").prop("disabled", false);
    }

    if(event.which === 13){
            // Trigger a click event on the button
            $('#searchButton').click();
        }
});

    $('#searchButton').click(function(){
        var query = $('#inputName').val();
        var branch = $('#branch').val();

        $.ajax({
            url: 'payreadearning.php',
            type: 'post',
            data: {
                query: query,
                branch : branch},
            success: function(response){
                $('#searchResults').html(response);
            }
        });
    });

    $('.btnBack').click(function(){
        window.location.href = "payearnings.php";   

    });

});
</script>
<style>
.custom-modal-body {
    max-width:1500px;
   
}
</style>
</body>
</html>
