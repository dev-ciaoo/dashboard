<?php
include('connection.php');

$output = array();
$selectBranch = $_POST['branch'];
$selectBranch = mysqli_real_escape_string($con, $selectBranch);

$sql = " SELECT l.*, d.* FROM duecollection as d 
              JOIN loan as l ON l.loan_Id = d.duecLoanId 
			  ";
// $sql = "SELECT * FROM duecollection";

// $columns = array(
// 	0 => 'id',
// 	1 => 'duecBranch',
// 	2 => 'duecProdID',
// 	3 => 'duecBName',
// 	4 => 'duecAddress',
//     5 => 'duecContact',
// 	6 => 'duecStatus',
// 	7 => 'duecProdType',
// 	8 => 'duecLoanG',
// 	9 => 'duecLoanM',
// 	10 => 'duecDueDate',
// 	11 => 'duecDLate',
// 	12 => 'duecPrincipalAmount',
// 	13 => 'duecPrincipalBal',
// 	14 => 'duecPrincipalDue',
// 	15 => 'duecInterest',
// 	16 => 'duectPenalty',
// 	17 => 'duecTotalAmountDue',
// 	18 => 'duecLastUnpaid',
// 	19 => 'dStatus',
// 	20 => 'dateImported'
// );

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (d.duecBranch like '%" . $search_value . "%'";
	$sql .= " OR d.duecProdID like '%" . $search_value . "%'";
	$sql .= " OR d.duecBName like '%" . $search_value . "%'";
	$sql .= " OR d.duecStatus like '%" . $search_value . "%'";
	$sql .= " OR d.duecAddress like '%" . $search_value . "%'";
	$sql .= " OR d.duecProdType like '%" . $search_value . "%')";
	
	if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
        $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
    } else if ($_SESSION['bankposition'] == 'LOAN Assistant' && $_SESSION['address'] != 'Head Office') {
        $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
    } else {
        if ($_SESSION['department'] == 1 || $_SESSION['department'] == 15) {
            if (!empty($selectBranch)) {
				if($selectBranch != 'Head Office'){
					$sql .= " AND l.branch = '$selectBranch'";
				}else{
					$sql .= " AND l.branch = 'Head Office'";
				}
            }
        }else{
            $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
        }
    }
}else {
	if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
        $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
    }else if ($_SESSION['bankposition'] == 'LOAN Assistant' && $_SESSION['address'] != 'Head Office') {
        $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
    }  else {
        if ($_SESSION['department'] == 1 || $_SESSION['department'] == 15) {
            if (!empty($selectBranch)) {
				if($selectBranch != 'Head Office'){
                	$sql .= " AND l.branch = '$selectBranch'";
				}else{
					$sql .= " AND l.branch = '$selectBranch'";
				}
            }
        }else{
            $sql .= " AND (l.branch = '" . $_SESSION['address'] . "')";
        }
    }
}

if (isset($_POST['order'])) {
    $column_index = intval($_POST['order'][0]['column']);
    $order = $_POST['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';

	$columns = [
		0 => 'duecBranch',
		2 => 'duecBName',
		5 => 'duecStatus',
		6 => 'duecProdType',
		10 => 'duecDLate'
	];

	if(isset($columns[$column_index])){
		$column_name = $columns[$column_index];

		$sql .= " ORDER BY d.$column_name $order";
	}
}else{
	$sql .= " ORDER BY d.duecDLate ASC ";
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
            echo '<tr>';
				echo    '<td>' . $row['duecBranch'] . '</td>';
				echo    '<td>' . $row['duecProdID'] . '</td>';
				echo    '<td>' . $row['duecBName'] . '</td>';
				echo    '<td>' . $row['duecAddress'] . '</td>';
				echo    '<td>' . $row['duecContact'] . '</td>';
				echo	'<td>';
						if($row['duecStatus'] == 'a'){
							echo '';
						}else{
							echo $row['duecStatus'];
						}
				echo 	'</td>';
				echo    '<td>' . $row['duecProdType'] . '</td>';
				echo    '<td>' . $row['duecLoanG'] . '</td>';
				echo    '<td>' . $row['duecLoanM'] . '</td>';
				echo    '<td>' . $row['duecDueDate'] . '</td>';
				echo    '<td>' . $row['duecDLate'] . '</td>';
				echo    '<td>' . number_format($row['duecPrincipalBal'], 2, '.', ',') . '</td>';
				echo    '<td>' . number_format($row['duecPrincipalDue'], 2, '.', ',') . '</td>';
				echo    '<td>' . number_format($row['duecInterest'], 2, '.', ',') . '</td>';
				echo    '<td>' . number_format($row['duecPenalty'], 2, '.', ',') . '</td>';
				echo    '<td>' . number_format($row['duecTotalAmountDue'], 2, '.', ',') . '</td>';
				echo    '<td>' . $row['duecLastUnpaid'] . '</td>';
				echo    '<td>' . $row['remarks'] . '</td>';
				echo    '<td>';
						if($row['letterStatus'] == 0){
							if($row['duecDLate'] == 0){
								echo 'INCOMING 1 WEEK BEFORE';
							}else{
								echo 'INCOMING DUE';
							}
						}else if($row['letterStatus'] == 1) {
							echo '1st Demand Letter';
						}else if($row['letterStatus'] == 2) {
							echo '2nd Demand Letter';
						}else if($row['letterStatus'] == 3) {
							echo '3rd Demand Letter';
						}else if($row['letterStatus'] == 4) {
							echo 'Final Demand Letter';
						}else if($row['letterStatus'] == 5) {
							echo 'RECOMMENDED FOR FORECLOSURE';
						}else if($row['letterStatus'] == 6) {
							echo 'PASTDUE TO LITIGATION';
						}else if($row['letterStatus'] == 7) {
							echo 'TRANSFER FROM LITIGATION TO ROPA';
						}else if($row['letterStatus'] == 8) {
							echo 'ANNOTATION OF COS';
						}else if($row['letterStatus'] == 9) {
							echo 'PREPARE TO CONSOLIDATION IN THE NAME OF THE BANK';
						}else{
							echo $row['letterStatus'];
						}
				echo '</td>';
				echo '<td>';
						if($_SESSION['department'] == 1 || $_SESSION['username'] == 'jalvarez'){
						 echo "<button class='btn btn-primary btn-sm btnCheckC'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>";
						}else{
							echo '';
						}
				echo '</td>';
						

            echo '</tr>';
        }  
    }else {
        echo 'No Records Found!';
    }
}else{
	while ($row = mysqli_fetch_assoc($query)) {
		$sub_array = array();
		$sub_array[] = $row['duecBranch'];
		$sub_array[] = $row['duecProdID'];
		$sub_array[] = $row['duecBName'];
		$sub_array[] = $row['duecAddress'];
		$sub_array[] = $row['duecContact'];
		if($row['duecStatus'] == 'a'){
			$sub_array[] = '';
		}else{
			$sub_array[] = $row['duecStatus'];
		}
		$sub_array[] = $row['duecProdType'];
		$sub_array[] = $row['duecLoanG'];
		$sub_array[] = $row['duecLoanM'];
		$sub_array[] = $row['duecDueDate'];
		$sub_array[] = $row['duecDLate'];
		$sub_array[] = number_format($row['duecPrincipalBal'], 2, '.', ',');
		$sub_array[] = number_format($row['duecPrincipalDue'], 2, '.', ',');
		$sub_array[] = number_format($row['duecInterest'], 2, '.', ',');
		$sub_array[] = number_format($row['duecPenalty'], 2, '.', ',');
		$sub_array[] = number_format($row['duecTotalAmountDue'], 2, '.', ',');
		$sub_array[] = $row['duecLastUnpaid'];
		$sub_array[] = $row['remarks'];
		if($row['letterStatus'] == 0){
			if($row['duecDLate'] == 0){
				$sub_array[] = 'INCOMING 1 WEEK BEFORE';
			}else{
				$sub_array[] = 'INCOMING DUE';
			}
		}else if($row['letterStatus'] == 1) {
			$sub_array[] = '1st Demand Letter';
		}else if($row['letterStatus'] == 2) {
			$sub_array[] = '2nd Demand Letter';
		}else if($row['letterStatus'] == 3) {
			$sub_array[] = '3rd Demand Letter';
		}else if($row['letterStatus'] == 4) {
			$sub_array[] = 'Final Demand Letter';
		}else if($row['letterStatus'] == 5) {
			$sub_array[] = 'RECOMMENDED FOR FORECLOSURE';
		}else if($row['letterStatus'] == 6) {
			$sub_array[] = 'PASTDUE TO LITIGATION';
		}else if($row['letterStatus'] == 7) {
			$sub_array[] = 'TRANSFER FROM LITIGATION TO ROPA';
		}else if($row['letterStatus'] == 8) {
			$sub_array[] = 'ANNOTATION OF COS';
		}else if($row['letterStatus'] == 9) {
			$sub_array[] = 'PREPARE TO CONSOLIDATION IN THE NAME OF THE BANK';
		}else{
			$sub_array[] = $row['letterStatus'];
		}

		if($_SESSION['username'] == 'ctborgonia' || $_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'jalvarez'){
			$sub_array[] = "<button class='btn btn-primary btn-sm btnCheckC'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>
							";
		}
		else{
			$sub_array[] = '';
		}

		$data[] = $sub_array;
	}
}


$output = array(
	'draw' => intval($_POST['draw']),
	'recordsTotal' => $count_rows,
	'recordsFiltered' => $count_rows,
	'data' => $data,
);
echo json_encode($output);
?>
