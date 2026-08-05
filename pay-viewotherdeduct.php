<?php
    include('connection.php');
    $id = $_GET['id'];

    $id = mysqli_real_escape_string($con, $id);

    $sql="SELECT * FROM pay_otherdeductions WHERE employeeId = $id AND datedeleted = ''";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            
        $idDeduct = $row['id'];
        $dateDeduct = $row['date'];
        $amountDeduct = $row['amount'];
        $remarksDeduct = $row['remarks'];
  
        }
    } else {
        $tbody .= "<tr><td colspan='3'>No results found</td></tr>";
        
    }

// include('connection.php');

// $id = $_GET['id'] ?? '';

// $sql = "SELECT id, date, amount, remarks
//         FROM pay_otherdeductions
//         WHERE employeeId = ?
//           AND datedeleted = ''";

// $stmt = $con->prepare($sql);
// $stmt->bind_param("s", $id);
// $stmt->execute();
// $result = $stmt->get_result();

// $tbody = ""; // IMPORTANT: initialize

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $tbody .= "<tr>
//             <td>{$row['date']}</td>
//             <td>{$row['amount']}</td>
//             <td>{$row['remarks']}</td>
//         </tr>";
//     }
// } else {
//     $tbody .= "<tr><td colspan='3'>No results found</td></tr>";
// }

// $stmt->close();
// $con->close();

?>

