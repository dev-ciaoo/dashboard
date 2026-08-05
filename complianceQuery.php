<?php
include('connection.php');

if (isset($_POST['instCode'])) {
    $search1 = trim($_POST['instCode']);

    date_default_timezone_set('Asia/Manila');
    $dateTodayy = date('F j, Y \a\t g:i A');
    $recordUserId = $_SESSION['userid'] ?? ''; // Ensure session variable is set
    $recordName = $_SESSION['fullname'] ?? ''; // Ensure session variable is set

    // Prepare and sanitize search terms
    $searchTerms = explode(' ', $search1);
    $searchTermBits = [];
    foreach ($searchTerms as $term) {
        $term = trim($term);
        if (!empty($term)) {
            $searchTermBits[] =  "registrationName LIKE ?";
        }
    }

    if (!empty($search1)) {
        $sql = "SELECT * FROM `compliance` WHERE (institutionCode = ?  OR (" . implode(' AND ', $searchTermBits) . ")) AND sanctionStats <> 1";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            $bindParams = array_merge([$search1], array_fill(0, count($searchTermBits), "%$search1%"));
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($bindParams)), ...$bindParams);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            die('Error: ' . mysqli_error($con)); // Query error handling
        }

        if (mysqli_num_rows($result) > 0) {
            echo '<table style="width:80%; position:relative; top:100px;" class="table" id="tablelist">';
            echo '<tr>
                      <th width="170px;">Institution Code</th>
                      <th>Registration Name</th>
                      <th>Status</th>
                      <th>As Of</th>
                      <th>Reso. #</th>
                      <th>Requirements</th>
                  </tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                $statusClass = '';
                switch ($row['status']) {
                    case 2:
                        $statusClass = 'hiLi';
                        break;
                    case 3:
                        $statusClass = 'hiLi2';
                        break;
                    case 4:
                        $statusClass = 'hiLi3';
                        break;
                }
                ?>
                <tr class="<?php echo htmlspecialchars($statusClass); ?>">    
                    <td><?php echo htmlspecialchars(strtoupper($row['institutionCode'])); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($row['registrationName'])); ?></td>
                    <td><?php
                        switch ($row['status']) {
                            case 1:
                                echo 'AMLC';
                                break;
                            case 2:
                                echo 'TERRORIST';
                                break;
                            case 3:
                                echo 'PEP';
                                break;
                            default:
                                echo 'MONEY LAUNDERER';
                        }
                    ?></td>
                    <td><?php echo htmlspecialchars($row['aoDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['resoNum']); ?></td>
                    <td><?php
                        switch ($row['status']) {
                            case 1:
                                echo 'Cert of Registration from AMLA, BIZ Permit, DTI, ITR, ID';
                                break;
                            case 2:
                                echo "Can't Open an Account";
                                break;
                            case 3:
                                echo "Other source of Income";
                                break;
                            default:
                                echo "Can't Open an Account";
                        }
                    ?></td>
                </tr>
                <?php
            }
            echo '</table>';
        } else {
            echo '<span style="position: relative; font-size: 150%; margin-left: auto; margin-right: auto; margin-top: 200px;">No Records Found!</span>';
            echo '<script>$("#tablelist").addClass("hide");</script>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Input something to search");</script>';
        echo '<script>$("#tablelist").addClass("hide");</script>';
    }

    // Secure insert query using prepared statement
    $recordSql = "INSERT INTO `amlc` (`recordUserId`, `recordName`, `recordSearch`, `recordDateTime`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $recordSql);
    mysqli_stmt_bind_param($stmt, 'ssss', $recordUserId, $recordName, $search1, $dateTodayy);
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Error: ' . mysqli_error($con); // Check for insertion errors
    }
    mysqli_stmt_close($stmt);
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
    table, th, td {
        border: 1px solid black;
        margin-left: auto;
        margin-right: auto;
        font-size: 13px;
        text-align: center;
    }
    .hiLi {
        background-color: #FFA07A !important;
    }
    .hiLi2 {
        background-color: #EEE8AA !important;
    }
    .hiLi3 {
        background-color: #FF6347 !important;
    }
    .hide {
        visibility: hidden;
    }
    </style>
</head>
<body>
</body>
</html>
