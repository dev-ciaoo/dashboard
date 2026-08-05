<?php

include('connection.php');
header('Content-Type: application/json');

date_default_timezone_set('Asia/Manila');
$dateToday = date('F j, Y @ h:i A');

    $id = $_POST['hiddenId'];
    $stats = 2;

    $bidderName = $_POST['bidEmpName'];
    $bidStartDate = $_POST['iStartBidding'];
    $bidEndDate = $_POST['iEndBidding'];
    $bidderAddress = $_POST['iBiddingAddress'];
    $bidAmount = (float) str_replace(',', '', $_POST['iBidAmount']);
    $bidderContact = $_POST['iBiddingContact'];
    $dateAward = $_POST['iDateAward'];
    $certSale = $_POST['iCertSale'];
    $releaseDate = $_POST['iReleaseDate'];
    $orNumber = $_POST['iOR'];

    $biddedBy = $_POST['biddedBy'];
    $biddedDate = date('m-d-Y @ h:i A');


    $updateDR = "UPDATE `disposal` SET  `bidderName` = ?, `bidStartDate` = ?,
                                        `bidEndDate` = ?, `bidderAddress` = ?, `bidAmount` = ?, `bidderContact` = ?, `dateAward` = ?,
                                        `certSale` = ?, `releaseDate` = ?, `orNumber` = ?, `stats` = ?, biddedBy = ?, biddedDate = ?
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

    $stmt->bind_param("ssssdsssssissi", $bidderName, $bidStartDate, $bidEndDate, $bidderAddress, $bidAmount,
                                        $bidderContact, $dateAward, $certSale, $releaseDate, $orNumber, $stats, $biddedBy, $biddedDate, $id
                    );

    if ($stmt->execute()) {
        echo json_encode([
            'status'  => 'success',
            'message' => 'Disposal Bidding Successfully.',
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
