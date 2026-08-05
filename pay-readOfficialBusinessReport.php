<?php
include('connection.php');

$sql = "SELECT * from leavetbl WHERE iCategory = 'Official Business' AND iStatus = '2'";
$result = $con->query($sql);

$tbody = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tbody .= "<tr>";
        $tbody .= "</tr>";
    }
  } else {

  }
  $con->close();

?>