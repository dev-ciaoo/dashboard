<?php
include('connection.php');

$user = $_SESSION['userid'];

$data_to_retrieve = $_POST['data_to_retrieve'];

if($data_to_retrieve == 'offManualDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offManualStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offManualStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'offDetailDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offDetailStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offDetailStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'offAccDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offAccStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offAccStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}


if($data_to_retrieve == 'offUtilDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offUtilStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offUtilStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'offRegDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offRegStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offRegStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'offMandaDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offMandaStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offMandaStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}
if($data_to_retrieve == 'offSingleDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspoffice SET offSingleStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspoffice SET offSingleStats = 2  WHERE id = 1";
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