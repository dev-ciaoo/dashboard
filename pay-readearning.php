<?php
include('connection.php');

$tbody = "";

$currentDate = date("Y-m-d");

// Helper function to safely format numbers with 2 decimals
function formatAmount($value) {
    if ($value === null || $value === '') {
        return '0.00';
    }
    return number_format((float)$value, 2, '.', '');
}

// Check if the search query is submitted
if (isset($_POST['query'])) {
    // Get the search query
   

    $query = '%' . $_POST['query'] . '%';
    $branch = $_POST['branch'];
    $emptyDate = '';

    // Convert the search query to lowercase
    $query = strtolower($query);

    // Prepare the SQL statement based on whether a branch is provided
    if (!empty($branch)) {
        // $stmt = $con->prepare("SELECT acc.employeeId AS acc_employeeId, pe.*, ploan.*,acc.*  FROM accounts acc
        //                                                 LEFT JOIN pay_earningshr pe ON pe.employeeId = acc.employeeId AND pe.datedeleted = ?
        //                                                 LEFT JOIN pay_earningsloan ploan ON acc.employeeID = ploan.employeeID AND ploan.datedeleted = ?
        //                                                 WHERE acc.employeeID != '0' AND acc.stats != 1 AND LOWER(acc.fullName) LIKE ? AND LOWER(acc.address) = ? ORDER BY pe.id DESC");
        $stmt = $con->prepare("SELECT acc.employeeId AS acc_employeeId, pe.*, ploan.*, acc.*, e.empPosition
                        FROM accounts acc
                        LEFT JOIN pay_earningshr pe ON pe.employeeId = acc.employeeId AND pe.datedeleted = ?
                        LEFT JOIN pay_earningsloan ploan ON acc.employeeID = ploan.employeeID AND ploan.datedeleted = ?
                        LEFT JOIN empinfo e ON e.empId = acc.employeeId
                        WHERE acc.employeeID != '0' AND acc.stats != 1 AND LOWER(acc.fullName) LIKE ? AND LOWER(acc.address) = ? ORDER BY pe.id DESC");
        $stmt->bind_param("ssss", $emptyDate, $emptyDate, $query, $branch);
    } else {
        // $stmt = $con->prepare("SELECT acc.employeeId AS acc_employeeId, pe.*, ploan.*,acc.* FROM accounts acc
        //                                                 LEFT JOIN pay_earningshr pe ON pe.employeeId = acc.employeeId AND pe.datedeleted = ?
        //                                                 LEFT JOIN pay_earningsloan ploan ON acc.employeeID = ploan.employeeID AND ploan.datedeleted = ?
        //                                                 WHERE acc.employeeID != '0' AND acc.stats != 1 AND LOWER(acc.fullName) LIKE ? ORDER BY pe.id DESC");
        $stmt = $con->prepare("SELECT acc.employeeId AS acc_employeeId, pe.*, ploan.*, acc.*, e.empPosition
                        FROM accounts acc
                        LEFT JOIN pay_earningshr pe ON pe.employeeId = acc.employeeId AND pe.datedeleted = ?
                        LEFT JOIN pay_earningsloan ploan ON acc.employeeID = ploan.employeeID AND ploan.datedeleted = ?
                        LEFT JOIN empinfo e ON e.empId = acc.employeeId
                        WHERE acc.employeeID != '0' AND acc.stats != 1 AND LOWER(acc.fullName) LIKE ? ORDER BY pe.id DESC");
        $stmt->bind_param("sss", $emptyDate, $emptyDate, $query);
    }

    // Execute the query
    $stmt->execute();
    $searchResult = $stmt->get_result();

    if (!$searchResult) {
        // Handle query error
        die("Error: " . $con->error);
    }
 
    $tbody = "";
    // Populate table body with search results
    if ($searchResult->num_rows > 0) {
        while ($row = $searchResult->fetch_assoc()) {
            $sssloanPayment = $row['sssloanPayment'];
            $ssscalamityPayment = $row['ssscalamityPayment'];
            $pagibigloanPayment = $row['pagibigloanPayment'];
            $pagibigcalamityPayment = $row['pagibigcalamityPayment'];
            $slPayment = $row['slPayment'];
            
            $tbody .= "<tr>";
            $tbody .= "<td></td>";
            $tbody .= "<td style='gap:20px;'>". $row['acc_employeeId'] ."</td>";
            $boldFullName = str_replace($_POST['query'], '<strong>'.$_POST['query'].'</strong>', $row['fullName']);
            $tbody .= "<td>".  $boldFullName ."</td>"; 
            // $tbody .= "<td>". $row['bankPosition'] ."</td>"; 
            // $tbody .= "<td>". $row['empPosition'] ."</td>";
            $tbody .= "<td>". ucwords(strtolower($row['empPosition'])) ."</td>";
            $tbody .= "<td>". $row['address'] ."</td>"; 
            
            // FIX: Apply formatAmount helper function to ensure 2 decimal places with NULL handling
            $tbody .= "<td>". formatAmount($row['MonthlySalary']) ."</td>"; 
            $tbody .= "<td>". formatAmount($row['RiceAllowance']) ."</td>"; 
            $tbody .= "<td>". formatAmount($row['TranspoAllowance']) ."</td>"; 
            $tbody .= "<td>". formatAmount($row['specialAllow']) ."</td>";
            $tbody .= "<td style='color:red;'>". formatAmount($row['sss']) ."</td>"; 
            $tbody .= "<td style='color:red;'>". formatAmount($row['sssmandprovident']) ."</td>";
            $tbody .= "<td style='color:red;'>". formatAmount($row['pagibig']) ."</td>"; 
            $tbody .= "<td style='color:red;'>". formatAmount($row['philhealth']) ."</td>";  
            $tbody .= "<td style='color:red;'>". formatAmount($row['withholdingtax']) ."</td>";
            
            // FIX: Apply formatAmount to loan amounts based on payment method
            if($sssloanPayment == 2){
                $tbody .= "<td style='color:red;'>". formatAmount($row['sssloanFirst']) ."</td>";  
            }else{
                $tbody .= "<td style='color:red;'>". formatAmount($row['sssloan']) ."</td>";  
            }
            
            if($ssscalamityPayment == 2){ 
                $tbody .= "<td style='color:red;'>". formatAmount($row['ssscalamityFirst']) ."</td>"; 
            }else{
                $tbody .= "<td style='color:red;'>". formatAmount($row['ssscalamity']) ."</td>"; 
            }
            
            if($pagibigloanPayment == 2){ 
                $tbody .= "<td style='color:red;'>". formatAmount($row['pagibigloanFirst']) ."</td>"; 
            }else{
                $tbody .= "<td style='color:red;'>". formatAmount($row['pagibigloan']) ."</td>"; 
            }
            
            if($pagibigcalamityPayment == 2){ 
                $tbody .= "<td style='color:red;'>". formatAmount($row['pagibigcalamityFirst']) ."</td>";
            }else{
                $tbody .= "<td style='color:red;'>". formatAmount($row['pagibigcalamity']) ."</td>";
            }
            
            if($slPayment == 2){
                $tbody .= "<td style='color:red;'>". formatAmount($row['slAmortizationFirst']) ."</td>"; 
            }else{
                $tbody .= "<td style='color:red;'>". formatAmount($row['slAmortization']) ."</td>"; 
            }

            // delete button on employee here ==-
            $tbody .= "<td class='text-center'>
                        <div style='text-align:center;white-space: nowrap;'>
                            <a class='update btn p-2 btn-primary p-1 ' data-id='". $row['acc_employeeId'] ."'>View / Edit</a>
                            <a class='btn p-2 btn-danger delete-link' href='paydelete.php?id=". $row['acc_employeeId'] . "'>Delete</a> 
                        </div>
                    </td>"; 
            $tbody .= "</tr>";
        }
    } else {
        // No results found
        $tbody .= "<tr><td colspan='20'>No results found</td></tr>";
    }
    $stmt->close();
}

$con->close();
?>

<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
<table id="searchResults" style="width:100%;"  class="table display table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Branch</th>
            <th>Monthly Salary</th>
            <th>Rice Allowance</th>
            <th>Transpo Allowance</th>
            <th>Special Allowance</th>
            <th>SSS</th>
            <th>SSS Mand. Provident</th>
            <th>Pagibig</th>
            <th>PhilHealth</th>
            <th>Withholding Tax</th>
            <th>SSS Loan</th>
            <th>SSS Calamity</th>
            <th>Pagibig Loan</th>
            <th>Pagibig Calamity</th>
            <th>Salary Loan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $tbody; ?>
    </tbody>
</table>



<style>
th{
    text-align:center !important;
}
.dtr-control{
    width:80px;
   text-align:right;
}
.paginate_button a {
color: black;
float: left;
padding: 8px 16px;
text-decoration: none;
transition: background-color .3s;
border: 1px solid #ddd;
margin: 0 4px;
}

.paginate_button a.active {
background-color: #0d6efd;
color: white;
border: 1px solid #0d6efd;
}

.dataTables_length{
    display: none;
}
.dataTables_filter{
    display: none;
}
.dataTables_info{
    display: none;
}
.dataTables_paginate{
    display: inline-block;
    float: right;
    
}
#searchResults{
    zoom:75%;
}

.paginate_button a:hover:not(.active) {
    background-color: #ddd;
}
/* th {
    text-align: center !important;
    font-weight: 500;
    font-size: 12px;
    color: #6b7280;
    letter-spacing: 0.04em;
    white-space: nowrap;
    background-color: #f9fafb;
}

#searchResults {
    zoom: 75%;
    border-collapse: collapse;
}

#searchResults thead tr {
    border-bottom: 1.5px solid #e5e7eb;
}

#searchResults tbody tr {
    border-bottom: 0.5px solid #f3f4f6;
    transition: background-color 0.15s ease;
}

#searchResults tbody tr:hover {
    background-color: #f9fafb;
}

#searchResults tbody td {
    padding: 9px 12px;
    font-size: 13px;
    color: #111827;
}

.dtr-control {
    width: 80px;
    text-align: right;
}

.dataTables_length { display: none; }
.dataTables_filter { display: none; }
.dataTables_info   { display: none; }

.dataTables_paginate {
    display: inline-block;
    float: right;
    margin-top: 8px;
}

.paginate_button a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    height: 30px;
    padding: 0 8px;
    font-size: 12px;
    text-decoration: none;
    border: 0.5px solid #d1d5db;
    border-radius: 6px;
    background-color: #ffffff;
    color: #374151;
    margin: 0 2px;
    transition: all 0.15s ease;
}

.paginate_button a:hover:not(.active) {
    background-color: #f3f4f6;
    border-color: #9ca3af;
    color: #111827;
}

.paginate_button a.active {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #ffffff;
} */

</style>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>

<script>


$(document).ready(function(){
    // $(document).off('click', '.update');
    
    var myTable = $('#searchResults').DataTable();
    myTable.destroy();
   
    var myTable = $('#searchResults').DataTable({
        pageLength: 10, 
        columnDefs: [
        {
            className: 'dtr-control',
            orderable: false,
            targets:[0]
        }
        ],
        order: [1, 'asc'],
        responsive: {
        details: {
            type: 'column'
        }
    }
});

$(document).off('click', '.update').on('click', '.update', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var employeeId = $(this).data('id');

        // Hide and reset the modal before updating content
        $('.modal').modal('hide');
        $(".modal-body").html('');
        $(".modal-footer").html('');

        console.log(employeeId);
        $.ajax({
            url: "pay-updateempinfo.php?id=" + employeeId,
            type: "POST",
            success: function(data) {
                // Update modal content
                $(".modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button><button type="button" id="btnsave" class="btn btn-primary">SAVE</button>');
                $(".modal-body").html(data);
                $(".modal-dialog").addClass("custom-modal-body");
                $(".modal").modal('show');
                    $("#sssloanDate").trigger("change"); // LOANS LOGIC
                    $("#ssscalamityDate").trigger("change"); // LOANS LOGIC
                    $("#pagibigloanDate").trigger("change"); // LOANS LOGIC
                    $("#pagibigcalamityDate").trigger("change"); // LOANS LOGIC
            },
            error: function() {
                console.log('Failed');
                alert('Failed');
            }
        });
});


// $(document).on('click', '.viewemp', function(){
//     var employeeId = $(this).data('id');
//     console.log(employeeId);
//     $.ajax({
//         url: "pay-viewempinfo.php?id=" + employeeId,
//         type: "post",
//         data: {},
//         success: function(data) {
//             $(".modal-footer").html('<font>OUR BANK</font>');
//             $(".modal-body").html(data);
//             $(".modal-dialog").addClass("custom-modal-body");
//             $(".modal").modal('show');
//         },
//         error: function() {
//             console.log();
//             alert('Failed');
//         }
//     });
// });





    // Add a click event handler for the "Cancel" button inside the modal
$(document).on('click', '.btn-danger[data-dismiss="modal"]', function(e) {
        $(".modal").modal('hide');
        e.preventDefault();
    });
});



// $(document).on('click', '#btnsave', function(event){
//     if (inputChanged) {
//         alert('Earning and Deduction have been changed! Kindly check them before saving.');
//         inputChanged = false;
//     } else {
//        var userConfirm = confirm('Do you want to save it?');
//        if(userConfirm){
//            $('#myform').submit();
//        } else {
//            return false;
//        }
//     }
// });




    </script>