<?php

include('connection.php');
header('Content-Type: application/json');

date_default_timezone_set('Asia/Manila');
$dateToday = date('F j, Y @ h:i A');

    $userId = $_POST['iUserId'];
    $empId = $_POST['iEmpId'];
    $fullName = $_POST['iFullName'];
    $branch = $_POST['iBranch'];
    $position = $_POST['iPosition'];
    $department = $_POST['iDepartment'];
    $reasonDisposal = $_POST['reasonDisposal'];

    $ffeCategory = $_POST['iiCategoryName'];
    $ffeOther = $_POST['iOthers'];
    $ffeDatePurchased = $_POST['iDatePurchased'];
    $ffeDisc = $_POST['inventoryName'];
    $ffePurchaseVal = (float) str_replace(',', '', $_POST['iPurchasedVal']);
    $ffeCondition = $_POST['iCondition'];
    $ffeRemarks = $_POST['iRemarks'];

    $appraiserName = $_POST['iAppraiser'];
    $appraisalDate = $_POST['iDateAppraisal'];
    $appraisalVal = (float) str_replace(',', '', $_POST['iAppraisalVal']);

    $bidderName = $_POST['iBidderName'];
    $bidStartDate = $_POST['iStartBidding'];
    $bidEndDate = $_POST['iEndBidding'];
    $bidderAddress = $_POST['iBiddingAddress'];
    $bidAmount = (float) str_replace(',', '', $_POST['iBidAmount']);
    $bidderContact = $_POST['iBiddingContact'];
    $dateAward = $_POST['iDateAward'];
    $certSale = $_POST['iCertSale'];
    $releaseDate = $_POST['iReleaseDate'];
    $orNumber = $_POST['iOR'];

    $preparedBy = $_POST['preparedBy'];
    $preparedDate = date('m-d-Y @ h:i A');


    $insertDR = "INSERT INTO disposal (dateToday, userId, empId, fullName, branch, position, 
                                        department, reasonDisposal, ffeCategory, ffeOther, ffeDatePurchased, ffeDisc, 
                                        ffePurchaseVal, ffeCondition, ffeRemarks, preparedBy, preparedDate)
                                VALUES 
                                        (?, ?, ?, ?, ?, ?,
                                        ?, ?, ?, ?, ?, ?,
                                        ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($insertDR);

    if (!$stmt) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to prepare statement',
            'debug' => $con->error // for Dev only
        ]);
        exit;
    }

    $stmt->bind_param("siisssssssssdssss", $dateToday, $userId, $empId, $fullName, $branch, $position, $department, $reasonDisposal,
                                        $ffeCategory, $ffeOther, $ffeDatePurchased, $ffeDisc, $ffePurchaseVal, $ffeCondition,
                                        $ffeRemarks, $preparedBy, $preparedDate);

    if ($stmt->execute()) {
        echo json_encode([
            'status'  => 'success',
            'message' => 'Disposal Request Submitted Successfully.',
            'data' => [
                'ffePurchaseVal' => $ffePurchaseVal
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
