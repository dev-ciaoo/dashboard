<?php include('connection.php');

date_default_timezone_set('Asia/Manila');
$dateTodayy = date('F j, Y \a\t g:i A');
$recordUserId = $_SESSION['userid'];
$recordName = $_SESSION['fullname'];

// $amlcVal = "SELECT recordDateTime, recordUserId FROM `amlc`";
// $amlcQuery = mysqli_query($con, $amlcVal); 
// $row = mysqli_fetch_assoc($amlcQuery);
// if($recordUserId != $row['userid'] && $dateTodayy != $row['recordDateTime']){
    
    $recordSql = "INSERT INTO `amlc` (`recordUserId`, `recordName`, `recordDateTime`) VALUES ('$recordUserId', '$recordName', '$dateTodayy')";
    $recordQuery = mysqli_query($con, $recordSql);
    $lastIdd = mysqli_insert_id($con);

    if($recordQuery == true){
        $data = array(
            'status'=>'success',
        
        );
            echo json_encode($data);
    }
    else{
        $data = array(
            'status'=>'failed',
        
        );

        echo json_encode($data);
    }
// }
// else {
//     $data = array(
//         'status'=>'double insert error',
    
//     );
    
//     echo json_encode($data);
// }

?>