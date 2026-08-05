<?php
include('connection.php');

$user = $_SESSION['userid'];

$data_to_retrieve = $_POST['data_to_retrieve'];

if($data_to_retrieve == 'genStockDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genStockStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genStockStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genCommDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genCommStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genCommStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}


if($data_to_retrieve == 'genRecentDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genRecentStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genRecentStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}


if($data_to_retrieve == 'genMinDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genMinStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genMinStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genStratDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genStratStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genStratStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genListDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genListStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genListStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genLeaseDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genLeaseStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genLeaseStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genInsuranceDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genInsuranceStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genInsuranceStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReportsDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReportsStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReportsStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genCorrDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genCorrStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genCorrStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genActDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genActStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genActStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genCreditDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genCreditStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genCreditStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genFolderDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genFolderStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genFolderStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genInventDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genInventStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genInventStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReviewDesc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReviewStats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReviewStats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview1Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview1Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview1Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview2Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview2Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview2Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview3Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview3Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview3Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview4Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview4Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview4Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview5Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview5Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview5Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}
if($data_to_retrieve == 'genReview6Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview6Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview6Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview7Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview7Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview7Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview8Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview8Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview8Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview9Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview9Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview9Stats = 2  WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("2");
        }
    }
}

if($data_to_retrieve == 'genReview10Desc'){
    if ($user >= 92) {
        $sql = "UPDATE bspgen SET genReview10Stats = 1 WHERE id = 1";
        $insertQuery = mysqli_query($con, $sql);
    
        if (!$insertQuery) {
            echo("Error Insertion: " . mysqli_error($con));
        } else {
            echo("1");
        }
    } else {
        $sql = "UPDATE bspgen SET genReview10Stats = 2  WHERE id = 1";
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