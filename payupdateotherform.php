<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Prepare the statement
    $stmt = mysqli_prepare($con, "SELECT * FROM pay_otherpayment WHERE id = ?");
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            $empid = $row['employeeId'];
            $name = $row['name'];
            $position = $row['position'];
            $branch = $row['branch'];
            $amount = $row['amount'];
            $remarks = $row['remarks'];
            $date = $row['date'];
            // You can populate other fields similarly
        }
    } else {
        // Handle case where no rows are returned
    }
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Handle case where 'id' parameter is missing or not numeric
}
mysqli_close($con);
?>

<div class="container">
    <form id="myform" method="post" action="payupdateotherpay.php">
        <input type="hidden" name="id" value="">
        <div class="d-flex flex-column gap-3">
        <input  value="<?php echo $id; ?>" required class="form-control" name="id" id="id" type="hidden">
            <div class="input-group">
                <span class="input-group-text">Employee ID</span>
                <input readonly placeholder="Input Employee ID" value="<?php echo $empid; ?>" required class="form-control" name="empid" id="empid" type="number">
            </div>
            <div class="input-group">
                <span class="input-group-text">Name</span>
                <input readonly value="<?php echo $name; ?>" required class="form-control" name="name" id="name" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Position</span>
                <input readonly value="<?php echo $position; ?>" required class="form-control" name="position" id="position" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Branch</span>
                <input readonly value="<?php echo $branch; ?>" required class="form-control" name="branch" id="branch" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Amount</span>
                <input placeholder="Input Amount" value="<?php echo $amount; ?>" require value="" required class="form-control" name="amount" id="amount" type="number">
            </div>
            <div class="input-group">
                <span class="input-group-text">Remarks</span>
                <input placeholder="Input Remarks" value="<?php echo $remarks; ?>" require value="" required class="form-control" name="remarks" id="remarks" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Date</span>
                <input required placeholder="Input Date" value="<?php echo $date; ?>" value="" class="form-control" name="date" id="date" type="date">
            </div>
            <div class="d-flex align-items-center justify-content-center flex-row gap-3">
                <button type="submit" id="btnsave" class="btn btn-primary">SAVE</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </form>
</div>