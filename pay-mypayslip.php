<?php
  include('connection.php');

  $empid = $_SESSION['employeeId'];
  $name = $_SESSION['fullname'];

  // Get approved and verified dates
  // $sql = "SELECT * FROM pay_selecteddate WHERE approved = '1' AND verified = '1' GROUP BY date ORDER BY STR_TO_DATE(date, '%M %e, %Y') ASC";
  $sql = "SELECT * FROM pay_selecteddate WHERE approved = '1' AND verified = '1' AND payslipPublished = '1' GROUP BY date ORDER BY STR_TO_DATE(date, '%M %e, %Y') ASC";
  $result = $con->query($sql);

  $dates = [];
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $dates[] = $row;
      }
  }

  // Get published bonus periods for this employee (e.g. Anniversary Bonus)
  $sqlBonus = "SELECT periodKey, label, effectiveDate FROM pay_bonus WHERE empId = ? AND published = '1' GROUP BY periodKey, label, effectiveDate ORDER BY periodKey DESC";
  $stmtBonus = $con->prepare($sqlBonus);
  $stmtBonus->bind_param('s', $empid);
  $stmtBonus->execute();
  $resultBonus = $stmtBonus->get_result();
  $bonusPeriods = [];
  while ($row = $resultBonus->fetch_assoc()) {
      $bonusPeriods[] = $row;
  }

  // ===== UNIFY bonus periods + normal payroll dates into ONE date-sorted timeline =====
  // Each item gets a real parsed DateTime so both types (bonus vs normal payslip)
  // can be compared fairly against each other, instead of being shown as two
  // separate groups (bonus always on top regardless of actual date).
  $dropdownItems = [];

  foreach ($bonusPeriods as $bp) {
      // effectiveDate is the admin-set true bonus date (e.g. anniversary date, set at
      // period creation in pay-bonus.php / pay-bonusrecord.php). This is the correct
      // basis for sorting since it reflects the actual bonus date, not when the
      // period record happened to be created.
      // Falls back to periodKey (creation timestamp, YmdHis) only for legacy periods
      // created before effectiveDate existed.
      if (!empty($bp['effectiveDate'])) {
          $parsedBonusDate = DateTime::createFromFormat('Y-m-d', $bp['effectiveDate']);
      } else {
          $parsedBonusDate = DateTime::createFromFormat('YmdHis', $bp['periodKey']);
      }
      $dropdownItems[] = [
          'type'     => 'bonus',
          'sortDate' => $parsedBonusDate ? $parsedBonusDate : new DateTime('1970-01-01'),
          'data'     => $bp
      ];
  }

  foreach ($dates as $row) {
      // $row['date'] format matches STR_TO_DATE(date, '%M %e, %Y') used in the SQL above
      $parsedPayrollDate = DateTime::createFromFormat('F j, Y', $row['date']);
      $dropdownItems[] = [
          'type'     => 'normal',
          'sortDate' => $parsedPayrollDate ? $parsedPayrollDate : new DateTime('1970-01-01'),
          'data'     => $row
      ];
  }

  // Sort descending by actual date - newest (bonus or normal) ends up on top
  usort($dropdownItems, function($a, $b) {
      return $b['sortDate'] <=> $a['sortDate'];
  });

  // Get employee details
  $sql = "SELECT accounts.employeeId, accounts.fullName, accounts.address, empinfo.empPosition
          FROM accounts 
          LEFT JOIN empinfo ON empinfo.empId = accounts.employeeId
          WHERE accounts.employeeId = '$empid'";
  $result = mysqli_query($con, $sql);
  if ($result) {
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              $employee_id = $row['employeeId'];
              $account_name = $row['fullName'];
              $branch =  $row['address'];
              $position = ucwords(strtolower($row['empPosition'])); // empinfo <<-- 
          }
      }
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="devCiao">
    <meta name="description" content="A payslip for OUR Bank.">
    <link rel="icon" href="images/favicon.ico">

    <title>Online Payslip</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      /* Professional Bank Color Scheme */
      :root {
        /* --bank-primary: #f9cf46;
        --bank-secondary: #fff7d1;
        --bank-accent: #4a90c5;
        --bank-success: #28a745;
        --bank-light: #f8f9fa;
        --bank-dark: #2d3748; */
        --bank-primary: #f9cf46;
        --bank-secondary: #fff7d1;
        --bank-accent: #4a90c5;
        --bank-success: #28a745;
        --bank-light: rgba(239, 223, 3, 0.7); /* Translucent for glass effect */
        --bank-dark: #2d3748;
        --glass-border: rgba(255, 255, 255, 0.4);
        --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
      }

      body {
        /* background: linear-gradient(135deg, var(--bank-primary) 10%, var(--bank-secondary) 100%); 
        background: linear-gradient(135deg, #cda811 0%, #f0d76a 100%); 
        min-height: 100vh;
        padding: 60px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
        position: relative;  BACK GROUND OURBANK */
        background: radial-gradient(at 0% 0%, #cda811 0%, transparent 50%),
              radial-gradient(at 100% 100%, #f0d76a 0%, transparent 50%),
              #e7da9b; /*fff7d1 */
        min-height: 100vh;
        padding: 60px;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        position: relative;
        overflow-x: hidden;
     }


      /* BACKGROUND IMAGE OVERLAY */
      body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('image/OurbankFront001.jpg'); 
      background-size: cover;
      background-position: top;
      background-repeat: no-repeat;
      opacity: 0.30;
      z-index: 0;
      pointer-events: none;
    } 

      /* BACKGROUND OURBANK */
      /* .payslip-container,
      .modal {
        position: relative;
        z-index: 1;
      } */

      .payslip-container {
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 1;     
      }

      /* .logo-section {
        text-align: center;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        margin-bottom: 30px;
      } */

      /* #inventorylogo {
        width: 200px;
        height: auto;
        max-width: 100%;
        position: center;
      } */

      #inventorylogo {
        width: 350px;       
        height: auto;
        max-width: 100%;
        display: block;     
        margin: 0 auto;      /* center */
        margin-bottom: 10px; 
    }
      .logo-section {
        padding-top: 1px;
        margin-bottom: 70px;
     }

      /* Dropdown Card Styling */
      .dropdown-card {
        width: 900px;
        background: #ffffffc3; 
        backdrop-filter: blur(14px) saturate(160%);
        -webkit-backdrop-filter: blur(14px) saturate(160%);
        border: 1px solid var(--glass-border);
        border-radius: 24px; /* Smoother corners */
        padding: 40px;
        box-shadow: var(--glass-shadow);
        margin: 0 auto;
        margin-bottom: 40px;
        margin-top: 50px;
        transition: transform 0.3s ease;
        text-align: center;
      }
      .dropdown-card:hover {
        transform: translateY(-5px);
      }

      .dropdown-card h2 {
        color: var(--bank-dark);
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.8rem;
        position: center;
      }

      .dropdown-card p {
        color: #000000;
        margin-bottom: 30px;
        text-align: center;
      }

      /* Custom Select Dropdown */
      .payroll-select-wrapper {
        position: relative;
        background: white;
      }

      .payroll-select {
        width: 100%;
        padding: 18px 50px 18px 20px;
        font-size: 16px;
        font-weight: 600;
        /* color: var(--bank-dark); */
        /* background: rgb(255,244,85); */
        background: white;
        /* border: 1px solid var(--glass-border); */
        /* border-radius: 16px; */
        appearance: none;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  
        /* Modern Arrow Icon */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%232d3748' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 18px;
      }

      .payroll-select:hover {
        /* border-color: var(--bank-accent);
        background-color: #edf2f7; */
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      }

      .payroll-select:focus {
        /* outline: none;
        border-color: var(--bank-accent);
        box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
        background-color: white; */
        outline: none;
        border-color: var(--bank-primary);
        box-shadow: 0 0 0 4px rgba(246, 222, 113, 0.92);
        background-color: white;
        transform: scale(1.01);
      }

      .payroll-select option {
        padding: 10px;
        font-weight: 500;
      }

      .payroll-select option:first-child {
        color: #a0aec0;
      }

      /* Icon styling */
      .select-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bank-accent);
        font-size: 20px;
        pointer-events: none;
      }

      .payroll-select.with-icon {
        padding-left: 55px;
      }

      /* Loading State */
      .loading-spinner {
        display: none;
        text-align: center;
        padding: 20px;
        color: var(--bank-accent);
      }

      .loading-spinner.active {
        display: block;
      }

      /* No Data Message */
      .no-data-message {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      }

      .no-data-message i {
        font-size: 64px;
        color: #cbd5e0;
        margin-bottom: 20px;
      }

      .no-data-message h3 {
        color: var(--bank-dark);
        margin-bottom: 10px;
      }

      .no-data-message p {
        color: #718096;
      }

      /* Modal Header */
      .modal-header {
        /* background: linear-gradient(90deg, #f0c000 0%, #c89a00 100%); */
        color: black;
        border-radius: 0;
      }

      .modal-header .btn-close {
        filter: none;
      }

      .modal-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: #1a2535;
      }

      /* =============================================
        PAYSLIP SLIP — padding removed, overflow hidden
        so table reaches full width edge-to-edge
        ============================================= */
      .slip {
        /* text-align: left;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        background: white;
        overflow: hidden; 
        padding: 0;       no padding here — handled per element below */
        background: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--glass-shadow);
      }

      /* Give padding back to everything EXCEPT the table */
      .slip .d-flex {
        /* padding: 16px 20px;
        background: linear-gradient(90deg, #f0c000 0%, #c89a00 100%);
        margin: 0; */
        padding: 20px 25px;
        background: linear-gradient(135deg, #f9cf46 0%, #d4a800 100%) !important;
        color: #1a2535 !important;
      }

      .slip .d-flex h3 {
        color: #1a2535 !important;
        align-self: center;
      }

      .slip p {
        margin-bottom: 8px;
        color: #4a5568;
        padding-left: 20px;
        padding-right: 20px;
      }

      .slip strong {
        color: var(--bank-dark);
      }

      #slip-logo {
        width: 180px;
        height: auto;
      }

      .rightText {
        text-align: right;
        margin: 16px 20px;
        padding: 15px;
        background: #fdf9ee;
        border: 1px solid #e8d98a;
        border-radius: 8px;
      }

      .employee-info {
        background: #f8f9fa;
        padding: 15px 20px;
        margin-bottom: 10px;
      }

      /* =============================================
        TABLE — full width, zebra on both th and td
        ============================================= */
        .table {
          margin-top: 16px;
          margin-bottom: 0;
          font-size: 14px;
          border: 1px solid #e2e8f0;
          width: 100%;
          table-layout: fixed;
      }

      .table thead th:nth-child(1),
      .table tbody th:nth-child(1),
      .table tfoot th:nth-child(1) { width: 76%; }

      .table thead th:nth-child(2),
      .table tbody td:nth-child(2),
      .table tfoot td:nth-child(2) { width: 24%; }

      /* .table {
        margin-top: 16px;
        margin-bottom: 0;
        font-size: 14px;
        border: 1px solid #e2e8f0;
        width: 100%;
      } */

      

      /* Two independent tables (Earnings / Deductions) sit side by side so
         a shorter column never needs blank filler rows to stay paired with
         the longer one. */
      .payslip-tables {
        display: flex;
        align-items: flex-start;
      }

      .payslip-tables .table {
        margin-top: 16px;
        flex: 1 1 50%;
        min-width: 0;
      }

      .payslip-totals {
        display: flex;
        align-items: stretch;
      }

      .payslip-totals .table {
        margin-top: 0;
        flex: 1 1 50%;
        min-width: 0;
      }

      .payslip-totals .table tbody {
        border-top: 2px solid #dee2e6;
      }

      .payslip-totals .totals-spacer th,
      .payslip-totals .totals-spacer td {
        visibility: hidden;
      }

      table.table-earnings {
        border-right: 2px solid #e2e8f0;
      }

      table.table-deductions {
        border-left: none;
      }

      .table thead th {
        background: #cdae11;
        color: #1a2535;
        font-weight: 700;
        border: none;
        padding: 12px;
      }

      /* Zebra — odd rows (white) */
      .table tbody tr:nth-child(odd) th,
      .table tbody tr:nth-child(odd) td {
        background-color: #ffffff !important;
      }

      /* Zebra — even rows (light gold) */
      .table tbody tr:nth-child(even) th,
      .table tbody tr:nth-child(even) td {
        background-color: white;  /* #fdf9eedd */
      }

      .table tbody th {
        font-weight: 600;
        color: var(--bank-dark);
      }

      .table tbody td {
        text-align: right;
      }

      .table tfoot {
        font-weight: 700;
      }

      .table-dark {
        background: linear-gradient(90deg, #f0c000 0%, #c89a00 100%) !important;
        color: #1a2535 !important;
      }

      /* =============================================
        REMARK DETAIL ROWS
        ============================================= */
      .remark-detail-row {
        background: transparent !important;
        font-size: 11px;
        color: #666;
        border: none !important;
      }

      .remark-detail-row th,
      .remark-detail-row td {
        padding: 4px 12px !important;
        font-weight: 400 !important;
        font-style: italic;
        background: transparent !important;
        border: none !important;
      }

      .remark-detail-row th:first-child {
        padding-left: 35px !important;
        text-align: left;
        white-space: normal !important;
        word-wrap: break-word;
        word-break: break-word;
        max-width: 180px;
    }

    .remark-detail-row td:nth-child(2) {
        text-align: right;
        padding-right: 15px !important;
        white-space: nowrap;
        vertical-align: top;
    }

      /* .remark-detail-row th:first-child {
        padding-left: 35px !important;
        text-align: left;
      }

      .remark-detail-row td:nth-child(2) {
        text-align: right;
        padding-right: 15px !important;
        border-right: 2px solid #e2e8f0 !important;
      } */

      /* Vertical separator between Earnings and Deductions is now handled by
         table.table-earnings / table.table-deductions borders above, since
         each is an independent table rather than paired columns per row. */

      /* =============================================
        BUTTONS
        ============================================= */
      .btn-ack {
        background: var(--bank-success);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
      }

      .btn-ack:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
      }

      .btn-primary {
        /* background: var(--bank-primary);
        border: none;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px; */
        background: var(--bank-primary);
        color: #1a2535;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 12px 24px;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 12px rgba(205, 168, 17, 0.3);
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        /* background: #d4a800;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 58, 95, 0.4); */
        background: #fbd868;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 20px rgba(205, 168, 17, 0.4);
      }

      .btn-secondary {
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
      }

      /* Status Icons */
      .status-icon {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-left: 8px;
      }

      input[type="file"] {
        display: none;
      }

      /* Responsive */
      @media (max-width: 768px) {
        body {
          padding: 20px;
        }

        .dropdown-card {
          padding: 25px;
        }

        .dropdown-card h2 {
          font-size: 1.5rem;
        }

        .payroll-select {
          padding: 15px 45px 15px 15px;
          font-size: 14px;
        }

        .table {
          font-size: 12px;
        }
      }

      @media print {
        body {
          background: white;
        }

        .modal-header,
        .modal-footer {
          display: none;
        }

        .slip {
          border: 2px solid #000;
        }

        .table thead th,
        .table-dark {
          -webkit-print-color-adjust: exact;
          print-color-adjust: exact;
        }
      }
    </style>
  </head>

  <body>

  <!-- Logo Section -->
    <!-- <div class="payslip-container">
      <div class="logo-section">
        <img src="./logo/logo.png" id="inventorylogo" alt="Bank Logo" />
        <h4 class="mt-3 mb-0" style="color: #3e4444;">Employee Payslip Portal</h4>
      </div> -->

      <!-- Dropdown Card -->
      <div class="dropdown-card">
        <div class="payslip-container">
      <div class="logo-section">
        <img src="./logo/logo.png" id="inventorylogo" alt="Bank Logo" />
        <!-- <h4 class="mt-3 mb-0" style="color: #3e4444;">Employee Payslip Portal</h4> -->
      </div>
        <h2><i class="fas fa-calendar-alt" style="color: var(--bank-accent);"></i> Select Payroll Period</h2>
        <p>Choose a payroll date to view your payslip details</p>
        
        <!-- Dropdown populated by PHP -->
        <div class="payroll-select-wrapper">
          <i class="fas fa-file-invoice-dollar select-icon"></i>
          <select class="payroll-select with-icon" id="payrollDateSelect">
            <option value="" disabled selected>-- Select Payroll Date --</option>
            <?php
            // ===== UNIFIED, DATE-SORTED dropdown =====
            // Bonus periods and normal payroll cutoffs are now merged into a single
            // timeline ($dropdownItems, built above) and sorted by actual date
            // (bonus -> effectiveDate, normal -> date parsed as F j, Y), newest first.
            // Only the single newest item in the whole list gets *NEW*.
            // Bonus items still get the *BONUS* tag/styling regardless of position.
            if (count($dropdownItems) > 0) {
                foreach ($dropdownItems as $index => $item) {
                    $isNewest = ($index === 0);

                    if ($item['type'] === 'bonus') {
                        $bp = $item['data'];
                        $bonusData = htmlspecialchars(json_encode([
                            'type' => 'bonus',
                            'periodKey' => $bp['periodKey'],
                            'label' => $bp['label']
                        ]), ENT_QUOTES, 'UTF-8');
                        echo '<option value=\'' . $bonusData . '\' style="color: #b8860b; font-weight: bold;">';
                        echo htmlspecialchars($bp['label']) . ' &nbsp;&nbsp;&nbsp; '; //BONUS WORD ON PAYSLIP (*BONUS*)
                        if ($isNewest) {
                            echo ' &nbsp;&nbsp;&nbsp; *NEW*';
                        }
                        echo '</option>';
                    } else {
                        $row = $item['data'];
                        $jsonData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                        if ($isNewest) {
                            echo '<option value=\'' . $jsonData . '\' style="color: black; font-weight: bold;">';
                            echo $row['date'] . ' &nbsp;&nbsp;&nbsp; *NEW*';
                        } else {
                            echo '<option value=\'' . $jsonData . '\'>';
                            echo $row['date'];
                        }
                        echo '</option>';
                    }
                }
            }
            ?>
          </select>
        </div>
        
        <div class="loading-spinner">
          <i class="fas fa-spinner fa-spin fa-2x"></i>
          <p class="mt-2">Loading payslip data...</p>
        </div>
      </div>

      <!-- No Data Message -->
      <?php if (count($dates) == 0 && count($bonusPeriods) == 0): ?>
      <div class="no-data-message">
        <i class="fas fa-inbox"></i>
        <h3>No Payroll Data Available</h3>
        <p>There are no approved and verified payroll dates at this time.</p>
      </div>
      <?php endif; ?>
    </div>

    <!-- Hidden Inputs -->
    <input type="hidden" id="selectedDate">
    <input type="hidden" id="monthlysalary">
    <input type="hidden" id="slPayment">
    <input type="hidden" id="slCutoffSelect">

    <!-- Upload Modal -->
    <!-- <div id="uploadModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            <h4 class="modal-title">File Upload Form</h4>
          </div>
          <div class="modal-body">
            <form method='post' action='' enctype="multipart/form-data">
              Select File : <input type='file' name='file' id='file' class='form-control' ><br>
              <button type='submit' class='btn btn-info btn-md' id='btn_upload'>UPLOAD</button>
            </form>
            <div id='preview'></div>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Payslip Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              <i class="fas fa-file-invoice"></i> Payslip Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="payslip-content">
              <div class="slip">
                <div class="d-flex justify-content-between align-items-start mb-3" id="slipLogo">
                  <img id="slip-logo" src="./logo/logo.png" alt="slip-logo"> <!--C:\logo\logo.png-->
                  <h3 class="text-end" style="color: #3e4444;"></h3>
                </div>
                
                <!-- <div class="rightText">
                  <p>Date of Payment: <span><strong class="slipDateOfPayment"></strong></span></p>
                  <p>Branch: <span><strong class="slipBranch"><?php echo $branch ?></strong></span></p>
                  <p>Pay Period: <span><strong class="slipPayPeriod"></strong></span></p>
                </div> -->

       
                <div class="rightText" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 40px; margin: 16px 20px;">
                  <div>
                      <div style="text-align: left;">
                    <p style="margin-bottom: 8px; color: #4a5568; padding: 0;">Employee ID No: <span><strong class="slipID"><?php echo '2020-0' . $employee_id ?></strong></span></p>
                    <p style="margin-bottom: 8px; color: #4a5568; padding: 0;">Employee Name: <span><strong class="slipName"><?php echo $name ?></strong></span></p>
                    <p style="margin-bottom: 8px; color: #4a5568; padding: 0;">Position: <span><strong class="slipPosition"><?php echo $position ?></strong></span></p>
                      </div>
                  </div>
                  <div>
                    <p style="margin-bottom: 8px; padding: 0;">Date of Payment: <span><strong class="slipDateOfPayment"></strong></span></p>
                    <p style="margin-bottom: 8px; padding: 0;">Branch: <span><strong class="slipBranch"><?php echo $branch ?></strong></span></p>
                    <p style="margin-bottom: 8px; padding: 0;">Pay Period: <span><strong class="slipPayPeriod"></strong></span></p>
                  </div>
                </div>

                <div class="payslip-tables">
                  <table class="table table-earnings">
                    <thead>
                      <tr>
                        <th scope="col">EARNINGS</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider">
                      <tr>
                        <th scope="row">Basic Salary</th>
                        <td class="earnings data data-basicPay">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Transpo. Allow.</th>
                        <td class="earnings data data-transpoAllow">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Rice Allowance</th>
                        <td class="earnings data data-riceAllow">0.00</td>
                      </tr>
                      <tr id="bonusRow">
                        <th scope="row">Bonus</th>
                        <td class="earnings data data-bonus">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Overtime Pay</th>
                        <td class="earnings data data-otPay">0.00</td>
                      </tr>
                      <tr id="otherPayRow">
                        <th scope="row">Other.</th>
                        <td class="earnings data data-otherPay">0.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-deductions">
                    <thead>
                      <tr>
                        <th scope="col">DEDUCTIONS</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider">
                      <tr>
                        <th scope="row">SSS</th>
                        <td class="deductions data-sss">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">SSS Mand. Provident</th>
                        <td class="deductions data-sssMand">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">PAGIBIG</th>
                        <td class="deductions data data-pagibig">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">PHILHEALTH</th>
                        <td class="deductions data data-philhealth">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">SSS Loan</th>
                        <td class="deductions data data-sssLoan">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">SSS Calamity</th>
                        <td class="deductions data data-ssscalamity">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Pagibig Loan</th>
                        <td class="deductions data data-pagibigloan">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Pagibig Calamity</th>
                        <td class="deductions data data-pagibigcalamity">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Employee Loan</th>
                        <td class="deductions data data-employeeLoan">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Withholding Tax</th>
                        <td class="deductions data data-withholdingTax">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Absent</th>
                        <td class="deductions data data-absent">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row">Lates</th>
                        <td class="deductions data data-lates">0.00</td>
                      </tr>
                      <tr id="otherDeductRow">
                        <th scope="row">Other</th>
                        <td class="deductions data data-otherDeduction">0.00</td>
                      </tr>
                    </tbody>
                  </table>
                  </div>

                  <div class="payslip-totals">
                  <table class="table table-earnings">
                    <tbody>
                      <tr>
                        <th scope="row">TOTAL EARNINGS</th>
                        <td class="data data-totalEarnings">0.00</td>
                      </tr>
                      <tr class="totals-spacer">
                        <th scope="row"></th>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-deductions">
                    <tbody>
                      <tr>
                        <th scope="row">TOTAL DEDUCTIONS</th>
                        <td class="data data-totalDeducts">0.00</td>
                      </tr>
                      <tr>
                        <th scope="row" class="data table-dark">NET SALARY</th>
                        <td class="data table-dark data-netSalary">0.00</td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
                <!-- Footer Note -->
                <div style="border-top: 1px solid #e2e8f0; padding: 12px 20px; display: flex; align-items: flex-start; gap: 8px; background: #fafafa;">
                  <i class="fas fa-info-circle" style="font-size: 13px; color: #718096; margin-top: 2px; flex-shrink: 0;"></i>

                  <p style="margin: 0; font-size: 12px; color: #718096; line-height: 1.6;">
                    If you have any concerns or discrepancies regarding this payslip, please contact the 
                    <strong style="color: #4a5568;">HR Department</strong> within 
                    <strong style="color: #4a5568;">5 working days</strong> from the date of payment.
                  </p>
                </div>
              </div>
              <div id="output"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button style="margin-right:auto;" type="button" class="btn btn-ack">Acknowledge
              <span class="eks"><img height='20px' src='statusImage//xmark.png'></img></span>
              <span style="display:none;" class="check"><img height='20px' src='statusImage//check.png'></img></span>
            </button>
            <button id="closeButton" type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-md print-btn">Save As PDF/Print</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script type="text/javascript" src="js/printThis.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
    <script type="text/javascript" src="js/screenshot.js"></script>
    <script type="text/javascript" src="js/select.js"></script>

    <script>

      // Flag to distinguish "Anniversary Bonus" view from normal payroll cutoff view.
      // Used by the Acknowledge button to know which endpoint to call.
      var isBonusView = false;

      $(document).ready(function(){
          $('#fileInput').on('change', function() {
              $('#myForm').submit();
          });

          // Dropdown change event - triggers modal
          $('#payrollDateSelect').on('change', function() {
              var selectedOption = $(this).val();
              
              if (selectedOption) {
                  $('.loading-spinner').addClass('active');
                  
                  // Call the selectDate function with the selected data
                  selectDate(selectedOption);
                  
                  // Small delay for loading effect, then show modal
                  setTimeout(function() {
                      $('.loading-spinner').removeClass('active');
                      $('#staticBackdrop').modal('show');
                  }, 500);
              }
              $('#staticBackdrop').on('hidden.bs.modal', function () { // refresh modal
              $('#payrollDateSelect').val('');
            });
          });

          $('.selectdate').click(function(){
              var date = $('.date').val();
              var textdate = $('.formatteddate').val();
              var startdate = $('.startdateoutput').val();
              var enddate = $('.enddateoutput').val();

              var dayOfMonth = parseInt(date.split('-')[2]); 
          });
      });

      // Acknowledge button functionality
      // Acknowledge button functionality
      $('.btn-ack').click(function(){
          var $btn = $(this);

          if ($btn.hasClass('acknowledged')) return;

          // Anniversary Bonus view — acknowledge against pay_bonus table instead of normal payslip
          if (isBonusView) {
              var periodKey = $('#selectedDate').val();
              $.ajax({
                  type: 'POST',
                  url: 'pay-bonusrecord.php',
                  data: {
                      action: 'acknowledge',
                      periodKey: periodKey
                  },
                  success: function(response) {
                      $btn.addClass('acknowledged');
                      $btn.text('Acknowledged ');
                      $btn.append('<img height="20px" src="statusImage//check.png">');
                      $btn.css({
                          'background': '#218838',
                          'cursor': 'default',
                          'pointer-events': 'none'
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error(status, error);
                  }
              });
              return;
          }

          var date = $('#selectedDate').val();
          var empId = <?php echo $empid; ?>;
          
          $.ajax({
              type: 'POST',
              url: 'pay-acknowledge.php',
              data: { 
                  date: date,
                  empId: empId 
              }, 
              success: function(response) {
                  console.log(response);
                  $btn.addClass('acknowledged');
                  $btn.text('Acknowledged ');
                  $btn.append('<img height="20px" src="statusImage//check.png">');
                  $btn.css({
                      'background': '#218838',
                      'cursor': 'default',
                      'pointer-events': 'none'
                  });
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          });
      });
  

      function sendInputValue() {
          console.log(data.startdate);
      }

      // Main function to select date and load all payslip data
  function selectDate(dateData) {
      var data = JSON.parse(dateData);

      // Anniversary / other bonus period — completely separate from normal payroll cutoff
      if (data.type === 'bonus') {
          selectBonusPeriod(data);
          return;
      }

      isBonusView = false;

      // Clear any leftover bonus data from a previous "Anniversary Bonus" selection.
      // Normal payroll cutoffs never populate a bonus amount (bonus is handled
      // exclusively through the bonus-period system below), so hide the row
      // instead of showing an always-empty pair on the Deductions side.
      $('.data-bonus').text('0.00');
      $('#bonusRow').nextUntil(':not(.remark-detail-row)').remove();
      $('#bonusRow').hide();

      $('.slipDateOfPayment').text(data.date);

      // Function to get the last working day of the month (Monday-Friday only)
      function getLastWorkingDay(year, month) {
          // Get last day of month (month is 0-indexed)
          var lastDay = new Date(year, month + 1, 0);
          var day = lastDay.getDay(); // 0=Sunday, 6=Saturday
          
          // If Saturday, go back to Friday
          if (day === 6) {
              lastDay.setDate(lastDay.getDate() - 1);
          }
          // If Sunday, go back to Friday
          else if (day === 0) {
              lastDay.setDate(lastDay.getDate() - 2);
          }
          
          return lastDay.getDate();
      }

      // Function to get working day (adjust if weekend)
      function getWorkingDay(year, month, day) {
          var date = new Date(year, month, day);
          var dayOfWeek = date.getDay();
          
          // If Saturday, go back to Friday
          if (dayOfWeek === 6) {
              date.setDate(date.getDate() - 1);
          }
          // If Sunday, go forward to Monday
          else if (dayOfWeek === 0) {
              date.setDate(date.getDate() + 1);
          }
          
          return date.getDate();
      }

      var startDate = new Date(data.startdate);
      var endDate = new Date(data.enddate);
      var year = endDate.getFullYear();
      var month = endDate.getMonth(); // 0-indexed
      var endDay = endDate.getDate();

      var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      
      var payPeriodText;
      
      // Determine if this is 15th cutoff or end of month cutoff
      if (endDay <= 15) {
          // First cutoff - 1st to 15th (or adjusted for weekend)
          var workingDay15 = getWorkingDay(year, month, 15);
          payPeriodText = months[month] + ' 1-' + workingDay15 + ', ' + year;
      } else {
          // Second cutoff - 16th to last working day of month
          var lastWorkingDay = getLastWorkingDay(year, month);
          payPeriodText = months[month] + ' 16-' + lastWorkingDay + ', ' + year;
      }

      $('.slipPayPeriod').text(payPeriodText);

      $('#startdateoutput').val(data.startdate);
      $('#enddateoutput').val(data.enddate);
      $('#selectedDate').val(data.selectedDate);

      var empId = <?php echo $empid; ?>;

      var requests = [];

          // Basic Salary
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'basicsalary',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('#monthlysalary').val(response * 2);
                  if (response == 0){
                      $('.data-basicPay').text('0.00');
                  } else {
                      $('.data-basicPay').text(response);
                  }
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // Read Payslip status (acknowledged or not)
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'readPayslip',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                    console.log(response);
                    var $btn = $('.btn-ack');
                    if(response == 1){
                        $btn.addClass('acknowledged');
                        $btn.text('Acknowledged ');
                        $btn.append('<img height="20px" src="statusImage//check.png">');
                        $btn.css({
                            'background': '#218838',
                            'cursor': 'default',
                            'pointer-events': 'none'
                        });
                    } else {
                        $btn.removeClass('acknowledged');
                        $btn.css({
                            'background': '',
                            'cursor': '',
                            'pointer-events': ''
                        });
                        $btn.html('Acknowledge <span class="eks"><img height="20px" src="statusImage//xmark.png"></span>');
                    }
                },
          }));

          // Overtime Pay
          requests.push($.ajax({
              url: 'pay-salaryrecord.php',
              type: 'POST',
              data: { 
                  data_to_retrieve: 'overtime',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('.data-otPay').text(response == 0 || response == '' ? '0.00' : response);
              }
          }));

          // ========== OTHER PAYMENTS - WITH REMARKS DETAIL BELOW ==========
          requests.push($.ajax({
              url: 'PayOtherRemarksPayslip.php',
              type: 'POST',
              dataType: 'json',
              data: { 
                  startdateoutput: data.startdate,
                  enddateoutput: data.enddate,
                  empId: empId 
              },
              success: function(response) {
                  console.log('Other Payment Response:', response);
                  
                  // Set the TOTAL in the main "Other" row
                  if (response && response.total) {
                      $('.data-otherPay').text(response.total);
                  } else {
                      $('.data-otherPay').text('0.00');
                  }
                  
                  // Clear previous detail rows (remove any existing remark rows after otherPayRow)
                  $('#otherPayRow').nextUntil(':not(.remark-detail-row)').remove();
                  
                  // Add detail rows AFTER the otherPayRow (LEFT side - EARNINGS column)
                  if (response && response.count > 0) {
                      var insertAfter = $('#otherPayRow');
                      response.items.forEach(function(item) {
                          var detailRow = $('<tr class="remark-detail-row">' +
                              '<th scope="row">- ' + item.remark + '</th>' +
                              '<td>' + item.amount + '</td>' +
                              '</tr>');
                          insertAfter.after(detailRow);
                          insertAfter = detailRow; // Chain insertion
                      });
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Other Pay Error:', status, error);
                  $('.data-otherPay').text('0.00');
              }
          }));

          // Rice Allowance
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'riceallowance',
                  date: data.selectedDate,
                  empId: empId 
              }, 
              success: function(response) {
                  $('.data-riceAllow').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // Transportation Allowance
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'transpo',
                  date: data.selectedDate,
                  empId: empId 
              }, 
              success: function(response) {
                  $('.data-transpoAllow').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // SSS
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'sss',
                  date: data.selectedDate,
                  empId: empId 
              }, 
              success: function(response) {
                  $('.data-sss').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // SSS Mandatory
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'sssmand',
                  date: data.selectedDate,
                  empId: empId 
              }, 
              success: function(response) {   
                  $('.data-sssMand').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // PAGIBIG
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'pagibig',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-pagibig').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // PHILHEALTH
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'philhealth',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-philhealth').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // SSS Loan
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'sssloan',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-sssLoan').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // SSS Calamity
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'ssscalamity',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-ssscalamity').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // PAGIBIG Loan
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'pagibigloan',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-pagibigloan').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // PAGIBIG Calamity
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'pagibigcalamity',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-pagibigcalamity').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // Withholding Tax
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'tax',
                  date: data.selectedDate,
                  empId: empId
              }, 
              success: function(response) {   
                  $('.data-withholdingTax').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // Employee Loan
          requests.push($.ajax({
              type: 'POST',
              url: 'pay-salaryrecord.php',
              data: { 
                  data_to_retrieve: 'slAmortization',
                  date: data.selectedDate,
                  empId: empId 
              }, 
              success: function(response) {
                  $('.data-employeeLoan').text(response);
              },
              error: function(xhr, status, error) {
                  console.error(status, error);
              }
          }));

          // Absent
          requests.push($.ajax({
              url: 'pay-salaryrecord.php',
              type: 'POST',
              data: { 
                  data_to_retrieve: 'absent',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('.data-absent').text(response);
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', status, error);
              }
          }));

          // Lates
          requests.push($.ajax({
              url: 'pay-salaryrecord.php',
              type: 'POST',
              data: { 
                  data_to_retrieve: 'late',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('.data-lates').text(response);
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', status, error);
              }   
          })); 

          // ========== OTHER DEDUCTIONS - WITH REMARKS DETAIL BELOW ==========
          requests.push($.ajax({
              url: 'PayDeductRemarksPayslip.php',
              type: 'POST',
              dataType: 'json',
              data: { 
                  startdateoutput: data.startdate,
                  enddateoutput: data.enddate,
                  empId: empId 
              },
              success: function(response) {
                  console.log('Other Deduction Response:', response);
                  
                  // Set the TOTAL in the main "Other" row
                  if (response && response.total) {
                      $('.data-otherDeduction').text(response.total);
                  } else {
                      $('.data-otherDeduction').text('0.00');
                  }
                  
                  // Clear previous detail rows (remove any existing remark rows after otherDeductRow)
                  $('#otherDeductRow').nextUntil(':not(.remark-detail-row)').remove();
                  
                  // Add detail rows AFTER the otherDeductRow (RIGHT side - DEDUCTIONS column)
                  if (response && response.count > 0) {
                      var insertAfter = $('#otherDeductRow');
                      response.items.forEach(function(item) {
                          var detailRow = $('<tr class="remark-detail-row">' +
                              '<th scope="row">- ' + item.remark + '</th>' +
                              '<td>' + item.amount + '</td>' +
                              '</tr>');
                          insertAfter.after(detailRow);
                          insertAfter = detailRow; // Chain insertion
                      });
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Other Deduction Error:', status, error);
                  $('.data-otherDeduction').text('0.00');
              }
          }));

          // Total Earning
          requests.push($.ajax({
              url: 'pay-salaryrecord.php',
              type: 'POST',
              data: { 
                  data_to_retrieve: 'totalearning',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('.data-totalEarnings').text(response);
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', status, error);
              }   
          }));

          // Total Deduction
          requests.push($.ajax({
              url: 'pay-salaryrecord.php',
              type: 'POST',
              data: { 
                  data_to_retrieve: 'totaldeduction',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('.data-totalDeducts').text(response);
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', status, error);
              }   
          }));

          // Net Salary
          requests.push($.ajax({
              url: 'pay-salaryrecord.php',
              type: 'POST',
              data: { 
                  data_to_retrieve: 'netsalary',
                  date: data.selectedDate,
                  empId: empId 
              },
              success: function(response) {
                  $('.data-netSalary').text(response);
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', status, error);
              }   
          }));
      }

      // Handles Anniversary Bonus (or any other published bonus period) selection.
      // Completely separate from normal payroll cutoff data — no pay-salaryrecord.php calls.
      function selectBonusPeriod(data) {
          isBonusView = true;

          // Reset only VALUE cells (td.data) — NOT th.data labels like "NET SALARY"
          $('td.data').text('0.00');
          $('#otherPayRow').nextUntil(':not(.remark-detail-row)').remove();
          $('#otherDeductRow').nextUntil(':not(.remark-detail-row)').remove();
          $('#bonusRow').nextUntil(':not(.remark-detail-row)').remove();
          $('#bonusRow').show();

          $('.slipDateOfPayment').text('');
          $('.slipPayPeriod').text(data.label);
          $('#selectedDate').val(data.periodKey);

          // Acknowledge button not applicable to bonus view until we know its status — reset to default state
          var $btn = $('.btn-ack');
          $btn.removeClass('acknowledged');
          $btn.css({
              'background': '',
              'cursor': '',
              'pointer-events': ''
          });
          $btn.html('Acknowledge <span class="eks"><img height="20px" src="statusImage//xmark.png"></span>');

          $.ajax({
              url: 'pay-bonusrecord.php',
              type: 'POST',
              dataType: 'json',
              data: {
                  action: 'getMyBonuses',
                  periodKey: data.periodKey
              },
              success: function(response) {
                  if (response && response.total) {
                      $('.data-bonus').text(response.total);
                      $('.data-totalEarnings').text(response.total);
                      $('.data-netSalary').text(response.total);
                  } else {
                      $('.data-bonus').text('0.00');
                      $('.data-totalEarnings').text('0.00');
                      $('.data-netSalary').text('0.00');
                  }

                  if (response && response.count > 0) {
                      var insertAfter = $('#bonusRow');
                      response.items.forEach(function(item) {
                          var displayText = (item.remarks && item.remarks.trim() !== '') ? item.remarks : item.label;
                          var detailRow = $('<tr class="remark-detail-row">' +
                              '<th scope="row">- ' + displayText + '</th>' +
                              '<td>' + item.amount + '</td>' +
                              '</tr>');
                          insertAfter.after(detailRow);
                          insertAfter = detailRow;
                      });
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Bonus Error:', status, error);
                  $('.data-bonus').text('0.00');
              }
          });
      }

      function addCommasToNumber(number) {
          return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      // Print functionality
      // $(document).ready(function() {
      //     $(".print-btn").click(function() {
      //         var printContents = document.getElementById("payslip-content").innerHTML;
      //         var originalContents = document.body.innerHTML;
      //         document.body.innerHTML = printContents;
      //         window.print();
      //         document.body.innerHTML = originalContents;
      //     });

      //     window.addEventListener("afterprint", function(event) {
      //         location.reload();
      //     });
      // });
      // Print functionality
      $(document).ready(function() {
          $(".print-btn").click(function() {
              var printContents = document.getElementById("payslip-content").innerHTML;

              var printWindow = window.open('', '_blank', 'width=800,height=600');
              printWindow.document.write(`
                  <!DOCTYPE html>
                  <html>
                  <head>
                      <meta charset="UTF-8">
                      <title>Payslip</title>
                      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
                      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                      <style>
                          @page { size: A4 portrait; margin: 10mm; }
                          * { box-sizing: border-box; }
                          body { 
                              background: white; 
                              padding: 0; 
                              margin: 0; 
                              font-family: 'Segoe UI', system-ui, sans-serif;
                          }
                          .slip { 
                              border: 1px solid #ccc; 
                              border-radius: 6px; 
                              overflow: hidden; 
                              background: white; 
                              width: 160mm;
                              margin: 0 auto;
                              font-size: 10px;
                          }
                          .slip .d-flex { padding: 10px 14px; background: linear-gradient(135deg, #f9cf46 0%, #d4a800 100%) !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                          #slip-logo { width: 120px; height: auto; }
                          .rightText { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; margin: 8px 12px; padding: 8px 10px; background: #fdf9ee !important; border: 1px solid #e8d98a; border-radius: 4px; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                          .rightText p { margin-bottom: 4px; color: #4a5568; padding: 0; font-size: 9px; }
                          .slip p { margin-bottom: 4px; color: #4a5568; padding-left: 12px; padding-right: 12px; font-size: 9px; }
                          .slip strong { color: #2d3748; }
                          .table { width: 100%; border-collapse: collapse; font-size: 9px; table-layout: fixed; margin-top: 8px; margin-bottom: 0; }
                          .payslip-tables { display: flex; align-items: flex-start; }
                          .payslip-tables .table { flex: 1 1 50%; min-width: 0; }
                          table.table-earnings { border-right: 2px solid #e2e8f0; }
                          table.table-deductions { border-left: none; }
                          .table thead th:nth-child(1), .table tbody th:nth-child(1), .table tfoot th:nth-child(1) { width: 76%; }
                          .table thead th:nth-child(2), .table tbody td:nth-child(2), .table tfoot td:nth-child(2) { width: 24%; }
                          .table thead th { background: #cdae11 !important; color: #1a2535; font-weight: 700; padding: 6px 8px; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                          .table tbody th { font-weight: 600; color: #2d3748; padding: 5px 7px; }
                          .table tbody td { text-align: right; padding: 5px 7px; }
                          .table tbody tr:nth-child(odd) th, .table tbody tr:nth-child(odd) td { background-color: #ffffff; }
                          .table tbody tr:nth-child(even) th, .table tbody tr:nth-child(even) td { background-color: #fafafa; }
                          .table tfoot th, .table tfoot td { font-weight: 700; padding: 6px 7px; }
                          .table-dark { background: linear-gradient(90deg, #f0c000 0%, #c89a00 100%) !important; color: #1a2535 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                          .remark-detail-row th, .remark-detail-row td { padding: 2px 8px !important; font-size: 8px; font-style: italic; color: #666; background: transparent !important; border: none !important; }
                          .remark-detail-row th:first-child { padding-left: 22px !important; }
                          .table-group-divider { border-top: 2px solid #dee2e6; }
                          #output { display: none; }
                      </style>
                  </head>
                  <body>
                      ${printContents}
                      <script>
                          window.onload = function() {
                              window.print();
                              window.onafterprint = function() { window.close(); };
                          };
                      <\/script>
                  </body>
                  </html>
              `);
              printWindow.document.close();
          });
      });

      function beforePrint() {
          $('.print-btn').addClass('d-none');
          $('.slip').css('border', '1px dashed');
          $('.slip').css('padding', '25px');
          $('.rightText').css('text-align','right');
      }

      function afterPrint() {
          $('.print-btn').removeClass('d-none');
          $('.slip').css('border', '1px dashed');
          $('.slip').css('padding', '50px');
          $('.rightText').css('text-align','right');
      }

      if (window.matchMedia) {
          var mediaQueryList = window.matchMedia('print');
          mediaQueryList.addListener(function(mql) {
              if (mql.matches) {
                  beforePrint();
              } else {
                  afterPrint();
              }
          });
      }

    </script>
  </body>
  </html>