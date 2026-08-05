<?php
include('connection.php');

session_start();
$viewOnlyAccounts = ['mclerigo', 'prmallabo']; // VIEW ONLY
$isViewOnly = in_array($_SESSION['username'] ?? '', $viewOnlyAccounts); // VIEW ONLY
$noDownloadAccounts = ['mclerigo', 'prmallabo']; // NO DOWNLOAD BUTTON 
$isNoDownload = in_array($_SESSION['username'] ?? '', $noDownloadAccounts); // NO DOWNLOAD BUTTON 
$date = $_POST['date'];
$periodpay = $_POST['periodpay'];
$formattedDate = date("F j, Y", strtotime($date));
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$branch = $_POST['branch'];

$startdate = mysqli_real_escape_string($con, $startdate);
$enddate = mysqli_real_escape_string($con, $enddate);
$branch = mysqli_real_escape_string($con, $branch);

if (!empty($branch)) {
    $sql = "SELECT l.*, a.*,l.id as leaveId
    FROM leavetbl l
    LEFT JOIN accounts a ON l.employee_id = a.employeeId
    WHERE l.iAbsent = '1' AND l.iStatus = '2' AND a.address = '$branch' AND iCategory != 'Overtime'
    AND iCategory != 'Official Business'
    AND (l.`dateFrom` >= '$startdate' AND l.`dateFrom` <= '$enddate')";
}else{
    $sql = "SELECT l.*, a.*,l.id as leaveId
    FROM leavetbl l
    LEFT JOIN accounts a ON l.employee_id = a.employeeId
    WHERE l.iAbsent = '1' AND l.iStatus = '2' AND iCategory != 'Overtime'
    AND iCategory != 'Official Business'
    AND (l.`dateFrom` >= '$startdate' AND l.`dateFrom` <= '$enddate')";
}

$result = mysqli_query($con, $sql);

$tbody = '';
$colspan = $isViewOnly ? '5' : '6';

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $leaveId = $row['leaveId'];
            $tbody .= '<tr class="tablerow"';
            if ($row['iCategory'] == 'Unpaid Leave') {
                $tbody .= ' style="background-color:#FFFACD"';
            }
            $tbody .= ' >';
            $tbody .= '<td>'.$row['employeeId']. '</td>';
            $tbody .= '<td>'.$row['iName']. '</td>';
            $tbody .= '<td>'.$row['dateFrom']. '  to  '.$row['dateTo'].'</td>';
            $tbody .= '<td id="reason">'.$row['iMessage']. '</td>';
            $tbody .= '<td id="iCategory" >'.$row['iCategory'].'</td>';
            if ($isViewOnly) {
                // No action column rendered at all
            } else {
                $tbody .= '<td style="white-space:nowrap;" class="text-center">
                <a data-id ="'.$leaveId.'" class="btn-primary updateAbsent btn btn-sm">UPDATE</a>
                <a style="display:none;"data-id ="'.$leaveId.'" class="save text-center btn btn-info btn-sm">SAVE</a>
                <a id="deleteAbsent" data-id="'. $leaveId .'" class="btn-danger deleteAbsent btn btn-sm">DELETE</a>
                </td>';
            }
            $tbody .= '</tr>';
        }
    }else{
        $tbody = "<tr><td colspan='$colspan'>No records found</td></tr>";
    }
}else{
    echo "no result";
}

if (!empty($branch)) {
    $sql2 = "SELECT COUNT(l.employee_id) as count_row, l.*, a.*
    FROM leavetbl l
    LEFT JOIN accounts a ON l.employee_id = a.employeeId
    WHERE l.iAbsent = '1' AND l.iStatus = '2' AND a.address = '$branch' AND iCategory != 'Overtime'
    AND iCategory != 'Official Business'
    AND (l.`dateFrom` >= '$startdate' AND l.`dateFrom` <= '$enddate')";
}else{
    $sql2 = "SELECT COUNT(l.employee_id) as count_row, l.*, a.*
    FROM leavetbl l
    LEFT JOIN accounts a ON l.employee_id = a.employeeId
    WHERE l.iAbsent = '1' AND l.iStatus = '2' AND iCategory != 'Overtime'
    AND iCategory != 'Official Business'
    AND (l.`dateFrom` >= '$startdate' AND l.`dateFrom` <= '$enddate')";
}

$result2 = mysqli_query($con, $sql2);

if ($result2) {
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $totalrow = $row2['count_row'];
        }
    }
}

if (!empty($branch)) {
    $sql2 = "SELECT COUNT(l.employee_id) as count_row, l.*, a.*
    FROM leavetbl l
    LEFT JOIN accounts a ON l.employee_id = a.employeeId
    WHERE l.iAbsent = '1' AND l.iStatus = '2' AND a.address = '$branch' AND iCategory != 'Overtime'
    AND iCategory != 'Official Business'
    AND (l.`dateFrom` >= '$startdate' AND l.`dateFrom` <= '$enddate') GROUP BY l.employee_id";
}else{
    $sql2 = "SELECT COUNT(l.employee_id) as count_row, l.*, a.*
    FROM leavetbl l
    LEFT JOIN accounts a ON l.employee_id = a.employeeId
    WHERE l.iAbsent = '1' AND l.iStatus = '2' AND iCategory != 'Overtime'
    AND iCategory != 'Official Business'
    AND (l.`dateFrom` >= '$startdate' AND l.`dateFrom` <= '$enddate') GROUP BY l.employee_id";
}

$result2 = mysqli_query($con, $sql2);

$tbody2 = '';
if ($result2) {
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $tbody2 .= '<tr>';
            $tbody2 .= '<td>'.$row2['fullName'].'</td>';
            $tbody2 .= '<td class="text-center">'.$row2['count_row'].'</td>';
            $tbody2 .= '</tr>';
        }
    }
}
?>
<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<!-- MODAL
<div class="modal" id="countrow">
  <div id="modal-dialog1" class="modal-dialog modal-lg">
      <div id="modal-content1" class="modal-content">

          <div id="modal-header1" class="modal-header">
              <h4 id="modal-title1" class="modal-title">Total Absents of Employees</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div id="modal-body1" class="modal-body">
            <p class="text-muted">Period: <?php echo date('M d, Y', strtotime($startdate)) . ' - ' . date('M d, Y', strtotime($enddate)); ?></p>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NAME</th>
                        <th class="text-center">TOTAL ABSENCES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tbody2 ?>
                </tbody>
            </table>
          </div>

          <div id="modal-footer1" class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table id="reporttbl" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Emp. Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Reason/Time</th>
                        <th class="text-center">Category</th>
                        <?php if (!$isViewOnly): ?>
                        <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tbody; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#countrow">
                <i class="fas fa-chart-bar"></i> View Summary (Total: <?php echo $totalrow; ?> absent instances)
            </a>
        </div>
    </div>
</div> -->

<!-- <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script> -->

<!-- // PRINT BUTTON ~~~~~~ -->


<!-- MODAL — tanggalin lang yung dati, palitan ng ganito -->
<div class="modal" id="countrow">
  <div id="modal-dialog1" class="modal-dialog modal-lg">
      <div id="modal-content1" class="modal-content">

          <div id="modal-header1" class="modal-header">
              <h4 id="modal-title1" class="modal-title">Total Absents of Employees</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div id="modal-body1" class="modal-body">
            <p class="text-muted">Period: <?php echo date('M d, Y', strtotime($startdate)) . ' - ' . date('M d, Y', strtotime($enddate)); ?></p>
            <table id="summaryTable" class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NAME</th>
                        <th class="text-center">TOTAL ABSENCES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tbody2 ?>
                </tbody>
            </table>
          </div>

          <div id="modal-footer1" class="modal-footer">
            <!-- ✅ PRINT BUTTON -->
            <button type="button" class="btn btn-info" id="printSummaryBtn">
                <i class="fas fa-print"></i> Print Summary
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table id="reporttbl" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Emp. Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Reason/Time</th>
                        <th class="text-center">Category</th>
                        <?php if (!$isViewOnly): ?>
                        <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tbody; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6 d-flex gap-2">
            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#countrow">
                <i class="fas fa-chart-bar"></i> View Summary (Total: <?php echo $totalrow; ?> absent instances)
            </a>
            <!-- ✅ DOWNLOAD CSV BUTTON -->
            <?php if (!$isNoDownload): ?>
            <button type="button" class="btn btn-success" id="downloadCsvBtn">
                <i class="fas fa-download"></i> Download CSV
            </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- // Print Button ~~~~~ -->

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#reporttbl')) {
        $('#reporttbl').DataTable().destroy();
    }
    var myTable = $('#reporttbl').DataTable({
        order: [],
        columnDefs: [
            {
                targets: [0],
                orderData: [0, 1]
            },
            {
                targets: [1],
                orderData: [1, 0]
            },
            {
                targets: [4],
                orderData: [4, 0]
            }
        ],
        createdRow: function(row, data, dataIndex) {
            $(row).attr('id', data[0]);
        },
        pageLength: 10,
        language: {
            emptyTable: "No absent records found for this period"
        }
    });

        var isViewOnly = <?php echo $isViewOnly ? 'true' : 'false'; ?>;
        
    $(document).off('click', '.updateAbsent').on('click', '.updateAbsent', function(e) {
        if (isViewOnly) return; // guard
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        $row.find('#iCategory, #reason').attr('contenteditable', true).css({
            'border': '2px solid #007bff',
            'background-color': '#fff3cd'
        });
        $(this).css('display', 'none');
        $row.find('.save').css('display', '');

        $row.find('.save').off('click').on('click', function() {
            var newiCategory = $row.find('#iCategory').text();
            var newreason = $row.find('#reason').text();
            var $saveBtn = $(this);
            
            $.ajax({
                url: 'pay-updateAbsent.php',
                method: 'GET',
                data: {
                    newiCategory: newiCategory,
                    newreason: newreason,
                    id: id
                },
                success: function(response) {
                    $row.find('#iCategory, #reason').attr('contenteditable', false).css({
                        'border': '1px solid #dee2e6',
                        'background-color': 'transparent'
                    });
                    $row.find('.updateAbsent').css('display', '');
                    $saveBtn.css('display', 'none');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating data: ', error);
                }
            });
        });
    }); 
});
 


// ✅ PRINT SUMMARY
    $('#printSummaryBtn').on('click', function () {
        var period = '<?php echo date('M d, Y', strtotime($startdate)) . ' - ' . date('M d, Y', strtotime($enddate)); ?>';
        var branch = '<?php echo htmlspecialchars($branch); ?>';
        var tableHtml = $('#summaryTable').prop('outerHTML');

        var win = window.open('', '_blank');
        win.document.write(
            '<html><head><title>Absent Summary</title>' +
            '<style>' +
            'body { font-family: Arial, sans-serif; padding: 20px; }' +
            'h3 { margin-bottom: 4px; }' +
            'p { color: #666; margin-bottom: 12px; }' +
            'table { width: 100%; border-collapse: collapse; }' +
            'th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }' +
            'th { background-color: #f0f0f0; }' +
            '.text-center { text-align: center; }' +
            '@media print { button { display: none; } }' +
            '</style></head><body>' +
            '<h3>Total Absents of Employees</h3>' +
            '<p>Period: ' + period + (branch ? ' | Branch: ' + branch : '') + '</p>' +
            tableHtml +
            '<br><button onclick="window.print()">Print</button>' +
            '</body></html>'
        );
        win.document.close();
    });

    // ✅ DOWNLOAD CSV
    var isNoDownload = <?php echo $isNoDownload ? 'true' : 'false'; ?>;

    $('#downloadCsvBtn').on('click', function () {
        if (isNoDownload) return; // guard — double protection
    
        var rows = [];
        var headers = [];

        // Kuha ng headers — bawas ang Action column
        $('#reporttbl thead th').each(function () {
            var text = $(this).text().trim();
            if (text !== 'Action') {
                headers.push('"' + text + '"');
            }
        });
        rows.push(headers.join(','));

        // Kuha ng rows
        $('#reporttbl tbody tr').each(function () {
            var cols = [];
            $(this).find('td').each(function (i) {
                var headerText = $('#reporttbl thead th').eq(i).text().trim();
                if (headerText !== 'Action') {
                    cols.push('"' + $(this).text().trim().replace(/"/g, '""') + '"');
                }
            });
            if (cols.length > 0) {
                rows.push(cols.join(','));
            }
        });

        var csvContent = rows.join('\n');
        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'absent_records_<?php echo $startdate; ?>_<?php echo $enddate; ?>.csv';
        a.click();
        URL.revokeObjectURL(url);
    });

// Print Button ~~~~~

</script>

<style>
    .dataTables_length {
        margin-top: 10px;
    }
    .dataTables_filter {
        margin-right: auto;
        margin-top: 10px;
    }
    .dataTables_info {
        margin-top: 10px;
    }

    #iCategory[contenteditable="true"],
    #reason[contenteditable="true"] {
        padding: 5px;
        border-radius: 4px;
    }

    .table tbody tr {
        transition: background-color 0.2s;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa !important;
    }

    .table tbody tr[style*="#FFFACD"]:hover {
        background-color: #fff0a0 !important;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>