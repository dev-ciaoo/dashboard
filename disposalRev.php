<?php

include('connection.php');
header('Content-Type: application/json');

date_default_timezone_set('Asia/Manila');
$dateToday = date('F j, Y @ h:i A');

    $id = $_POST['hiddenId'];
    $stats = 1;

    $appraiserName = $_POST['iAppraiser'];
    $appraisalDate = $_POST['iDateAppraisal'];
    $appraisalVal = (float) str_replace(',', '', $_POST['iAppraisalVal']);

    $reviewedBy = $_POST['reviewedBy'];
    $reviewedDate = date('m-d-Y @ h:i A');


    $updateDR = "UPDATE `disposal` SET `appraiserName` = ?, `appraisalDate` = ?, `appraisalVal` = ?, `stats` = ?, `reviewedBy` = ?, `reviewedDate` = ?
                                                                                                                                                    WHERE `id` = ?;
                ";
    $stmt = $con->prepare($updateDR);

    if (!$stmt) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to prepare statement',
            'debug' => $con->error // for Dev only
        ]);
        exit;
    }

    $stmt->bind_param("ssdissi", $appraiserName, $appraisalDate, $appraisalVal, $stats, $reviewedBy, $reviewedDate, $id
                    );

    if ($stmt->execute()) {
        echo json_encode([
            'status'  => 'success',
            'message' => 'Disposal Reviewed Successfully.',
            'data' => [
                'appraisalVal' => $appraisalVal
                // 'date' => $preparedDate
            ]
        ]);
    } else {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Database execution failed',
            'debug' => $stmt->error // enable only in development
        ]);
    }

    $stmt->close();
    $con->close();
    exit;
    ?>
