<?php
include('connection.php');

$user = $_SESSION['userid'];

$data_to_retrieve = $_POST['data_to_retrieve'];

if($data_to_retrieve == 'legalRegDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bsplegal SET legalRegStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bsplegal SET legalRegStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'legalStatsDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bsplegal SET legalStatsStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bsplegal SET legalStatsStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}



mysqli_close($con);
?>