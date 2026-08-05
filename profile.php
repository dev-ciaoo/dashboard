<?php
include('connection.php');
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="devCiao">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>My Profile</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #ffffff63;
      font-family: 'Segoe UI', sans-serif;
    }

    .profile-card {
      border: 0;
      border-radius: 16px;
      overflow: hidden;
    }

    .profile-header {
      background: linear-gradient(135deg, #e9cd30, #E4C514);
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    .avatar {
      width: 220px;
      height: 220px;
      object-fit: cover;
      border-radius: 50%;
      border: 6px solid #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .info-label {
      font-size: 11px;
      font-weight: 700;
      color: #6c757d;
      text-transform: uppercase;
    }

    .info-value {
      font-weight: 600;
      font-size: 14px;
    }

    .section-title {
      font-weight: 700;
      color: #343a40;
      margin-bottom: 10px;
    }

    .leave-badge {
      font-size: 14px;
      padding: 6px 10px;
      border-radius: 20px;
    }

    .card-section {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      height: 100%;
    }
  </style>
</head>

<body>
<?php
$sql = "SELECT a.*, e.* FROM accounts as a
        JOIN empinfo as e ON e.empId = a.employeeId 
        WHERE a.userId = '" . $_SESSION['userid']. "'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($query);

$departments = [
  21 => 'Marketing Specialist Department',
  20 => 'Audit Department',
  19 => 'Credit Risk Department',
  18 => 'Credit Department',
  17 => 'Loan Documentation Department',
  16 => 'President Department',
  15 => 'GM/AGM Department',
  14 => 'CASA Maragondon',
  13 => 'CASA Magallanes',
  12 => 'CASA Ternate',
  11 => 'CASA Manggahan',
  10 => 'CASA Poblacion',
  9  => 'CASA Noveleta',
  8  => 'CASA Head Office',
  7  => 'Compliance Department',
  6  => 'Collection Department',
  5  => 'Account Department',
  4  => 'Loan Department',
  3  => 'ROPA Department',
  2  => 'HR Department'
];

$data['userDepartment'] = $departments[$data['userDepartment']] ?? 'IT Department';

$datee = date_create($data['dateHired']);
$dateHiredDateTime = new DateTime($data['dateHired']);
$currentDate = new DateTime();
$interval = $dateHiredDateTime->diff($currentDate);
$yearService = $interval->y . ' Yr, ' . $interval->m . ' Month & ' . $interval->d . ' Day';
?>

<div class="container py-4">

  <div class="profile-card">

    <div class="profile-header">
      <h2 class="mb-0">MY PROFILE</h2>
    </div>

    <div class="card-body p-4">
      <div class="row g-4">

        <!-- Avatar -->
        <div class="col-lg-3 text-center">
          <img src="<?= $data['userAvatar']; ?>" class="avatar">
        </div>

        <!-- Personal Info -->
        <div class="col-lg-5">
          <div class="card-section shadow-sm">
            <h5 class="section-title">EMPLOYEE INFORMATION</h5>

            <?php
            function info($label, $value){
              echo "<div class='mb-2'>
                      <div class='info-label'>$label</div>
                      <div class='info-value'>$value</div>
                    </div>";
            }

            info('Employee ID', '2020-0' . strtoupper($data['empId']));
            info('Name', strtoupper($data['fullName']));
            info('Birth Date', $data['bday']);
            info('Civil Status', strtoupper($data['civilStats']));
            info('Address', strtoupper($data['townAddress']));
            info('Department', strtoupper($data['userDepartment']));
            info('Email', $data['userEmail']);
            info('Position', strtoupper($data['empPosition']));
            info('Date Hired', $data['dateHired']);
            info('Service', $yearService);
            ?>
          </div>
        </div>

        <!-- Government + Leave Info -->
        <div class="col-lg-4">
          <div class="card-section shadow-sm">
            <h5 class="section-title">Government IDs</h5>

            <?php
            info('SSS', $data['sss']);
            info('TIN', $data['tin']);
            info('PAG-IBIG', $data['pagibig']);
            info('PHILHEALTH', $data['philhealth']);
            info('Contact Person', $data['contactPerson']);
            info('Emergency #', $data['emergencyNum']);
            ?>

            <hr>
            <h5 class="section-title">Leave Credits</h5>

            <div class="d-flex justify-content-between">
              <span>Sick Leave</span>
              <span class="badge bg-primary leave-badge"><?= $data['SL']; ?></span>
            </div>
            <div class="d-flex justify-content-between mt-2">
              <span>Vacation Leave</span>
              <span class="badge bg-success leave-badge"><?= $data['VL']; ?></span>
            </div>
            <div class="d-flex justify-content-between mt-2">
              <span>Mandatory Leave</span>
              <span class="badge bg-warning text-dark leave-badge"><?= $data['ML']; ?></span>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>

</div>

<script src="js/bootstrap.bundle521.min.js"></script>
</body>
</html>
