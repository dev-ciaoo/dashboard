<?php 
include('connection.php');
include('fileuploadloan.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css">
<style>
  table, th, td {
    border:1px solid black;
    margin-left: auto;
    margin-right: auto;
  }

  .result, .reject, .create {
    width: 120px; /* Adjust width as needed */
    height: 30px; /* Adjust height as needed */
    font-size: 16px; /* Adjust font size as needed */
    text-align: center;
    padding-top: 2px;
    padding-bottom: 5px;
}
</style>
</head>
<body>

<table style="width:80%; height:auto; position:relative; top:100px;" class="tablelist" id="tablelist" >
<tr>
        <th>Name</th>
        <th>Branch</th>
        <th>Loan Type</th>
        <th>Date Created</th>
        <th>Remarks</th>
        <th>Action</th>

</tr>

<?php


$branchPosition=$_SESSION['bankposition'];
$adress=$_SESSION['address'];


if (isset($_POST['customerName'])) {

$search = $_POST['customerName'];     
	
// $exceptionIds = array(123, 456, 789); // Replace with the actual IDs you want to exclude

// $exceptionConditions = '';
// foreach ($exceptionIds as $exceptionId) {
//     $exceptionConditions .= " AND id != $exceptionId";
// }
	if($search != ''){
    // if($_SESSION['username'] !== "mruazol"){
      $r_sql = "SELECT * FROM loan 
                  WHERE (customerFullName LIKE '%" . $search . "%' 
                        OR customerSurname LIKE '%" . $search . "%' 
                        OR customerFirstName LIKE '%" . $search . "%' 
                        OR CONCAT(customerFirstName, ' ', customerSurname) LIKE '%" . $search . "%') 
                        AND branch = '$adress' 
                        AND loanType != 'CONSOLIDATED DATA'";
    // }else{
    //   $r_sql = "SELECT * FROM loan 
    //               WHERE (customerFullName LIKE '%" . $search . "%' 
    //                     OR customerSurname LIKE '%" . $search . "%' 
    //                     OR customerFirstName LIKE '%" . $search . "%' 
    //                     OR CONCAT(customerFirstName, ' ', customerSurname) LIKE '%" . $search . "%') 
    //                     AND branch IN ('Ternate', 'Maragondon') 
    //                     AND loanType != 'CONSOLIDATED DATA'";
    // }


    if ($adress=="Head Office" && $_SESSION["username"] != "rarcilla"){
      $r_sql = "SELECT * FROM loan WHERE (customerFullName LIKE '%" . $search . "%' OR customerSurname LIKE '%" . $search . "%' OR customerFirstName LIKE '%" . $search . "%' OR CONCAT(customerFirstName, ' ', customerSurname) LIKE '%" . $search . "%') AND loanType != 'CONSOLIDATED DATA'";
    }

		$r_query = mysqli_query($con, $r_sql);	                                          
                             
		if(mysqli_num_rows($r_query) > 0) {
			while($row = mysqli_fetch_array($r_query)){
				// $fname=$row['customerFirstName'];
				// $surname=$row['customerSurname'];
                                
                                $Cfname= $row['customerFirstName'];
                                $Csname=$row['customerSurname'];
                                $Cmname = $row['customerMiddleName'];
                                $fullname=$row['customerFullName'];
                                $birth=$row['birthDate'];
                                $id=$row['loan_Id'];
                                $type=$row['salaryType'];
                                $branch=$row['branch'];
                                $companyName = $row['companyName'];
                                $productId = $row['productID'];
                                $date=$row['dateCreated'];

                                ?>
                                        <form action="" method="POST"><tr>    
                                        <td><?php echo $row['customerFullName'];?></td>
                                        <td><?php echo $row['branch'];?></td>
                                        <td><?php echo $row['salaryType'];?></td>
                                        <td><?php echo $row['dateCreated'];?></td>
                                        <td><?php echo $row['remarks2'];?></td>
                                        <td width="400px">
                                          <button class="btn btn-primary result"  id= "<?= $row['loan_Id']; ?>" name="results" value="<?= $row['salaryType']; ?>" type="button">OPEN</button>
                                          <button class="btn btn-danger reject"  id= "<?= $row['loan_Id']; ?>" name="rejects" value="<?= $row['salaryType']; ?>" type="button">DECLINE</button>
                                          <button class="btn btn-success create"  id="<?= $row['loan_Id']; ?>" 
                                                  data-fname="<?= htmlspecialchars($Cfname); ?>"
                                                  data-sname="<?= htmlspecialchars($Csname); ?>"
                                                  data-mname="<?= htmlspecialchars($Cmname); ?>"
                                                  data-birth="<?= htmlspecialchars($birth); ?>"
                                                  data-company="<?= htmlspecialchars($companyName); ?>"
                                                  data-productid="<?= htmlspecialchars($productId); ?>"
                                                  name="create" value="<?= $row['salaryType']; ?>" type="button">ADDITIONAL</button>
                                        </td>

                    
                                <?php
					
			}
        
      echo "</table>" ;         
		}
    
		else {
			
			echo '<label style="position:absolute; font-size: 200%; right:800px; margin-top:200px;">No Records Found!</label>';
		}
	}
	else {
		echo '<script>alert("input something to search")</script>';
	}
}

               
?>
</form>

<div id="displayhere"></div>
<?php

  
?>
<div class="modal fade" id="createNewCustomerFolder2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Customer</h5>
      </div>
      <div class="modal-body">
        <form id="createNewCustomer2" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="hiddenSheesh" id="hiddenSheesh" value="<?= $_SESSION['userid']; ?>">
          <div class="mb-3 row" id="id">
            <label for="customerFirstName" class="col-md-4 form-label">First Name</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="customerFirstName" name="customerFirstName" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="customerSurname" class="col-md-4 form-label">Surname</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="customerSurname" name="customerSurname"  readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="customerMiddleName" class="col-md-4 form-label">Middle Name</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="customerMiddleName" name="customerMiddleName" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="birthDate" class="col-md-4 form-label">Birth Date</label>
            <div class="col-md-8">
              <input type="date" class="form-control" id="birthDate" name="birthDate"  readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="salaryType" class="col-md-4 form-label">Type Of Loan</label>
            <div class="col-md-8">
              <!-- <input type="text" class="form-control" id="salaryType" name="salaryType" Required> -->
              <select name="salaryType" id="salaryType" class="form-control" Required>
                <option value="" Selected Disabled>-Select Type Of Loan</option>
                <option value="Microfinance">Microfinance</option>
                <option value="Salary Loan">Salary Loan</option>
                <option value="Hold-Out Loan">Hold-Out Loan</option>
                <option value="Hold-Out Loan-MPL">Hold-Out Loan - Multi Purpose</option>
                <option value="REM: Corporation">REM: Corporation</option>
                <option value="REM: Individual">REM: Individual</option>
              </select>
            </div>
          </div>
          <div class="corpSection" id="corpSection" style="display: none">
            <div class="mb-3 row">
              <label for="companyName" class="col-md-4 form-label">Company Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="companyName" name="companyName">
              </div>
            </div>
          </div>
          <div class="sourceIncomeSection" id="sourceIncomeSection" style="display:none;">
            <div class="mb-3 row">
              <label for="sourceIncome" class="col-md-4 form-label">Source Of Income</label>
              <div class="col-md-8">
                <!-- <input type="text" class="form-control" id="salaryType" name="salaryType" Required> -->
                <select name="sourceIncome" id="sourceIncome" class="form-control">
                  <option value="" Selected Disabled>Select Type Of Income</option>
                  <option value="Business">Business</option>
                  <option value="Employed Loan">Employed</option>
                </select>
              </div>
            </div>
          </div>
          <div id="endBuyerSection" style="display: none;">
            <div class="mb-3 row">
              <label for="" class="col-md-4 form-label">End Buyer</label>
              <div class="col-md-8">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="End Buyer" id="endBuyerCheck" name="endBuyerCheck">
                  <label class="form-check-label" for="endBuyerCheck">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <div class="row">
              <div class="col-4"> <!-- Adjust the column width as needed -->
                <input class="form-check-input" type="checkbox" id="existing" name="existing" checked disabled>
                <label style="display: inline;">Existing Loan</label>
              </div>
              <div class="col-8"> <!-- Adjust the column width as needed -->
                <input type="text" class="form-control" id="nextbank" name="nextbank" placeholder="INPUT NEXTBANK PRODCUT ID" style="display:none;">
              </div>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="customerMiddleName" class="col-md-4 form-label">Loan Amount
              <!-- <div class="label-container">
                <span class="fa-solid fa-circle-exclamation warning-icon">!</span>
                <span class="tooltip">Remove the commas ","</span>
              </div> -->
            </label>
            
            <div class="col-md-8">
              <input type="number" class="form-control" id="customerAmount" name="customerAmount" min="0" step=".01" Required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="customerMiddleName" class="col-md-4 form-label">Terms
              <div class="label-container">
                <span class="fa-solid fa-circle-exclamation warning-icon">!</span>
                <span class="tooltip2">
                  Indicate the word <br>"<strong>Year/s</strong>" or "<strong>Month/s</strong>"<br>
                  ex. 1 Year and 6 Months
                </span>
              </div>
            </label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="customerTerms" name="customerTerms" Required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="customerMiddleName" class="col-md-4 form-label">Interest Rate (%)</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="customerInterest" name="customerInterest" Required>
            </div>
          </div>

          <?php if($_SESSION['userid'] == '73'){ ?>
            <div class="mb-3 row">
              <label for="customerBranch" class="col-md-4 form-label">Branch</label>
              <div class="col-md-8">
                <select name="customerBranch" id="customerBranch" class="form-control">
                  <option value="" selected disabled>--Select Branch--</option>
                  <option value="Head Office">Head Office</option>
                  <option value="Noveleta">Noveleta</option>
                  <option value="Poblacion">Poblacion</option>
                  <option value="Manggahan">Manggahan</option>
                  <option value="Magallanes">Magallanes</option>
                  <option value="Maragondon">Maragondon</option>
                  <option value="Ternate">Ternate</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerContact" class="col-md-4 form-label">Phone</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="customerContact" name="customerContact">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="customerEmail" class="col-md-4 form-label">Email</label>
              <div class="col-md-8">
                <input type="email" class="form-control" id="customerEmail" name="customerEmail">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="shaneRemarks" class="col-md-4 form-label">Remarks</label>
              <div class="col-md-8">
                <textarea type="text" class="form-control" id="shaneRemarks" name="shaneRemarks"></textarea>
              </div>
            </div>
          <?php } ?>
      </div>
      <div id="loading">Creating customer data... Please Wait</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="create2" id="create2" tabindex="-1">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Button to Show Table  -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25/datatables.min.js"></script>


<script type="text/javascript">

$(document).ready(function () {
  $('.result').click(function (e) {
    var loanIds = $(this).attr('id');
    var type = $(this).attr('value');
    document.getElementById('tablelist').style.display = 'none';

    var loanTarget ="loanFormMicrofinance.php";

    if (type == "microfinance") {
      loanTarget = "loanFormMicrofinance.php";
    }
    if (type == "Salary Loan") {
      loanTarget = "loanFormSalary.php";
    }
    if (type == "Hold-Out Loan") {
      loanTarget = "loanFormHoldOut.php";
    }
    if (type == "Hold-Out Loan-MPL") {
      loanTarget = "loanFormHoldOutMulti.php";
    }
    if (type == "REM: Corporation") {
      loanTarget = "loanFormCorporation.php";
    }
    if (type == "REM: Individual") {
      loanTarget = "loanFormIndividual.php";
    }


    $.ajax({
      type: 'POST',
      url: loanTarget,
      data: {
        loanId: loanIds
      },
      async: false,
      success: function (result) {
    
        $('#displayhere').html(result);
        $useLoanId = loanIds;
      }
    });
  });

});

$(document).ready(function(){
    $('.reject').click(function(e){
        e.preventDefault();
        var loanIdss = $(this).attr('id');
        var remarks2 = prompt('Remarks: ');
        
        if(remarks2 !== null && remarks2.trim() !== ""){
            $.ajax({
                type: 'POST',
                url: 'loanAccountRemarks.php',
                data: {
                    loanId: loanIdss,
                    remarks2: remarks2
                },
                success: function (result){
                    $('#displayhere').html(result);
                    $useLoanId = loanIdss;
                    alert('Declined Successfully!');
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error occurred: ' + error);
                }
            });
        } else {
            return null;
        }
    });
});

$(document).ready(function() {
    $('.create').click(function(e) {
        e.preventDefault();
        
        // Store the loanId when the button is clicked
        var loanIdss = $(this).attr('id');

        var fname = $(this).data('fname');
        var sname = $(this).data('sname');
        var mname = $(this).data('mname');
        var birth = $(this).data('birth');
        var company = $(this).data('company');
        var productid = $(this).data('productid');
        
        // Show the modal
        $('#createNewCustomerFolder2').modal('show');

        $('#customerFirstName').val(fname);
        $('#customerSurname').val(sname);
        $('#customerMiddleName').val(mname);
        $('#birthDate').val(birth);
        $('#companyName').val(company);
        $('#nextbank').val(productid);
        
        // Optionally, populate the modal with data (if needed)
        // $('#someModalField').val(loanIdss);
    });

    // Submit the form inside the modal
    // function submitNewCustomerForm() {
  $(document).ready(function() {
    $(document).on('click', '#create2', function(e) {
        e.preventDefault();

        // Disable the button to prevent multiple submissions
        $('#create2').prop('disabled', true);
        $('#loading').show();

        // Use jQuery to find the form element
        var customerForm2 = $('#createNewCustomer2')[0];

        // Check if the form exists
        if (!customerForm2) {
            console.error("Form with ID 'createNewCustomer2' not found.");
            $('#loading').hide();
            $('#create2').prop('disabled', false); // Re-enable button if form is not found
            return;
        }

        // Initialize FormData with the form element
        var fdd = new FormData(customerForm2);

        // Append branch address based on session
        <?php if (!in_array($_SESSION['userid'], [78, 19, 73], true)) { ?>
            var branchAdress = "<?php echo $_SESSION['address']; ?>";
            fdd.append('branchAdress', branchAdress);
        <?php } else { ?>
            fdd.append('branchAdress', $('#customerBranch').val());
        <?php } ?>

        // AJAX request to send the form data
        $.ajax({
            url: "loanAddNewCustomer.php",
            type: "POST",
            data: fdd,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#loading').hide();
                alert('Successfully Added!');
                window.location.reload();
            },
            error: function(data) {
                $('#loading').hide();
                alert('Error occurred while adding!');
                $('#create2').prop('disabled', false); // Re-enable button on error
            }
        });
    });
  });



    // }
    // submitNewCustomerForm();

    function show() {
      document.getElementById('createNew').removeAttribute('disabled');
    }

    function stoppedTyping() {
      if (customerName.value.length > 0) {
        document.getElementById('Search').removeAttribute('disabled');
      } else {
        document.getElementById('Search').setAttribute('disabled', true);
      }
    }

  const salaryTypeSelect = document.getElementById('salaryType');
  const endBuyerSection = document.getElementById('endBuyerSection');
  const sourceIncome = document.getElementById('sourceIncomeSection');
  const corpSection = document.getElementById('corpSection');
  const company = document.getElementById('companyName');
  const source = document.getElementById('sourceIncome');

  salaryTypeSelect.addEventListener('change', function() {
    const selectedValue = salaryTypeSelect.value;


    if (selectedValue.includes('REM: Individual')) {
      sourceIncome.style.display = 'inline';
      endBuyerSection.style.display = 'inline';
      source.required = true;

    } else {
      sourceIncome.style.display = 'none';
      endBuyerSection.style.display = 'none';
      source.required = false;
    }
    if (selectedValue.includes('REM: Corporation')) {
      corpSection.style.display = 'inline';
      company.required = true;
    } else {
      corpSection.style.display = 'none';
      company.required = false;
    }
  });


  $(document).ready(function() {
    $('#nextbank').show();
    // $('#existing').change(function() {
    //   if (this.checked) {
    //     $('#nextbank').show();
    //   } else {
    //     $('#nextbank').hide();
    //   }
    // });
  });


  var inputBox = document.getElementById("customerAmount");

  var invalidChars = [
    "-",
    "+",
    "e",
  ];

  inputBox.addEventListener("keydown", function(e) {
    if (invalidChars.includes(e.key)) {
      e.preventDefault();
    }
  });
});


</script>

</body>
</html>