<?php
include('connection.php');
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$dateFROM = mysqli_real_escape_string($con, $_POST['dateFROM'] ?? '');
$dateTO = mysqli_real_escape_string($con, $_POST['dateTO'] ?? '');
$selectBranch = mysqli_real_escape_string($con, $_POST['selectBranch'] ?? '');

$sql = "SELECT * FROM leavetbl WHERE iStatus NOT IN (1, 4) AND iAbsent <> 0";

// branch & date filters
if ($dateFROM && $dateTO && $selectBranch) {
    $sql .= " AND (
                    dateFrom <= '$dateTO'
                    AND dateTo >= '$dateFROM'
                ) 
                    AND iBranch = '$selectBranch'";
}

// $sql .= " AND dateFrom BETWEEN '$dateFROM' AND '$dateTO' AND iBranch = '$selectBranch'";

// category/status filters
$filters = [];
if (!empty($_POST['leaveCheck'])) $filters[] = "iCategory LIKE '%" . $_POST['leaveCheck'] . "%'";
if (!empty($_POST['overCheck'])) $filters[] = "iCategory = '" . $_POST['overCheck'] . "'";
if (!empty($_POST['obCheck'])) $filters[] = "iCategory = '" . $_POST['obCheck'] . "'";
if (!empty($_POST['disapprovedCheck'])) $filters[] = "iStatus = 3";

if ($filters) {
    $sql .= " AND (" . implode(' OR ', $filters) . ")";
}

$sql .= " ORDER BY id DESC";

$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<tr>
            <td>' . htmlspecialchars($row['iName']) . '</td>
            <td>' . '2020-' . str_pad(htmlspecialchars($row['employee_Id']), 3, '0', STR_PAD_LEFT) . '</td>
            <td>' . htmlspecialchars($row['iBranch']) . '</td>
            <td>' . htmlspecialchars($row['iCategory']) . '</td>
            <td>' . date('m-d-Y', strtotime($row['dateFrom'])) . '</td>
            <td>' . date('m-d-Y', strtotime($row['dateTo'])) . '</td>
            <td>' . htmlspecialchars($row['timeFrom']) . '</td>
            <td>' . htmlspecialchars($row['timeTo']) . '</td>
            <td>' . htmlspecialchars($row['totalHours']) . '</td>
            <td>' . htmlspecialchars($row['iMessage']) . '</td>
            <td>' . htmlspecialchars($row['iRemarks']) . '</td>
            <td>' . htmlspecialchars($row['approver']) . '</td>
            <td>' . htmlspecialchars($row['timeApproved']) . '</td>';
			if($_SESSION['userid'] == 8) {
				echo '<td style="display:flex; align-items:center; gap:5px;">
							<a href="javascript:void(0);" data-id="' . $row['id'] . '" class="btn btn-info btn-sm editbtn">
								<span class="fa-regular fa-pen-to-square"></span>
							</a>
							<a href="javascript:void(0);" data-id="' . $row['id'] . '" class="btn btn-danger btn-sm deleteBtn">
								<span class="fa-regular fa-trash-can"></span>
							</a>
						</td>';
			}else{
				echo '<td>' . ' ' . '</td>';
			}
            // <td style="display:flex; align-items:center; gap:5px;">
            //     <a href="javascript:void(0);" data-id="' . $row['id'] . '" class="btn btn-info btn-sm editbtn">
            //         <span class="fa-regular fa-pen-to-square"></span>
            //     </a>
            //     <a href="javascript:void(0);" data-id="' . $row['id'] . '" class="btn btn-danger btn-sm deleteBtn">
            //         <span class="fa-regular fa-trash-can"></span>
            //     </a>
            // </td>
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="14" class="text-center">No Records Found!</td></tr>';
}
?>
