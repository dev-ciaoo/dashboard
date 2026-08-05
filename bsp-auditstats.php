<?php
include('connection.php');

$user = $_SESSION['userid'];

$data_to_retrieve = $_POST['data_to_retrieve'];

if($data_to_retrieve == 'audManualDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspaudit SET audManualStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspaudit SET audManualStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'audListDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspaudit SET audListStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspaudit SET audListStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}
if($data_to_retrieve == 'audPlanDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspaudit SET audPlanStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspaudit SET audPlanStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}
if($data_to_retrieve == 'audReportDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspaudit SET audReportStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspaudit SET audReportStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}
if($data_to_retrieve == 'audOutDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspaudit SET audOutStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspaudit SET audOutStats = 2  WHERE id = 1";
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