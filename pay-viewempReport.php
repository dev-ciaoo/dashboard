<?php
include('connection.php');
$date = $_POST['date'];

$startdate = $_POST['startdate'];
$newstartdate = new DateTime($startdate);
$formattedstartdate = $newstartdate->format('F j, Y');

$enddate = $_POST['enddate'];
$newenddate = new DateTime($enddate);
$formattedenddate = $newenddate->format('F j, Y');

$activeTab = $_POST['activeTab'];
$empId = $_POST['empId'];

if($activeTab == 'OB'){
    $sql = "SELECT * from leavetbl 
    WHERE iStatus = 2 AND iCategory = 'Official Business' AND employee_Id = '$empId' AND dateFrom BETWEEN '$startdate' AND '$enddate'";
}else if($activeTab == 'UL'){
    $sql = "SELECT * from leavetbl WHERE iStatus = 2 AND iCategory = 'Unpaid Leave' AND employee_Id = '$empId' AND dateFrom BETWEEN '$startdate' AND '$enddate'";
}else if ($activeTab == 'SL'){
    $sql = "SELECT * from leavetbl WHERE iStatus = 2 AND iCategory = 'Sick Leave' AND employee_Id = '$empId'AND dateFrom BETWEEN '$startdate' AND '$enddate'";
}else if ($activeTab == 'VL'){
    $sql = "SELECT * from leavetbl WHERE iStatus = 2 AND iCategory = 'Vacation Leave' AND employee_Id = '$empId' AND dateFrom BETWEEN '$startdate' AND '$enddate'";
}else if ($activeTab == 'ML'){
    $sql = "SELECT * from leavetbl WHERE iStatus = 2 AND iCategory = 'Mandatory Leave' AND employee_Id = '$empId' AND dateFrom BETWEEN '$startdate' AND '$enddate'";
}else if ($activeTab == 'Lates'){
    $sql = "SELECT * from payroll_time WHERE (latehours > '0' OR time_in > '8:00:00') AND employeeId = '$empId' AND date BETWEEN '$startdate' AND '$enddate'";
}

$result = $con->query($sql);

$tbody = "";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        if($activeTab == 'Lates'){
            $timeID = $row['time_id'];
            $exempt = $row['exempt'];
            $dateFrom = $row["date"];
            $newDateFrom = new DateTime($dateFrom);
            $formattedDateFrom = $newDateFrom->format('F j, Y');
            $tbody .= '<tr>';
            $tbody .= '<td class="text-center">'.$formattedDateFrom. '</td>';
            $tbody .= '<td id="latehrs" class="text-center">'.$row["latehours"].'</td>';
            $tbody .= '<td id="remarks" class="text-center">'.$row["remarks"].'</td>';
            if($exempt != 1){
                $tbody .= '<td class="text-center">
                <a data-id ="'.$timeID.'" class="updateReport btn btn-primary">Update</a>
                <a style="display:none;" data-id ="'.$timeID.'" class="save text-center btn btn-info">SAVE</a>
                <a data-id ="'.$timeID.'" class="exempt btn btn-danger">Exempt</a>
                <a style="display:none;" data-id ="'.$timeID.'" class="done text-center btn btn-info">Done</a>
                <a style="display:none;" data-id ="'.$timeID.'" class="exempted btn btn-success">EXEMPTED</a>
                </td>';
            }else{
                $tbody .= '<td class="text-center">
                <a style="display:none;" data-id ="'.$timeID.'" class="updateReport btn btn-primary">Update</a>
                <a style="display:none;" data-id ="'.$timeID.'" class="save text-center btn btn-info">SAVE</a>
                <a style="display:none;" data-id ="'.$timeID.'" class="exempt btn btn-danger">Exempt</a>
                <a style="display:none;" data-id ="'.$timeID.'" class="done text-center btn btn-info">Done</a>
                <a data-id ="'.$timeID.'" class="exempted btn btn-success">EXEMPTED</a>
                </td>';
            } 
           
            
            $tbody .= '</tr>';
        }else{
            $dateFrom = $row["dateFrom"];
            $newDateFrom = new DateTime($dateFrom);
            $formattedDateFrom = $newDateFrom->format('F j, Y');
    
            $dateTo = $row["dateTo"];
            $newDateTo = new DateTime($dateTo);
            $formattedDateTo = $newDateTo->format('F j, Y');
    
            $tbody .= '<tr>';
            $tbody .= '<td class="text-center">'.$formattedDateFrom. ' to ' .$formattedDateTo.'</td>';
            $tbody .= '<td class="text-center">'.$row["workingDays"].'</td>';
            $tbody .= '<td class="text-center">'.$row["iMessage"].'</td>';
            $tbody .= '</tr>';
        }     
    }
} else {
$tbody .= '<tr><td colspan="4" >No Result</td></tr>';
}

$con->close();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div>
    <p style="font-family:italic;">Record between <?php echo $formattedstartdate.' to '.$formattedenddate; ?> </p>
</div>

<table class="table table-bordered">
<thead>
    <tr>
        <th>Date</th>
        <th>Total Hours/Day</th>
        <th>Reason</th>
        <?php   if($activeTab == 'Lates'){ ?>
        <th>Action</th>
        <?php } ?>
    </tr>
</thead>

<tbody>
    <?php echo $tbody; ?>
</tbody>

</table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script>

$(document).off('click', '.updateReport').on('click', '.updateReport', function(e) {
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    
    // ✅ FIX: Store the current exempt status before editing
    var currentExempt = $row.find('.exempted').is(':visible') ? '1' : '0';
    
    $row.find('#latehrs, #remarks').attr('contenteditable', true).css('border', 'solid 2px');
    $(this).css('display', 'none');
    $row.find('.save').css('display', '');

    $row.find('.save').off('click').on('click', function() {
        var newlatehrs = $row.find('#latehrs').text();
        var newremarks = $row.find('#remarks').text();
        var $saveBtn = $(this);
        
        $.ajax({
            url: 'pay-updatelate.php',
            method: 'GET',
            data: {
                newlatehrs: newlatehrs,
                newremarks: newremarks,
                id: id,
                exempt: currentExempt  // ✅ FIX: Include exempt status
            },
            success: function(response) {
                $row.find('#latehrs, #remarks').attr('contenteditable', false).css('border', 'solid 1px');
                $row.find('#latehrs, #remarks').attr('contenteditable', false).css('border-color', 'rgb(222, 226, 230)');
                $row.find('.updateReport').css('display', '');
                    $saveBtn.css('display', 'none');
                    console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Error updating data: ', error);
            }
        });
    });
});

$(document).off('click', '.exempt').on('click', '.exempt', function(e) {
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    $row.find('#remarks').attr('contenteditable', true).css('border', 'solid 2px');
    $(this).css('display', 'none');
    $row.find('.done').css('display', '');

    $row.find('.done').off('click').on('click', function() {
        var newlatehrs = $row.find('#latehrs').text();
        var newremarks = $row.find('#remarks').text();
        var updateReport = $row.find('.updateReport');  // ✅ FIX: Changed from #updateReport to .updateReport
        var exempt = "1";
        var $done = $(this);
        $.ajax({
            url: 'pay-updatelate.php',
            method: 'GET',
            data: {
                newlatehrs: newlatehrs,
                newremarks: newremarks,
                id: id,
                exempt : exempt
            },
            success: function(response) {
                $row.find('#remarks').attr('contenteditable', false).css('border', 'solid 1px');
                $row.find('#remarks').attr('contenteditable', false).css('border-color', 'rgb(222, 226, 230)');
                $row.find('.exempted').css('display', '');
                    $done.css('display', 'none');
                    $done.css('display', 'none');
                    $(updateReport).css('display', 'none');
                    console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Error updating data: ', error);
            }
        });
    });
});

$(document).off('click', '.exempted').on('click', '.exempted', function(e) {
    var id = $(this).data('id');
    var $row = $(this).closest('tr');
    var confirmed = confirm('Are you sure you want unexempt this?');

    if (confirmed) {
        var newlatehrs = $row.find('#latehrs').text();
        var newremarks = $row.find('#remarks').text();
        var updateReport = $row.find('.updateReport');  // ✅ FIX: Changed from #updateReport to .updateReport
        var exemptBtn = $row.find('.exempt');  // ✅ FIX: Changed from #exempt to .exempt
        var exempt = "0";
        var $done = $(this);
        $.ajax({
            url: 'pay-updatelate.php',
            method: 'GET',
            data: {
                newlatehrs: newlatehrs,
                newremarks: newremarks,
                id: id,
                exempt : exempt
            },
            success: function(response) {
                $row.find('#remarks').attr('contenteditable', false).css('border', 'solid 1px');
                $row.find('#remarks').attr('contenteditable', false).css('border-color', 'rgb(222, 226, 230)');
                $row.find('.exempted').css('display', 'none');
                    $done.css('display', 'none');
                    $done.css('display', 'none');
                    $(updateReport).css('display', '');
                    $(exemptBtn).css('display', '');
                    console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Error updating data: ', error);
            }
        });
    }else{
        e.preventDefault();
    }
        
});

</script>

<style>

</style>