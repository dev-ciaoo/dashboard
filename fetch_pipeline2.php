<?php
include('connection.php');

$output = array();
$selectBranch = $_POST['branch'];

$selectBranch = mysqli_real_escape_string($con, $selectBranch);
$sql = "SELECT l.*, c.*, m.*, s.* FROM loan AS l 
                                            LEFT JOIN corporation AS c ON l.loan_Id = c.corpLoanId 
                                            LEFT JOIN microfinance AS m ON l.loan_Id = m.mLoan_Id
                                            LEFT JOIN salaryloan AS s ON l.loan_Id = s.salaryLoanId
                                            LEFT JOIN individual AS i ON l.loan_Id = i.indivLoanId 
                                            WHERE l.loanType <> 'CONSOLIDATED DATA'
                                                AND l.pipeStats <> 3 
                                                AND l.writeOff <> 1
                                                AND l.branch <> '' 
                                                AND (i.promNoteI = '' OR i.promNoteI IS NULL)
                                                AND (i.promNoteEndI = '' OR i.promNoteEndI IS NULL)
                                                AND (c.promNoteC = '' OR c.promNoteC IS NULL)
                                                AND (c.promNoteEndC = '' OR c.promNoteEndC IS NULL)
                                                AND (m.promissoryNoteM = '' OR m.promissoryNoteM IS NULL)
                                                AND (s.promissoryNoteS = '' OR s.promissoryNoteS IS NULL)
                                                -- AND (c.signedLoanMemoC = '' OR c.signedLoanMemoC IS NULL)
                                                -- AND (m.loanApprovalSheet = '' OR m.loanApprovalSheet IS NULL)
                                                -- AND (s.loanAppMemo = '' OR s.loanAppMemo IS NULL)
        ";

$columns = array(
    0 => 'branch',
    1 => 'customerFullName',
    2 => 'dateCreated',
    4 => 'salaryType',
    5 => 'amountApplied',
    6 => 'terms',
    7 => 'interestRate',
    8 => 'pipeRemarks',
    9 => 'pipeStats'
);


$search_value = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

if ($search_value) {

    // Including l.pipeStats = 2 if it matches the search criteria
    $sql .= "AND (l.customerFullName LIKE '%" . $search_value . "%' 
                   OR l.salaryType LIKE '%" . $search_value . "%'
                   OR l.productID LIKE '%" . $search_value . "%' )";
                   
    if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
        if($_SESSION['username'] !== 'mruazol'){
            $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
        }else{
            $sql .= " AND (l.branch IN ('Ternate', 'Maragondon'))";
        }
    } else if ($_SESSION['bankposition'] == 'LOAN Assistant' && $_SESSION['address'] != 'Head Office') {
        $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
    } else {
        if ($_SESSION['department'] == 1 || $_SESSION['department'] == 15) {
            if (!empty($selectBranch)) {
                $sql .= " AND l.branch = '$selectBranch'";
            }
        }else{
            $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
        }
    }
} else {
    $sql = "SELECT l.*, c.*, m.*, s.* FROM loan AS l 
                                                LEFT JOIN corporation AS c ON l.loan_Id = c.corpLoanId 
                                                LEFT JOIN microfinance AS m ON l.loan_Id = m.mLoan_Id
                                                LEFT JOIN salaryloan AS s ON l.loan_Id = s.salaryLoanId
                                                LEFT JOIN individual AS i ON l.loan_Id = i.indivLoanId 
                                                WHERE l.loanType <> 'CONSOLIDATED DATA' 
                                                    AND l.writeOff <> 1
                                                    AND l.branch <> ''
                                                    AND l.pipeStats NOT IN (2, 3)
                                                    AND (i.promNoteI = '' OR i.promNoteI IS NULL)
                                                    AND (i.promNoteEndI = '' OR i.promNoteEndI IS NULL)
                                                    AND (c.promNoteC = '' OR c.promNoteC IS NULL)
                                                    AND (c.promNoteEndC = '' OR c.promNoteEndC IS NULL)
                                                    AND (m.promissoryNoteM = '' OR m.promissoryNoteM IS NULL)
                                                    AND (s.promissoryNoteS = '' OR s.promissoryNoteS IS NULL)
                                                    -- AND (c.signedLoanMemoC = '' OR c.signedLoanMemoC IS NULL)
                                                    -- AND (m.loanApprovalSheet = '' OR m.loanApprovalSheet IS NULL)
                                                    -- AND (s.loanAppMemo = '' OR s.loanAppMemo IS NULL)
            ";

    // No search value, default filtering
    if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
        if($_SESSION['username'] !== 'mruazol'){
            $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
        }else{
            $sql .= " AND (l.branch IN ('Ternate', 'Maragondon'))";
        }
    }else if ($_SESSION['bankposition'] == 'LOAN Assistant' && $_SESSION['address'] != 'Head Office') {
        $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
    } else {
        if ($_SESSION['department'] == 1 || $_SESSION['department'] == 15 || $_SESSION['userid'] == 19 || $_SESSION['userid'] == 16 || $_SESSION['userid'] == 29) {
            if (!empty($selectBranch)) {
                $sql .= " AND l.branch = '$selectBranch'";
            }
        }else{
            $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
        }
    }
}

if (isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY l." . $columns[$column_name] . " " . $order . "";
}
else{
	$sql .= "ORDER BY l.customerFullName ASC, l.loan_Id";
}

if ($_POST['length'] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$limit_condition_sql = $sql;
	$limit_condition_sql .= " LIMIT  " . $start . ", " . $length . "";
}

$query = mysqli_query($con, $limit_condition_sql);
$count_query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($count_query);
$data = array();
if (!empty($selectBranch)) {
    
    // Fetch the count of rows
    $count_rows = mysqli_num_rows($count_query);

    $tbody= '';
    if ($count_rows > 0) {
        while ($row = mysqli_fetch_assoc($count_query)) {
            $dateCreated = new DateTime($row['dateCreated']);
            $today = new DateTime(); // Current date
            $interval = $today->diff($dateCreated);
            $daysAgo = $interval->days; // Total days difference

            $daysAgoFormatted = number_format($daysAgo);
            echo '<tr>';
            echo    '<td>' . $row['branch'] . '</td>';
            echo    '<td>' . $row['customerFullName'] . '</td>';
            echo    '<td>' . $row['dateCreated'] . '</td>';
            echo    '<td>' . $daysAgoFormatted = number_format($daysAgo) . '</td>';
            echo    '<td>' . $row['salaryType'] . '</td>';
            echo    '<td>' . number_format($row['amountApplied'], 2, '.', ',') . '</td>';
            echo    '<td>' . $row['terms'] . '</td>';
            echo    '<td>' . $row['interestRate'] . '</td>';
            echo    '<td>' . $row['pipeRemarks'] . '</td>';
            echo    '<td>';
            if($row['pipeStats'] == 2){
                echo '<span style="background: #FF6347; border-radius: 10px;">&nbsp;<b>Declined&nbsp;</b></span>';
            }elseif($row['pipeStats'] == 1){
                echo '<span style="background: #EEE8AA; border-radius: 10px;">&nbsp;<b>Followed-Up</b>&nbsp;</span>';
            }else{
                echo '<span style="background: #98FB98; border-radius: 10px;">&nbsp;<b>Active</b>&nbsp;</span>';
            }
            echo '</td>';
            echo    "<td><button style='margin-top: 2px;' class='btn btn-info btn-sm btnRemarks' name='btnRemarks'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='remind'  type='button'>REMARKS</button>
						<button style='margin-top: 2px;' class='btn btn-warning btn-sm btnFollowUp'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='followup'  type='button'>FOLLOW UP</button>
						<button style='margin-top: 2px;' class='btn btn-danger btn-sm btnDecline'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='decline'  type='button'>DECLINE</button></td>";
            echo '</tr>';
        }  
    }
}else{
	while ($row = mysqli_fetch_assoc($query)) {
		$sub_array = array();
		$sub_array[] = $row['branch'];
		$sub_array[] = $row['customerFullName'];
        if($row['dateCreated'] !== ''){
            $dateCreated = new DateTime($row['dateCreated']);
            $today = new DateTime(); // Current date
            $interval = $today->diff($dateCreated);
            $daysAgo = $interval->days; // Total days difference

            $daysAgoFormatted = number_format($daysAgo);

            $sub_array[] = $dateCreated->format("F j, Y");
        }else{
            $sub_array[] = '';
        }  
        if($row['dateCreated'] !== ''){
            $dateCreated = new DateTime($row['dateCreated']);
            $today = new DateTime(); // Current date
            $interval = $today->diff($dateCreated);
            $daysAgo = $interval->days; // Total days difference

            $daysAgoFormatted = number_format($daysAgo);

            $sub_array[] = $dateCreated->format("") . $daysAgoFormatted . " Days";
        }else{
            $sub_array[] = '';
        }  
		$sub_array[] = $row['salaryType'];
		$sub_array[] = number_format($row['amountApplied'], 2, '.', ',');
		$sub_array[] = $row['terms'];
		$sub_array[] = $row['interestRate'];
		$sub_array[] = $row['pipeRemarks'];
		if($row['pipeStats'] == 2){
			$sub_array[] = '<span style="background: #FF6347; border-radius: 10px;">&nbsp;<b>Declined&nbsp;</b></span>';
		}elseif($row['pipeStats'] == 1){
			$sub_array[] = '<span style="background: #EEE8AA; border-radius: 10px;">&nbsp;<b>Followed-Up</b>&nbsp;</span>';
		}else{
			$sub_array[] = '<span style="background: #98FB98; border-radius: 10px;">&nbsp;<b>Active</b>&nbsp;</span>';
		}
		$sub_array[] = "<button style='margin-top: 2px;' class='btn btn-info btn-sm btnRemarks' name='btnRemarks'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='remind'  type='button'>REMARKS</button>
						<button style='margin-top: 2px;' class='btn btn-warning btn-sm btnFollowUp'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='followup'  type='button'>FOLLOW UP</button>
						<button style='margin-top: 2px;' class='btn btn-danger btn-sm btnDecline'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='decline'  type='button'>DECLINE</button>
						";
	
		$data[] = $sub_array;
	}

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsTotal' => $count_rows,
        'recordsFiltered' => $count_rows,
        'data' => $data,
    );

    echo json_encode($output);
}


// echo json_encode($output);

?>