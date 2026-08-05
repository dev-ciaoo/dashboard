<?php
include('connection.php');

$user = $_SESSION['userid'];

$data_to_retrieve = $_POST['data_to_retrieve'];

if($data_to_retrieve == 'subFinDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subFinStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subFinStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}


if($data_to_retrieve == 'subLedgDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subLedgStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subLedgStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subDueDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subDueStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subDueStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}


if($data_to_retrieve == 'subInvDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subInvStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subInvStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}



if($data_to_retrieve == 'subAccDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subAccStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subAccStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}


if($data_to_retrieve == 'subBankDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subBankStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subBankStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subIncDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subIncStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subIncStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subRecDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subRecStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subRecStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subChangeDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subChangeStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subChangeStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subListDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subListStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subListStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subArtDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subArtStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subArtStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'subAuditDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspsub SET subAuditStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspsub SET subAuditStats = 2  WHERE id = 1";
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