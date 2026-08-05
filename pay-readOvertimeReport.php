<?php
include('connection.php');

// ============================================
// USER RESTRICTION
// ============================================
$restrictedUsers   = ['mclerigo', 'prmallabo'];
$currentUser       = $_SESSION['username'] ?? '';
$isRestrictedUser  = in_array($currentUser, $restrictedUsers);
$noDownloadAccounts = ['mclerigo', 'prmallabo']; // NO DOWNLOAD BUTTON
$isNoDownload = in_array($_SESSION['username'] ?? '', $noDownloadAccounts); // NO DOWNLOAD BUTTON
$date = mysqli_real_escape_string($con, $_POST['date']);
$givenDate = new DateTime($date);
$dayOfMonth = (int)$givenDate->format('d');

// ============================================
// OT PERIOD - 1 MONTH RANGE
// ============================================
if ($dayOfMonth >= 1 && $dayOfMonth <= 15) {
    $payrollStartDate = clone $givenDate;
    $payrollStartDate->modify('-1 month');
    $payrollStartDate->setDate($payrollStartDate->format('Y'), $payrollStartDate->format('m'), 26);
    
    $payrollEndDate = clone $givenDate;
    $payrollEndDate->setDate($payrollEndDate->format('Y'), $payrollEndDate->format('m'), 10);
    
    $startDate = clone $givenDate;
    $startDate->modify('-1 month');
    $startDate->setDate($startDate->format('Y'), $startDate->format('m'), 11);
    
    $endDate = clone $givenDate;
    $endDate->setDate($endDate->format('Y'), $endDate->format('m'), 10);
    
} else {
    $payrollStartDate = clone $givenDate;
    $payrollStartDate->setDate($payrollStartDate->format('Y'), $payrollStartDate->format('m'), 11);
    
    $payrollEndDate = clone $givenDate;
    $payrollEndDate->setDate($payrollEndDate->format('Y'), $payrollEndDate->format('m'), 25);
    
    $startDate = clone $givenDate;
    $startDate->setDate($startDate->format('Y'), $startDate->format('m'), 11);
    
    $endDate = clone $givenDate;
    $endDate->setDate($endDate->format('Y'), $endDate->format('m'), 25);
}

$startdate    = $startDate->format('Y-m-d');
$enddate      = $endDate->format('Y-m-d');
$payrollStart = $payrollStartDate->format('Y-m-d');
$payrollEnd   = $payrollEndDate->format('Y-m-d');

error_log("Payroll Period - Start: $payrollStart, End: $payrollEnd");
error_log("OT Period (1 Month Range) - Start: $startdate, End: $enddate");

$valsort  = mysqli_real_escape_string($con, $_POST['valsort']);
$branch   = mysqli_real_escape_string($con, $_POST['branch']);
$approved = mysqli_real_escape_string($con, $_POST['approved']);
$approve  = mysqli_real_escape_string($con, $_POST['approve']);
$status   = mysqli_real_escape_string($con, $_POST['status']);

if (!empty($branch)) {
    $sql_count = "SELECT SUM(`totalHours`) as totalOvertime
                  FROM leavetbl 
                  WHERE `iStatus` = '2' 
                  AND iCategory = 'Overtime' 
                  AND iBranch = '$branch' 
                  AND dateFrom BETWEEN '$startdate' AND '$enddate'";

    $sql_sum = "SELECT iName,
                SUM(CASE WHEN DAYOFWEEK(dateFrom) NOT IN (1, 7) THEN totalHours ELSE 0 END) as regularOvertime,
                SUM(CASE WHEN DAYOFWEEK(dateFrom) IN (1, 7) THEN totalHours ELSE 0 END) as weekendOvertime
                FROM leavetbl 
                WHERE `iStatus` = '2' 
                AND iCategory = 'Overtime' 
                AND iBranch = '$branch' 
                AND dateFrom BETWEEN '$startdate' AND '$enddate' 
                GROUP BY employee_Id";

    $sql_data = "SELECT l.*, 
                 (SELECT MAX(p.time) FROM payroll p 
                  WHERE p.employeeId = l.employee_Id 
                  AND p.date = l.dateFrom) as biometrics_timeout
                 FROM leavetbl l
                 WHERE l.`iStatus` = '2' 
                 AND l.iCategory = 'Overtime' 
                 AND l.iBranch = '$branch' 
                 AND l.dateFrom BETWEEN '$startdate' AND '$enddate'
                 ORDER BY l.dateFrom ASC, l.employee_Id ASC";
} else {
    $sql_count = "SELECT SUM(`totalHours`) as totalOvertime
                  FROM leavetbl 
                  WHERE `iStatus` = '2' 
                  AND iCategory = 'Overtime' 
                  AND dateFrom BETWEEN '$startdate' AND '$enddate'";

    $sql_sum = "SELECT iName,
                SUM(CASE WHEN DAYOFWEEK(dateFrom) NOT IN (1, 7) THEN totalHours ELSE 0 END) as regularOvertime,
                SUM(CASE WHEN DAYOFWEEK(dateFrom) IN (1, 7) THEN totalHours ELSE 0 END) as weekendOvertime
                FROM leavetbl 
                WHERE `iStatus` = '2' 
                AND iCategory = 'Overtime' 
                AND dateFrom BETWEEN '$startdate' AND '$enddate' 
                GROUP BY employee_Id";

    $sql_data = "SELECT l.*, 
                 (SELECT MAX(p.time) FROM payroll p 
                  WHERE p.employeeId = l.employee_Id 
                  AND p.date = l.dateFrom) as biometrics_timeout
                 FROM leavetbl l
                 WHERE l.`iStatus` = '2' 
                 AND l.iCategory = 'Overtime' 
                 AND l.dateFrom BETWEEN '$startdate' AND '$enddate'
                 ORDER BY l.dateFrom ASC, l.employee_Id ASC";
}

$result_count = mysqli_query($con, $sql_count);
$totalOvertime = 0;
if ($result_count) {
    $row_count = mysqli_fetch_assoc($result_count);
    $totalOvertime = $row_count['totalOvertime'] ?? 0;
}

$result = mysqli_query($con, $sql_data);
$tbody = "";
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $tbody .= '<tr>';
        $tbody .= "<td>".$row['employee_Id']."</td>";
        $tbody .= "<td>".$row['iName']."</td>";
        $tbody .= "<td>".$row['iBranch']."</td>";
        $tbody .= "<td class='dateFrom'>".$row['dateFrom']."</td>";
        $tbody .= "<td>".$row['iMessage']."</td>";
        $tbody .= "<td class='kindOT'>".$row['kindOT']."</td>";
        $tbody .= "<td class='totalOT'>".$row['totalHours']."</td>";
        $biometricsOut = !empty($row['biometrics_timeout']) ? $row['biometrics_timeout'] : '<span class=\'text-danger fw-bold\'>NO TIME OUT</span>';
        $tbody .= "<td class='text-center biometrics-timeout'>".$biometricsOut."</td>";
        $tbody .= "<td class='remarks'>".$row['iRemarks']."</td>";
        if (!$isRestrictedUser) {
            $tbody .= '<td class="text-center">
                        <a data-id="'.$id.'" class="text-center update btn btn-primary btn-sm">UPDATE</a>
                        <a style="display:none;" data-id="'.$id.'" class="text-center save btn btn-info btn-sm">SAVE</a>
                       </td>';
        }
        $tbody .= '</tr>';
    }
} else {
    $tbody = "<tr><td colspan='".($isRestrictedUser ? '10' : '11')."'>No overtime records found for the selected period</td></tr>";
}

$result_sum = mysqli_query($con, $sql_sum);
$tbody2 = "";
if ($result_sum && mysqli_num_rows($result_sum) > 0) {
    while ($row = mysqli_fetch_assoc($result_sum)) {
        $totalOT = $row['regularOvertime'] + $row['weekendOvertime'];
        $tbody2 .= '<tr>';
        $tbody2 .= "<td>".$row['iName']."</td>";
        $tbody2 .= "<td>".number_format($row['regularOvertime'], 2)."</td>";
        $tbody2 .= "<td>".number_format($row['weekendOvertime'], 2)."</td>";
        $tbody2 .= "<td>".number_format($totalOT, 2)."</td>";
        $tbody2 .= '</tr>';
    }
} else {
    $tbody2 = "<tr><td colspan='4'>No summary data available</td></tr>";
}
?>

<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<!-- ===== SUMMARY MODAL ===== -->
<div class="modal" id="countrow">
  <div id="modal-dialog1" class="modal-dialog modal-lg">
      <div id="modal-content1" class="modal-content">
          <div id="modal-header1" class="modal-header">
              <h4 id="modal-title1" class="modal-title">Total Overtime of Employees</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div id="modal-body1" class="modal-body">
            <p class="text-muted">
                <strong>Payroll Period:</strong> <?php echo $payrollStart; ?> to <?php echo $payrollEnd; ?><br>
                <strong>OT Period:</strong> <?php echo $startdate; ?> to <?php echo $enddate; ?>
            </p>
            <table class="table table-bordered table-hover" id="summaryTable">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">NAME</th>
                        <th class="text-center">REGULAR OT</th>
                        <th class="text-center">WEEKEND OT</th>
                        <th class="text-center">TOTAL OT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tbody2 ?>
                </tbody>
            </table>
          </div>
          <div id="modal-footer1" class="modal-footer">
            <button type="button" class="btn btn-info" id="printSummaryBtn">
                <i class="fas fa-print"></i> Print Summary
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- ===== MAIN SECTION ===== -->
<section class="leaveReport">
<div id="table-container" class="responsive-table" style="margin-top:20px;">

    <div class="alert alert-info">
        <strong>Payroll Period:</strong> <?php echo $payrollStart; ?> to <?php echo $payrollEnd; ?><br>
        <strong>OT Period (1 Month Range):</strong> <?php echo $startdate; ?> to <?php echo $enddate; ?>
    </div>

    <?php if (!$isRestrictedUser): ?>
    <button id="addOTRow" class="btn btn-success mb-2">+ Add OT Row</button>
    <?php endif; ?>

    <table id="reporttbl" class="table table-bordered table-hover" style="width:100%;">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Emp. ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Branch</th>
                <th class="text-center" style="white-space:nowrap;">Date</th>
                <th class="text-center">Reason</th>
                <th class="text-center">Kind OT</th>
                <th class="text-center">OT Hours</th>
                <th class="text-center">Biometrics Time Out</th>
                <th class="text-center">Remarks</th>
                <?php if (!$isRestrictedUser): ?>
                <th class="text-center">Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php echo $tbody; ?>
        </tbody>
    </table>

    <table id="newRowTable" class="table table-bordered" style="width:100%; display:none;">
        <tbody id="newRowBody"></tbody>
    </table>

    <div class="col-md-6 mt-2 d-flex gap-2">
        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#countrow" id="totalOTLink">
            <i class="fas fa-chart-bar"></i> View Summary (Total OT: <?php echo number_format($totalOvertime, 2); ?> hrs)
        </a>
        <?php if (!$isNoDownload): ?>
        <button type="button" class="btn btn-success" id="downloadCsvBtn">
            <i class="fas fa-download"></i> Download CSV
        </button>
        <?php endif; ?>
    </div>

</div>
</section>

<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script>
var isRestrictedUser = <?php echo $isRestrictedUser ? 'true' : 'false'; ?>;

$(document).ready(function () {

    // ===== INITIALIZE DATATABLE =====
    var myTable = $('#reporttbl').DataTable();
    myTable.destroy();
    myTable = $('#reporttbl').DataTable({
    autoWidth: false,
    order: [[3, 'asc']],
    columnDefs: [
        { targets: [0], orderData: [0, 1] },
        { targets: [1], orderData: [1, 0] },
        { targets: [4], orderData: [4, 0] }  // Reason column (index 4: EmpID, Name, Branch, Date, Reason)
    ],
    pageLength: 10,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
});

    // ===== RECALCULATE TOTALS FROM DOM =====
    function recalculateTotals() {
        var summaryMap = {};
        var grandTotal = 0;

        myTable.rows().nodes().to$().each(function () {
            var cols    = $(this).find('td');
            var name    = cols.eq(1).text().trim();
            var dateStr = $(this).find('.dateFrom').text().trim(); // use dateFrom class for accuracy
            var hours   = parseFloat($(this).find('.totalOT').text()) || 0;

            if (!name || !dateStr) return;

            var date = new Date(dateStr);
            var day  = date.getDay();

            if (!summaryMap[name]) summaryMap[name] = { regular: 0, weekend: 0 };

            if (day === 0 || day === 6) {
                summaryMap[name].weekend += hours;
            } else {
                summaryMap[name].regular += hours;
            }

            grandTotal += hours;
        });

        $('#summaryTable tbody tr').each(function () {
            var name = $(this).find('td').eq(0).text().trim();
            if (summaryMap[name]) {
                var reg  = summaryMap[name].regular;
                var wknd = summaryMap[name].weekend;
                $(this).find('td').eq(1).text(reg.toFixed(2));
                $(this).find('td').eq(2).text(wknd.toFixed(2));
                $(this).find('td').eq(3).text((reg + wknd).toFixed(2));
            }
        });

        $('#totalOTLink').text('Total Overtime: ' + grandTotal.toFixed(2) + ' hours');
    }

    // ===== UPDATE (INLINE EDIT) EXISTING ROW =====
    if (!isRestrictedUser) {
        $(document).off('click', '.update').on('click', '.update', function (e) {
            var id   = $(this).data('id');
            var $row = $(this).closest('tr');

            $row.find('.totalOT, .remarks, .kindOT').attr('contenteditable', true).css('border', 'solid 2px #0d6efd');
            $(this).css('display', 'none');
            $row.find('.save').css('display', '');

            $row.find('.save').off('click').on('click', function () {
                var newtotalOT = $row.find('.totalOT').text().trim();
                var newremarks = $row.find('.remarks').text().trim();
                var newkindOT  = $row.find('.kindOT').text().trim();
                var $saveBtn   = $(this);

                $.ajax({
                    url: 'pay-updateOvertime.php',
                    method: 'GET',
                    data: {
                        newtotalOT: newtotalOT,
                        newremarks: newremarks,
                        newkindOT:  newkindOT,
                        id:         id
                    },
                    success: function (response) {
                        $row.find('.totalOT, .remarks, .kindOT').attr('contenteditable', false).css('border', 'solid 1px rgb(222,226,230)');
                        $row.find('.update').css('display', '');
                        $saveBtn.css('display', 'none');
                        console.log(response);
                        recalculateTotals();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error updating data:', error);
                    }
                });
            });
        });

        // ===== ADD NEW OT ROW =====
        $(document).off('click', '#addOTRow').on('click', '#addOTRow', function () {
            var newRow = `
                <tr class="new-ot-row table-warning">
                    <td><input type="text" class="form-control form-control-sm" id="new_empId" placeholder="Emp ID"></td>
                    <td><input type="text" class="form-control form-control-sm" id="new_name" placeholder="Full Name"></td>
                    <td><input type="text" class="form-control form-control-sm" id="new_branch" placeholder="Branch"></td>
                    <td><input type="date" class="form-control form-control-sm" id="new_dateFrom" placeholder="Date"></td>
                    <td><input type="text" class="form-control form-control-sm" id="new_reason" placeholder="Reason"></td>
                    <td>
                        <select class="form-control form-control-sm" id="new_kindOT">
                            <option value="Regular OT">Regular OT</option>
                            <option value="Weekend OT">Weekend OT</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.01" min="0" class="form-control form-control-sm" id="new_hours" placeholder="0.00"></td>
                    <td class="text-center text-danger fw-bold"><small>NO TIME OUT</small></td>
                    <td><input type="text" class="form-control form-control-sm" id="new_remarks" placeholder="Remarks"></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm save-new-row">SAVE</a>
                        <a class="btn btn-secondary btn-sm cancel-new-row ms-1">CANCEL</a>
                    </td>
                </tr>`;

            $('#newRowBody').html(newRow);
            $('#newRowTable').show();
            $('#addOTRow').prop('disabled', true);
        });

        // ===== CANCEL NEW ROW =====
        $(document).off('click', '.cancel-new-row').on('click', '.cancel-new-row', function () {
            $('#newRowBody').html('');
            $('#newRowTable').hide();
            $('#addOTRow').prop('disabled', false);
        });

        // ===== SAVE NEW ROW =====
        $(document).off('click', '.save-new-row').on('click', '.save-new-row', function () {
            var empId    = $('#new_empId').val().trim();
            var name     = $('#new_name').val().trim();
            var branch   = $('#new_branch').val().trim();
            var dateFrom = $('#new_dateFrom').val().trim();
            var reason   = $('#new_reason').val().trim();
            var kindOT   = $('#new_kindOT').val();
            var hours    = $('#new_hours').val().trim();
            var remarks  = $('#new_remarks').val().trim();

            if (!empId || !name || !dateFrom || !hours) {
                alert('Emp ID, Name, Date, and OT Hours are required.');
                return;
            }
            if (isNaN(empId) || isNaN(hours)) {
                alert('Emp ID and OT Hours must be numeric.');
                return;
            }

            var $saveBtn = $(this);
            $saveBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                url: 'payInsertOvertime.php',
                method: 'POST',
                data: {
                    empId:    empId,
                    name:     name,
                    branch:   branch,
                    date:     dateFrom,
                    reason:   reason,
                    kindOT:   kindOT,
                    hours:    hours,
                    remarks:  remarks
                },
                success: function (response) {
                    console.log(response);
                    if (response.indexOf('successfully') !== -1) {
                        alert('OT record inserted successfully! The page will now reload.');
                        location.reload();
                    } else {
                        alert('Server error: ' + response);
                        $saveBtn.prop('disabled', false).text('SAVE');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Insert error:', error);
                    alert('Failed to insert record. Please try again.');
                    $saveBtn.prop('disabled', false).text('SAVE');
                }
            });
        });
    }

    // ===== PRINT SUMMARY =====
    $('#printSummaryBtn').on('click', function () {
        var payrollPeriod = '<?php echo $payrollStart; ?> to <?php echo $payrollEnd; ?>';
        var otPeriod      = '<?php echo $startdate; ?> to <?php echo $enddate; ?>';
        var branch        = '<?php echo htmlspecialchars($branch); ?>';
        var tableHtml     = $('#summaryTable').prop('outerHTML');

        var win = window.open('', '_blank');
        win.document.write(
            '<html><head><title>OT Summary</title>' +
            '<style>' +
            'body { font-family: Arial, sans-serif; padding: 20px; }' +
            'h3 { margin-bottom: 4px; }' +
            'p { color: #555; margin-bottom: 12px; font-size: 13px; }' +
            'table { width: 100%; border-collapse: collapse; }' +
            'th, td { border: 1px solid #ccc; padding: 8px 12px; }' +
            'th { background-color: #f0f0f0; text-align: center; }' +
            'td { text-align: center; }' +
            'td:first-child { text-align: left; }' +
            '@media print { button { display: none; } }' +
            '</style></head><body>' +
            '<h3>Total Overtime of Employees</h3>' +
            '<p>Payroll Period: ' + payrollPeriod + '<br>' +
            'OT Period: ' + otPeriod +
            (branch ? '<br>Branch: ' + branch : '') + '</p>' +
            tableHtml +
            '<br><button onclick="window.print()">Print</button>' +
            '</body></html>'
        );
        win.document.close();
    });

// ===== DOWNLOAD CSV =====
    var isNoDownload = <?php echo $isNoDownload ? 'true' : 'false'; ?>;

    $('#downloadCsvBtn').on('click', function () {
        if (isNoDownload) return; // guard — double protection
        var rows = [];
        var headers = [];
        var actionColIndex = -1;

        // Pre-compute action column index ONCE before row iteration
        $('#reporttbl thead th').each(function (i) {
            var text = $(this).text().trim();
            if (text === 'Action') {
                actionColIndex = i;
            } else {
                headers.push('"' + text + '"');
            }
        });
        rows.push(headers.join(','));

        // .to$() converts DataTables nodes to proper jQuery collection
        myTable.rows({ order: 'current' }).nodes().to$().each(function () {
            var cols = [];
            $(this).find('td').each(function (i) {
                if (i !== actionColIndex) {
                    cols.push('"' + $(this).text().trim().replace(/"/g, '""') + '"');
                }
            });
            if (cols.length > 0) {
                rows.push(cols.join(','));
            }
        });

        var csvContent = rows.join('\n');
        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        var url  = URL.createObjectURL(blob);
        var a    = document.createElement('a');
        a.href     = url;
        a.download = 'overtime_records_<?php echo $startdate; ?>_<?php echo $enddate; ?>.csv';
        a.click();
        URL.revokeObjectURL(url);
    });

}); // end of document.ready
</script>

<style>
    /* .dataTables_length { display: none; } */
    .dataTables_length { display: block; }
    .dataTables_filter { margin-right: auto; margin-top: 10px; }
    .dataTables_info   { display: none; }
    .new-ot-row input,
    .new-ot-row select { font-size: 0.85rem; }
    #newRowTable       { margin-top: -1px; }
    #reporttbl td:nth-child(4),
    #reporttbl th:nth-child(4) { white-space: nowrap; min-width: 90px; }
</style>