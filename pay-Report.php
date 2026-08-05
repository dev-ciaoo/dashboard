<?php
  include('connection.php');
  $branchName = $_GET['branch'];

$sql = "SELECT * FROM pay_selecteddate GROUP BY date ORDER BY STR_TO_DATE(date, '%M %e, %Y') ASC";
$result = $con->query($sql);

$options = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
  } else {
    echo "0 results";
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="devCiao">
    <meta name="description" content="A payslip for OUR Bank.">
    <link rel="icon" href="images/favicon.icon">

    <title>Online Payslip</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
 .custom-icon {
        color: #007BFF; /* Bootstrap primary color */
        font-size: 2em; /* Increase the size of the icon */
    }
    .custom-icon2 {
        color: red; /* Bootstrap primary color */
        font-size: 2em; /* Increase the size of the icon */
    }
    
</style>
<body>
<button class="btn btn-secondary btn-md btnBack">Back</button>  
<div class="container">
    <div id="pLogo">
        <img style="display:block;" src="logo/logo-full.png" id="payLogo">
    </div>
      <div class="payslip-form">
        <div class="align-items-center justify-content-center form-floating inputFields">
            <div  class="mb-2 input-group form-floating inputFields">
                <select onchange="validate(this)" name="selectDate" id="selectDate" class="d-flex text-center align-items-center justify-content-center form-control" aria-describedby="button-addon2">
                <option value="" selected disabled>-- Select Date --</option>
                <?php
                foreach ($options as $option): ?>
                    <option value="<?php echo $option['selectedDate']; ?>"><?php echo $option['date']; ?></option>
                <?php endforeach; ?>
    
                </select>
                <a class="btn btn-outline-secondary pr-5 d-flex align-text-center" type="button" id="button-addon2"  data-bs-toggle="modal" data-bs-target="#addDate"><i class="fas fa-calendar-plus custom-icon"></i></a>
                <a class="btn btn-outline-secondary d-flex align-text-center" type="button" id="button-addon3"  data-bs-toggle="modal" data-bs-target="#deleteDate"><i class="fas fa-calendar-minus custom-icon2"></i></a>
            </div>
            <select style="padding-right:120px;"onchange="validate(this)" name="Sorting" id="Sorting" class="mb-2 d-flex text-center align-items-center justify-content-center form-control">
              <option value="" selected disabled>-- Sort By --</option>
              <option value="employeeId">ID</option>
              <option value="Name">Name</option>
            </select>   
           <input style="padding-right:120px;" readonly id="branchname" type="text" value ="<?php echo $branchName; ?>" class="mb-2 d-flex text-center align-items-center justify-content-center form-control" ></input>     
        </div>
        <div  class="form-floating inputFields">
            <input type = "" class="mb-2  form-control" name="startdateoutput" id="startdateoutput"></input>
            <label for ="startdateoutput">Start Date </label>
        </div>
        <div  class="form-floating inputFields">
            <input readonly type = "" class="mb-2 form-control" name="enddateoutput" id="enddateoutput"></input>
            <label for ="enddateoutput">End Date </label>
        </div>
        
        <div  class="form-floating inputFields">
            <input type = "" class="mb-2  form-control" name="payPeriod" id="payPeriod"></input>
            <label for ="payPeriod">Pay Period </label>
        </div>
        <div class= "m-3 container reports">
        
        </div>

</div>
</body>

<!-- MODAL -->
<div  class="modal" id="addDate">
  <div id="modal-dialog1" class="modal-dialog">
      <div id="modal-content1" class="modal-content">

          <!-- Modal Header -->
          <div  id="modal-header1" class="modal-header">
              <h4 id="modal-title1" class="modal-title">Add Date</h4>
          </div>

          <!-- Modal Body -->
          <div id="modal-body1" class="gap-2 modal-body d-flex flex-column align-items-center justify-content-start">
            <div class="input-group">
                <span class="input-group-text">Date :</span>
                <input value="" required class="form-control" name="dateadded" id="dateadded" type="date">
            </div>
            <div class="input-group">
                <span class="input-group-text">Selected Date :</span>
                <input value="" required class="form-control" name="selecteddate" id="selecteddate" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Start Date :</span>
                <input value="" class="form-control" name="startdateadded" id="startdateadded" type="date">
            </div>
            <div class="input-group">
                <span class="input-group-text">End Date :</span>
                <input value="" required class="form-control" name="enddateadded" id="enddateadded" type="date">
            </div>
          </div>

          <!-- Modal Footer -->
          <div  id="modal-footer1" class="modal-footer">
              <button type="button" class="btn btn-primary btn-md addDate-btn">Save</button>
              <button type="button" class="btn btn-danger close-btn" data-dismiss="#addDate">Close</button> 
          </div>

      </div>
  </div>
</div>
<!-- MODAL -->

<!-- MODAL -->
<div  class="modal" id="deleteDate">
  <div id="modal-dialog2" class="modal-dialog">
      <div id="modal-content2" class="modal-content">

          <!-- Modal Header -->
          <div  id="modal-header2" class="modal-header">
              <h4 id="modal-title2" class="modal-title">Remove Date</h4>
          </div>

          <!-- Modal Body -->
          <div id="modal-body2" class="gap-2 modal-body d-flex flex-column align-items-center justify-content-start">
            <div class="input-group">
                <span class="input-group-text">Date :</span>
                <select value="" required class="form-control" name="datedelete" id="datedelete" type="date">
                <option value="" selected disabled>-- Select Date --</option>
                <?php
                foreach ($options as $option): ?>
                  <option value="<?php echo $option['startdate']; ?>"><?php echo $option['date']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>

          <!-- Modal Footer -->
          <div  id="modal-footer2" class="modal-footer">
              <button type="button" class="btn btn-primary btn-md deleteDate-btn">Remove</button>
              <button type="button" class="btn btn-danger close-btn" data-dismiss="deleteDate">Close</button> 
          </div>

      </div>
  </div>
</div>
<!-- MODAL -->

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="js/printThis.js"></script>
<script type="text/javascript" src="js/home.js"></script>
<script type="text/javascript" src="js/screenshot.js"></script>
<script type="text/javascript" src="js/select.js"></script>


<script>

$('.btnBack').click(function(){
window.location.href = "pay-selectbranch.php";   

});

$('#Sorting').change(function() {
    submitData();
});


$('#selectDate').change(function() {
    var selectedDate = $(this).val();
        var options = <?php echo json_encode($options); ?>;
        var selectedOption = options.find(option => option.selectedDate === selectedDate);
        if (selectedOption) {
            $('#startdateoutput').val(selectedOption.startdate);
            $('#enddateoutput').val(selectedOption.enddate);
        } else {
            $('#startdateoutput').val('');
            $('#enddateoutput').val('');
        }

    submitData();
});

function submitData() {

    var branch = $('#branchname').val();

    var selectElement = document.getElementById('selectDate');

    // Get the selected option's text
    var selectedText = selectElement.options[selectElement.selectedIndex].text;

    // Get the value of the selected date
    var date = $('#selectDate').val();

    // Split the date into components
    var parts = date.split('-'); 
    var year = parseInt(parts[0]); 
    var month = parseInt(parts[1]); 
    var dayOfMonth = parseInt(parts[2]);



    var startdate = $('#startdateoutput').val();
    var enddate = $('#enddateoutput').val();

    // Determine the pay period based on the day of the month
    if (dayOfMonth <= 25) {
        $('#payPeriod').val('First Cut Off');
    } else {
        $('#payPeriod').val('Last Cut Off');
    }

    var periodpay = $('#payPeriod').val();
    var valsort = $('#Sorting').val();


    // Make the AJAX request
    $.ajax({
        type: "POST",
        url: "pay-readReport.php",
        data: {
            date: date,
            startdate: startdate,
            enddate: enddate,
            periodpay: periodpay,
            valsort: valsort,
            branch:branch
        },
        success: function(result) {
            $('.reports').html(result); // Update container with fetched data
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

</script>

<script>

 function formatDate(dateString) {
    // Convert the original date string to a JavaScript Date object
    var originalDate = new Date(dateString);
    
    // Get the month in the long format (e.g., "January", "February", etc.)
    var month = originalDate.toLocaleString('default', { month: 'long' });
    
    // Get the day of the month
    var day = originalDate.getDate();
    
    // Get the year
    var year = originalDate.getFullYear();
    
    // Concatenate the parts to form the new date format
    var newDateFormat = month + " " + day + ", " + year;
    
    // Return the new date format
    return newDateFormat;
}

function getStartDateAdded() {
  var selectedDate = $('#dateadded').val(); // Get the selected date
  var parts = selectedDate.split('-'); // Split the date into parts
  var year = parseInt(parts[0]); // Extract the year
  var month = parseInt(parts[1]); // Extract the month
  var dayOfMonth = parseInt(parts[2]); // Extract the day of the month

  var startDate;

  // Determine the start date based on the day of the selected date
  if (dayOfMonth === 15) {
      // If the day of the selected date is 15, start date is the 26th of the previous month
      if (month === 1) {
          // If it's January, the previous month is December of the previous year
          startDate = (year - 1) + '-12-26';
      } else {
          // Otherwise, the previous month is the month before
          var prevMonth = month - 1;
          if (prevMonth < 10) {
              prevMonth = '0' + prevMonth; // Ensure two digits for month
          }
          startDate = year + '-' + prevMonth + '-26';
      }
  } else {
      // If the day of the selected date is not 15, start date is the 11th of the same month
      startDate = year + '-' + parts[1] + '-11';
  }

  return startDate;
}


function getEndDateAdded() {
  var selectedDate = $('#dateadded').val(); // Get the selected date
  var parts = selectedDate.split('-'); // Split the date into parts
  var year = parseInt(parts[0]); // Extract the year
  var month = parseInt(parts[1]); // Extract the month
  var dayOfMonth = parseInt(parts[2]); // Extract the day of the month

  var endDate;

  // Determine the end date based on the day of the month
  if (dayOfMonth <= 15) {
    // If the day of the month is 15 or less, end date is the 10th of the same month
    endDate = year + '-' + parts[1] + '-10';
  } else {
    // If the day of the month is greater than 15, end date is the 25th of the same month
    endDate = year + '-' + parts[1] + '-25';
  }

  return endDate;
}
$(document).ready(function() {
 $('.close-btn').click(function(){
    $('#addDate').remove();
    location.reload();
    });

    $('#dateadded').change(function(){
      var addedDate = $(this).val();
      $('#selecteddate').val(formatDate(addedDate));
      var getstartdateAdded = getStartDateAdded();
      var getenddateAdded = getEndDateAdded();
      $('#startdateadded').val(getstartdateAdded);
      $('#enddateadded').val(getenddateAdded);
    });

    $('.addDate-btn').click(function(){
    // Get the values from the input fields
    var selectedDate = $('#selecteddate').val();
    var selectedStartDate = $('#startdateadded').val();
    var selectedEndDate = $('#enddateadded').val();
    var addedDate = $('#dateadded').val();

    // Ask for confirmation
    var confirmed = confirm("Are you sure you want to add this date?");

    // Proceed only if confirmed
    if (confirmed) {
        // Make AJAX request
        $.ajax({
            url: 'pay-adddate.php',
            method: 'POST',
            data: {
                addedDate : addedDate,
                selectedDate: selectedDate,
                selectedStartDate: selectedStartDate,
                selectedEndDate: selectedEndDate
            }, 
            success: function(response) {
              location.reload();
            },
            error: function(xhr, status, error) {
                console.log('error');
            }
        });
    }
});

$('.deleteDate-btn').click(function(){

  var deleteDate = $('#datedelete').find(":selected").text();

  var confirmed = confirm("Are you sure you want to remove this date?");

    // Proceed only if confirmed
    if (confirmed) {
        // Make AJAX request
        $.ajax({
            url: 'pay-deletedate.php',
            method: 'POST',
            data: {
              deleteDate: deleteDate,
            }, 
            success: function(response) {
              location.reload();
              console.log(deleteDate);
            },
            error: function(xhr, status, error) {
                console.log('error');
            }
        });
    }

});
});


</script>