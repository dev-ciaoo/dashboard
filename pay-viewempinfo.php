<?php
include('connection.php');
$id = $_GET['id'];
$id = mysqli_real_escape_string($con, $id);

$sql = "SELECT a.*, e.* FROM accounts AS a
    JOIN empinfo AS e ON e.empId = a.employeeId
    WHERE e.empId = $id";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name = $row['fullName'];
        $address = $row['empAddr'];
        $townaddress = $row['townAddress'];
        $departments = [
            '21' => 'Marketing Specialist',
            '20' => 'Audit',
            '19' => 'Credit Risk',
            '18' => 'Credit',
            '17' => 'Loan Documentation',
            '16' => 'President',
            '15' => 'GM',
            '14' => 'CASA Maragondon',
            '13' => 'CASA Magallanes',
            '12' => 'CASA Ternate',
            '11' => 'CASA Manggahan',
            '10' => 'CASA Poblacion',
            '9' => 'CASA Noveleta',
            '8' => 'CASA Head Office',
            '7' => 'Compliance',
            '6' => 'Collection',
            '5' => 'Accounting',
            '4' => 'LOAN',
            '3' => 'ROPOA',
            '2' => 'HR',
            '1' => 'IT'
        ];
    
        $row['userDepartment'] = $departments[$row['userDepartment']] ?? 'Unknown Department';
    }
  } else {

  }



?>
<form id="employeeForm" action="" enctype="multipart/form-data">
          <input type="hidden" name="vId" id="vId" value="">
          <input type="hidden" name="tvId" id="tvId" value="">
          <div class="row">
            <div class="col-md-4 text-center">
              <img id="img" class="img-fluid rounded" src="placeholder.jpg" alt="Employee Image">
            </div>
            <!-- 1st Layer -->
            <div class="col-md-4">
              <div class="mb-3 row">
                <label for="empID" class="col-md-3 col-form-label">EMP. ID</label>
                <div class="col-md-9">
                  <input value ="<?php echo $id; ?>" type="text" class="form-control" id="empID" name="empID" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="empName" class="col-md-3 col-form-label">NAME</label>
                <div class="col-md-9">
                  <input value ="<?php echo $name; ?>"  type="text" class="form-control" id="empName" name="empName" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="empAddr" class="col-md-3 col-form-label">ADDRESS</label>
                <div class="col-md-9">
                  <input  value ="<?php echo $address. ',' .$townaddress; ?>" type="text" class="form-control" id="empAddr" name="empAddr" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="empDept" class="col-md-3 col-form-label">DEPARTMENT</label>
                <div class="col-md-9">
                  <input  value ="<?php echo $departments; ?>" type="text" class="form-control" id="empDept" name="empDept" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="empEmail" class="col-md-3 col-form-label">EMAIL</label>
                <div class="col-md-9">
                  <input type="email" class="form-control" id="empEmail" name="empEmail" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="empPosition" class="col-md-3 col-form-label">POSITION</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="empPosition" name="empPosition" readonly style="cursor: default;">
                </div>
              </div>
            </div>
            <!-- 2nd Layer -->
            <div class="col-md-4">
              <div class="mb-3 row">
                <label for="sss" class="col-md-3 col-form-label">SSS</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="sss" name="sss" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tin" class="col-md-3 col-form-label">TIN</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="tin" name="tin" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="pagibig" class="col-md-3 col-form-label">PAGI-BIG</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="pagibig" name="pagibig" readonly style="cursor: default;">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="philhealth" class="col-md-3 col-form-label">PHILHEALTH</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="philhealth" name="philhealth" readonly style="cursor: default;">
                </div>
              </div>
            </div>
          </div>
</form>