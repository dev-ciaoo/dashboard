<?php

include('connection.php');
header('Content-Type: application/json');

date_default_timezone_set('Asia/Manila');
$dateToday = date('F j, Y @ h:i A');

    $id = $_POST['hiddenId'];
    $stats = 3;

    $approvedBy = $_POST['approvedBy'];
    $approvedDate = date('m-d-Y @ h:i A');


    $updateDR = "UPDATE `disposal` SET `approvedBy` = ?, `approvedDate` = ?, `stats` = ?
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

    $stmt->bind_param("ssii", $approvedBy, $approvedDate, $stats, $id
                    );

    if ($stmt->execute()) {
        echo json_encode([
            'status'  => 'success',
            'message' => 'Disposal Approved Successfully.',
            'data' => [
                'approvedBy' => $approvedBy
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
