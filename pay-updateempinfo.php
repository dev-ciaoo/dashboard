<!-- NEW -->
<?php
include('connection.php');
include('pay-viewearning.php');
include('pay-viewotherpay.php');
include('pay-viewotherdeduct.php');

$id = $_GET['id'];
$id = mysqli_real_escape_string($con, $id);

// FIXED SQL QUERY - Get the LATEST non-deleted loan
$sql = "SELECT e.*, a.*, l.* FROM empinfo AS e
        LEFT JOIN accounts AS a ON a.employeeId = e.empId
        LEFT JOIN pay_earningsloan AS l ON l.employeeId = e.empId 
        AND (l.datedeleted = '' OR l.datedeleted IS NULL)
        WHERE e.empId = '$id'
        ORDER BY l.id DESC
        LIMIT 1";

$result = $con->query($sql);

// Initialize variables
$salaryloan = "";
$slYear = "";
$slPayment = "";
$slDate = "";
$slDuedate = "";
$slAmortization = "";
$slAmortizationFirst = "";
$slAmortizationLast = "";
$slBalance = "";
$slCutoffSelect = "";
$slBank = "";
$principal = "0.00";
$interest = "0.00";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // --- Standard Employee Info ---
        $userAvatar = $row['userAvatar'];
        $empId = $id;
        $fullName = $row['fullName'];
        $bday = $row['bday'];
        $civilStats = $row['civilStats'];
        $empAddr = $row['townAddress'];
        $branch = $row['address'];
        $empDept =  $row['userDepartment'];
        $userEmail = $row['userEmail'];
        $bankPosition = $row['bankPosition'];
        $dateHired = $row['dateHired'];        
        $sssinfo = $row['sss'];
        $tininfo = $row['tin'];
        $pagibiginfo = $row['pagibig'];
        $philhealthinfo = $row['philhealth'];
        $contactPerson = $row['contactPerson'];
        $emergencyNum = $row['emergencyNum'];
        $empStatus = $row['empStatus'];
        $empPosition= $row['empPosition'];
        $flexTime= $row['flexTime'];
        $remarks= $row['remarks'];
        $VL= $row['VL'];
        $ML= $row['ML'];
        $SL= $row['SL'];

        // --- SALARY LOAN DATA FETCHING ---
        if (!empty($row['salaryloan'])) {
            $salaryloan = $row['salaryloan'];
            $slYear = $row['slYear'];
            $slPayment = $row['slPayment'];
            $slDate = $row['slDate'];
            $slDuedate = $row['slDuedate'];
            $slAmortization = $row['slAmortization'];
            $slAmortizationFirst = $row['slAmortizationFirst'];
            $slAmortizationLast = $row['slAmortizationLast'];
            $slBalance = $row['slBalance'];
            $slCutoffSelect = $row['slCutoffSelect'];
            $slBank = $row['slBank'];
            
            $principal = "0.00"; 
            $interest = "0.00";
        }

        // --- Department Logic ---
        $departments = [
            '21' => 'Marketing Specialist', '20' => 'Audit', '19' => 'Credit Risk', '18' => 'Credit',
            '17' => 'Loan Documentation', '16' => 'President', '15' => 'GM', '14' => 'CASA Maragondon',
            '13' => 'CASA Magallanes', '12' => 'CASA Ternate', '11' => 'CASA Manggahan', '10' => 'CASA Poblacion',
            '9' => 'CASA Noveleta', '8' => 'CASA Head Office', '7' => 'Compliance', '6' => 'Collection',
            '5' => 'Accounting', '4' => 'LOAN', '3' => 'ROPOA', '2' => 'HR', '1' => 'IT'
        ];
        $row['userDepartment'] = $departments[$row['userDepartment']] ?? 'Unknown Department';
        $userDepartment= $row['userDepartment'];
    }
}

if($empId == "3000"){ $empId = "5A"; }

// ... (Keep your report/options logic below this) ...
$sql = "SELECT * FROM pay_selecteddate GROUP BY date ORDER BY STR_TO_DATE(date, '%M %e, %Y') ASC";
$result = $con->query($sql);
$options = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options[] = [
        'selectedDate' => $row['selectedDate'],
        'date'         => $row['date'],
        'startdate'    => $row['startdate'],  
        'enddate'      => $row['enddate']     
    ];
    }
}
$optionsJson = json_encode($options);
?>

<style>
img{
  max-height:1000px;
}
.topnav {
  overflow: hidden;
  background-color:  white;
  margin-bottom: 20px;
}

.topnav a {
  float: left;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #FFD733 ;
  color: black;
  font-weight:bold;
}

.content {
  display: none;
}


#employeecontent {
  display: block; 
}

.form-control {
  flex: 1;
}

.nav-tabs {
  overflow: hidden;
  background-color:  white;
  margin-bottom: 20px;
}

.nav-tabs .nav-item a {
  float: left;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.nav-tabs .nav-item a:hover {
  background-color: #ddd;
  color: black;
}

.nav-tabs .nav-item a.active {
  background-color: #FFD733 ;
  color: black;
  font-weight:bold;
}

<?php if($_SESSION['department'] !== '1' && $_SESSION['department'] !== '2'){ ?>

#forhr input{
  background-color: #F5F5F5;
  cursor: default;
  border: none;
}
#employeecontent input{
  background-color: #F5F5F5;
  cursor: default;
  border: none;
}

#employeecontent textarea{
  background-color: #F5F5F5;
  cursor: default;
  border: none;
}

<?php }else{ ?>
#foraccounting input{
  background-color: #F5F5F5;
  cursor: default;
}
#foraccounting select{
  background-color: #F5F5F5;
  cursor: default;
}

#foraccounting input [name="slcutoffSelect"]{
  background-color: #F5F5F5;
  cursor: default;
}
<?php } ?>

#otherpaytable {
    table-layout: fixed;
    width: 100%;
}

#otherpaytable th, #otherpaytable td {
    word-wrap: break-word;
    white-space: normal;
    overflow: hidden; 
    vertical-align: top; 
}

#deducttable {
    table-layout: fixed;
    width: 100%;
}

#deducttable th, #deducttable td {
    word-wrap: break-word;
    white-space: normal;
    overflow: hidden; 
    vertical-align: top; 
}

/* Container for the Pill Bar */
.progress-bar-container {
    width: 100%;
    height: 30px;
    background: #e9ecef;
    border-radius: 15px; /* Pill Shape */
    overflow: hidden;
    position: relative;
    border: 1px solid #dee2e6;
    margin-bottom: 5px;
}

/* The Green Gradient Fill */
.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #28a745 0%, #20c997 100%); /* Exact Gradient */
    transition: width 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 13px;
    width: 0%;
}

/* Text Below */
.progress-text {
    margin-top: 8px;
    text-align: center;
    font-size: 13px;
    color: #666;
    font-weight: 600;
}

/* Button Style */
.btn-fully-paid {
    width: 100%;
    max-width: 300px;
    margin: 20px auto 0;
    display: block;
    padding: 12px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s;
    text-transform: uppercase;
}
.btn-fully-paid:hover { background: #c82333; }
.btn-fully-paid.active { background: #198754; }

/* img { max-height:1000px; }
        .topnav { overflow: hidden; background-color: white; margin-bottom: 20px; }
        .content { display: none; }
        #earningscontent { display: block;
        
    
}  */

</style>

<div  class="topnav d-flex justify-content-center">
  <a  style="border: 3px solid grey;border-style: solid solid solid solid;" class="active form-control" id="Employee" href="#employeecontent">EMPLOYEE INFO</a>
  <a  style="border: 3px solid grey;border-style: solid solid solid none;"  class=" form-control" id="Earnings" href="#earningscontent">EARNINGS & DEDUCTIONS</a>
  <a  style="border: 3px solid grey;border-style: solid solid solid none;"  class=" form-control" id="OtherPay" href="#payother">OTHER PAYMENT</a>
  <a  style="border: 3px solid grey;border-style: solid solid solid none;"  class=" form-control" id="OtherDeduction" href="#deductcontent">OTHER DEDUCTION</a>
  <!-- REPORT EARNING PAGE HIDE -->
  <a  style="border: 3px solid grey;border-style: solid solid solid none;"  class=" form-control" id="Report" href="#reportcontent">REPORT</a> 
</div>

<div class="content" id="deductcontent">
  <div class="d-flex py-2 justify-content-end align-items-end">
  <div class="d-flex gap-2 me-auto justify-content-left align-items-left">
      <span><strong>TOTAL :</strong></span><span id="totalOtherdeduct">0.00</span>
  </div>
  <a <?php if($_SESSION['department'] == '1' || $_SESSION['department'] == '2'|| $_SESSION['department'] == '5'){ ?> onclick="addRow2()" <?php } ?> class="btn btn-outline-secondary "><i class='fa-lg fa-solid fa-plus'></i></a>
  </div>
  <div class="d-flex  justify-content-center align-items-center">
    <table id ="deducttable" class="table  table-bordered">
      <thead class="text-center">
          <th>DATE</th>
          <th>AMOUNT</th>
          <th>REMARKS</th>
          <th>ACTION</th>
      </thead>
      <tbody>
      <?php 
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

                ?>
        <tr data-id="<?php echo $idDeduct; ?>">
        <td class="text-center Deductcell" contenteditable='true' data-name="date"><?php echo $dateDeduct ?></td>
        <td class="deductamount text-center Deductcell" contenteditable='true' data-name="amount"><?php echo $amountDeduct ?></td>
        <td class="text-center Deductcell" contenteditable='true' data-name="remarks"><?php echo $remarksDeduct ?></td>
        <td class="text-center"></a>
        <a  data-id="<?= $idDeduct ?>" id="deleteDeduct"class=" btn btn-danger">DELETE</i></a>
        </td>
        </tr> 
        <?php   }
            } else { ?>
                <td colspan="4">No Record</td>
        <?php  } ?>
      </tbody>

    </table>
  </div>
</div>

<div class="content" id="employeecontent">
  <form method="POST" id="employeeForm" action="pay-updateemployee.php" enctype="multipart/form-data">
    <input type="hidden" name="vId" id="vId" value="">
    <input type="hidden" name="tvId" id="tvId" value="">
    <input type="hidden" name="idinfo" id="idinfo" value="<?= $empId ?>">
    <div class="row">
    <div style="max-width:500px;max-height:600px;" class="form-group image-container text-center col-md-4 row mb-3">
      <img title="Click to change photo" id="img" class="rounded" src="<?= $userAvatar; ?>" style="width: 100%; height: 100%; object-fit: contain; padding: 0px;cursor: pointer;">
      <input type="file" id="uploadPic" class="no-readonly" style="display: none;" />
      <!-- <input type="file" id="uploadPic" style="display: none;" /> -->
    </div>
    
      <!-- 1st Layer -->
      <div class=" col-md-4">
        <div class="form-group row mb-3">
          <label for="empID" class="col-md-4 col-form-label text-md-right">EMPLOYEE ID</label>
          <div class="col-md-8">
              <input readonly style="background-color: #F5F5F5;cursor: default;border: none;font-weight: bold;"  type="text" class="input-sm form-control" id="empID" name="empID" value="<?= '2020-0' . $empId; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empName" class="col-md-4 col-form-label text-md-right">NAME</label>
          <div class="col-md-8">
              <input readonly style="background-color: #F5F5F5;cursor: default;border: none;font-weight: bold;" type="text" class="input-sm form-control" id="empName" name="empName" value="<?= strtoupper($fullName); ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empBday" class="col-md-4 col-form-label text-md-right">BIRTH DATE</label>
          <div class="col-md-8">
              <input style="font-weight: bold;" style="font-weight:bold" type="text" class="form-control" id="empBday" name="empBday" value="<?= strtoupper($bday); ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empCivil" class="col-md-4 col-form-label text-md-right">CIVIL STATUS</label>
          <div class="col-md-8">
            <input style="font-weight:bold" type="text" class="form-control" id="empCivil" name="empCivil" value="<?= $civilStats; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empAddr" class="col-md-4 col-form-label text-md-right">ADDRESS</label>
          <div class="col-md-8">
            <textarea style="font-weight:bold" type="text" class="form-control" id="empAddr" name="empAddr" cols="50" rows="2" ><?= $empAddr; ?></textarea>
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empBranch" class="col-md-4 col-form-label text-md-right">BRANCH</label>
          <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;cursor: default;border: none;font-weight: bold;" type="text" class="form-control" id="empBranch" name="empBranch" value="<?= strtoupper($branch); ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empDept" class="col-md-4 col-form-label text-md-right">DEPARTMENT</label>
          <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;cursor: default;border: none;font-weight: bold;" type="text" class="form-control" id="empDept" name="empDept" value="<?= strtoupper($userDepartment); ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empEmail" class="col-md-4 col-form-label text-md-right">EMAIL</label>
          <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;cursor: default;border: none;font-weight: bold;" style="font-weight:bold" type="email" class="form-control" id="empEmail" name="empEmail" value="<?= $userEmail; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empPosition" class="col-md-4 col-form-label text-md-right">POSITION</label>
          <div class="col-md-8">
            <input style="font-weight:bold" type="text" class="form-control" id="empPosition" name="empPosition" value="<?= strtoupper($empPosition); ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="empDatehired" class="col-md-4 col-form-label text-md-right">DATE HIRED</label>
          <div class="col-md-8">
            <input  style="font-weight: bold;" type="text" class="form-control" id="empHired" name="empHired" value="<?= strtoupper($dateHired); ?>">
          </div>
        </div>
      </div>
      <!-- 2nd Layer -->
      <div class="col-md-4">
        <div class="form-group row mb-3">
            <label for="sssinfo" class="col-md-4 col-form-label text-md-right">SSS</label>
          <div class="col-md-8">
            <input  style=" font-weight: bold;"  type="text" class="form-control" id="sssinfo" name="sssinfo" value="<?= $sssinfo; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="tininfo" class="col-md-4 col-form-label text-md-right">TIN</label>
          <div class="col-md-8">
            <input  style="font-weight: bold;"  type="text" class="form-control" id="tininfo" name="tininfo" value="<?= $tininfo; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="pagibiginfo" class="col-md-4 col-form-label text-md-right">PAG-IBIG</label>
          <div class="col-md-8">
            <input  style=" font-weight: bold;"  type="text" class="form-control" id="pagibiginfo" name="pagibiginfo" value="<?= $pagibiginfo; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="philhealthinfo" class="col-md-4 col-form-label text-md-right">PHILHEALTH</label>
          <div class="col-md-8">
            <input  style=" font-weight: bold;"  type="text" class="form-control" id="philhealthinfo" name="philhealthinfo" value="<?= $philhealthinfo; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="contactPerson" class="col-md-4 col-form-label text-md-right">CONTACT PERSON</label>
          <div class="col-md-8">
            <input  style="font-weight:bold" type="text" class="form-control" id="contactPerson" name="contactPerson" value="<?= $contactPerson; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label for="emergencyNum" class="col-md-4 col-form-label text-md-right">EMERGENCY #</label>
          <div class="col-md-8">
            <input  style="font-weight:bold" type="text" class="form-control" id="emergencyNum" name="emergencyNum" value="<?= $emergencyNum; ?>">
          </div>
        </div>
        <div class="form-group row mb-3">
          <label for="emergencyNum" class="col-md-4 col-form-label">Employee Stats</label>
          <div style=""class="col-md-6">
            <div style="display:inline-block;margin-right:10px;">
              <input value="Regular" <?php if($empStatus == 'Regular' || $empStatus == 'Consultant'){?> checked <?php } ?> type="checkbox" id="regularCheck" name="empStatus" class="form-check-input">
              <label  style="cursor: default; border: none; font-weight: bold;" for ="regularCheck">REGULAR</label>
            </div>
            <div style="display:inline-block;margin-right:10px;">
            <input value ="Probationary" <?php if($empStatus == 'Probationary' || empty($empStatus)){?> checked <?php } ?> type="checkbox" id="probiCheck" name="empStatus" class="form-check-input" >
            <label   style="cursor: default;  border: none; font-weight: bold;" for ="probiCheck">PROBITIONARY</label>
            </div>
          </div>
        </div>
        <div class="form-group row mb-3">
          <label for="emergencyNum" class="col-md-4 col-form-label">Work Schedule</label>
          <div style=""class="col-md-8">
            <div style="display:inline-block;margin-right:10px;">
              <input value="0" <?php if($flexTime == '0' || empty($flexTime)){?> checked <?php } ?> type="checkbox" id="nonflexCheck" name="empSched" class="form-check-input">
              <label  style="cursor: default; border: none; font-weight: bold;" for ="nonflexCheck">NON-FLEXIBLE TIME</label>
            </div>
            <div style="display:inline-block;margin-right:10px;">
              <input value ="1" <?php if($flexTime == '1' ){?> checked <?php } ?> type="checkbox" id="flexCheck" name="empSched" class="form-check-input" >
              <label   style="cursor: default;  border: none; font-weight: bold;" for ="flexCheck">FLEXIBLE TIME</label>
            </div>
              <input value ="<?= $remarks; ?>" type="input" id="remarksSched" name="remarksSched" placeholder="REMARKS FOR WORK SCHEDULE" class="form-control" >
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="content" id="earningscontent">
  <form id="myform" method="POST" action="pay-updateearningsHR.php">
    <input type="hidden" id="employeeId" name="employeeId" value="<?php echo htmlspecialchars($id); ?>">
    <input type="hidden" name="name" value="<?php echo $fullName; ?>">
    <!-- <input type="hidden" name="position" value="<?php echo htmlspecialchars($position); ?>"> -->
     <!-- To this: -->
<input type="hidden" name="bankPosition" value="<?php echo htmlspecialchars($bankPosition); ?>">
    <input type="hidden" name="address" value="<?php echo htmlspecialchars($branch); ?>">
<div class="container">
<div class="row">
  <div id="forhr" class="col-md-6" >
  <div class="form-group row mb-3">
    <label for="monthlyrate" class="col-md-4 col-form-label text-md-right">MONTHLY SALARY</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($monthlyRate) ? $monthlyRate : ''; ?>" required class="form-control" name="monthlyrate" id="monthlyrate" type="number">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="riceallowance" class="col-md-4 col-form-label text-md-right">RICE ALLOWANCE</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($riceAllowance) ? $riceAllowance : ''; ?>" class="form-control" name="riceallowance" id="riceallowance" type="number">
    </div>
  </div>
  <div class="form-group row">
    <label for="transpo" class="col-md-4 col-form-label text-md-right">TRANSPO. ALLOWANCE</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($transpoAllowance) ? $transpoAllowance : ''; ?>" class="form-control" name="transpo" id="transpo" type="number">
      <div class="d-flex align-items-center flex-row m-2">
        <input <?php if($transpoSelect == "Firstcutoff"){ ?> checked <?php }?> class="form-check-input" type="radio" id="transpoFirst" name="transpoSelect" value="Firstcutoff">
        <label class="form-check-label" for="transpoFirst">First Cut Off</label><br>
        <input <?php if($transpoSelect == "Lastcutoff"){?> checked <?php }?> class="form-check-input" type="radio" id="transpoLast" name="transpoSelect" value="Lastcutoff">
        <label class="form-check-label" for="transpoLast">Last Cut Off</label>
      </div>
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="sss" class="col-md-4 col-form-label text-md-right">SSS (EE)</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($sss) ? $sss : ''; ?>" class="form-control" name="sss" id="sss" type="number">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="sssmand" class="col-md-4 col-form-label text-md-right">SSS MANDATORY (EE)</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($sssmand) ? $sssmand : ''; ?>" class="form-control" name="sssmand" id="sssmand" type="number">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="pagibig" class="col-md-4 col-form-label text-md-right">PAGIBIG (EE)</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo $pagibig; ?>" class="form-control" name="pagibig" id="pagibig" type="number">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="philhealth" class="col-md-4 col-form-label text-md-right">PHILHEALTH (EE)</label>
    <div class="col-md-8">
      <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($philhealth) ? $philhealth : ''; ?>" class="form-control" name="philhealth" id="philhealth" type="number">
    </div>
  </div>
<div class="form-group row mb-3">
    <label for="tax" class="col-md-4 col-form-label text-md-right">WITHHOLDING TAX</label>
    <div class="col-md-8">
      <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($tax) ? $tax : ''; ?>"  class="form-control" name="tax" id="tax" type="number">
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="otherAllow" class="col-md-4 col-form-label text-md-right">OTHER ALLOWANCE</label>
    <div class="col-md-8">
      <input value="<?php echo isset($otherAllow) ? $otherAllow : ''; ?>" style="font-weight:bold;max-width:300px;"  value=""  class="form-control" name="otherAllow" id="otherAllow" type="number">
      <div class="d-flex align-items-center flex-row m-2">
        <input <?php if($otherAllowSelect == "Firstcutoff"){ ?> checked <?php }?> class="form-check-input" type="radio" id="otherAllowFirst" name="otherAllowSelect" value="Firstcutoff">
        <label class="form-check-label" for="otherAllowFirst">First Cut Off</label><br>
        <input <?php if($otherAllowSelect == "Lastcutoff"){ ?> checked <?php }?> class="form-check-input" type="radio" id="otherAllowLast" name="otherAllowSelect" value="Lastcutoff">
        <label class="form-check-label" for="otherAllowLast">Last Cut Off</label>
      </div>
    </div>
  </div>
  <div class="form-group row mb-3">
    <label for="tax" class="col-md-4 col-form-label text-md-right">SPECIAL ALLOWANCE</label>
    <div class="col-md-8">
      <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($specialAllow) ? $specialAllow : ''; ?>"  class="form-control" name="specialAllow" id="specialAllow" type="number">
    </div>
  </div>
<fieldset style="margin-top:10px;">
<legend><strong style="text-decoration: underline;">EMPLOYER</strong></legend>
<div class="form-group row mb-3">
    <label for="tax" class="col-md-4 col-form-label text-md-right">SSS (ER)</label>
    <div class="col-md-8">
      <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($sssEmployer) ? $sssEmployer : ''; ?>"  class="form-control" name="sssEmployer" id="sssEmployer" type="number">
    </div>
</div>
<div class="form-group row mb-3">
    <label for="tax" class="col-md-4 col-form-label text-md-right">SSS MANDATORY (ER)</label>
    <div class="col-md-8">
      <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($sssmandEmployer) ? $sssmandEmployer : ''; ?>"  class="form-control" name="sssmandEmployer" id="sssmandEmployer" type="number">
    </div>
</div>
<div class="form-group row mb-3">
    <label for="tax" class="col-md-4 col-form-label text-md-right">PAGIBIG (ER)</label>
    <div class="col-md-8">
      <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($pagibigEmployer) ? $pagibigEmployer : ''; ?>"  class="form-control" name="pagibigEmployer" id="pagibigEmployer" type="number">
    </div>
</div>
<div class="form-group row mb-3">
    <label for="tax" class="col-md-4 col-form-label text-md-right">PHILHEALTH (ER)</label>
    <div class="col-md-8">
      <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($philhealthEmployer) ? $philhealthEmployer : ''; ?>"  class="form-control" name="philhealthEmployer" id="philhealthEmployer" type="number">
    </div>
</div>
</fieldset>
</div>
</form>
<div id="foraccounting" class="col-md-6">
<form id="myform2" method="POST" action="pay-updateearningLoan.php">
    <input type="hidden" id="employeeId" name="employeeId" value="<?php echo htmlspecialchars($id); ?>">
    <input type="hidden" name="name" value="<?php echo $fullName; ?>">
    <input type="hidden" name="position" value="<?php echo htmlspecialchars($position); ?>">
    <input type="hidden" name="address" value="<?php echo htmlspecialchars($branch); ?>">
<div style="border-color:red;" class="mb-2 border border-danger p-2">
<div class="form-group row mb-3">
  <label for="sssloan" class="col-md-12 col-form-label text-md-center"><strong>SSS LOAN</strong></label>
</div>
<div class="form-group row mb-3">
  <label for="sssloanDuedate" class="col-md-4 col-form-label text-md-right">PAYMENT </label>
  <div class="col-md-8">
    <select  style="font-weight:bold;font-size:16px;;max-width:300px;"  class="form-control form-select" name="sssloanPayment" id="sssloanPayment" novalidate>
        <option id="none" value="" <?php if(empty($sssloanPayment)){ ?>selected<?php } ?> >Select Payment Method</option>
        <option id="cutoff" value="2" <?php if($sssloanPayment == '2'){ ?>selected<?php } ?>>Per Cut Off</option>
        <option id="month" value="1" <?php if($sssloanPayment == '1'){ ?>selected<?php } ?>>Per Month</option>
        <option id="" value="3" <?php if($sssloanPayment == '3'){ ?>selected<?php } ?>>Deffered</option>
      </select>
  </div>
</div>
<div class=" sssloanRadio  form-group row mb-3">
  <label for="slyear" class="col-md-4 col-form-label text-md-right"></label>
  <div class="col-md-8 ">
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "sssloanRadio" for="Firstcutoff" >First Cut Off</label>
    <input  style="cursor: default; background-color: #F5F5F5; border: none; font-weight: bold;" type="radio" class="sssloanRadio" name ="sssloanCutoffSelect" value = "Firstcutoff" id="" <?php if($sssloanCutoffSelect == 'Firstcutoff'){ ?>checked<?php } ?>>
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "sssloanRadio" for="Firstcutoff">Last Cut Off</label>
    <input  style="font-weight:bold" type="radio" class="sssloanRadio" name ="sssloanCutoffSelect" value = "Lastcutoff" id="" <?php if($sssloanCutoffSelect == 'Lastcutoff'){ ?>checked<?php } ?>> 
  </div>
</div>
<div class="sssloan1 form-group align-items-center row mb-3">
  <label for="sssloan" class="col-md-4 col-form-label text-md-right">MONTHLY AMORTIZATION</label>
  <div class="col-md-8 text-center justify-content-center">
  <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($sssloan) ? $sssloan : ''; ?>" class="form-control sss" name="sssloan" id="sssloan" type="number">
  </div>
</div>
<div style="display:none;" class="sssloan2 form-group align-items-center row mb-3">
  <label for="sssloan" class="col-md-4 col-form-label text-md-right">FIRST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
  <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($sssloanFirst) ? $sssloanFirst : ''; ?>" class="form-control" name="sssloanfirst" id="sssloanfirst" type="number">
  </div>
</div>
<div style="display:none;" class="sssloan2 form-group align-items-center row mb-3">
  <label for="sssloan" class="col-md-4 col-form-label text-md-right">LAST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
  <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($sssloanLast) ? $sssloanLast : ''; ?>" class="form-control" name="sssloanlast" id="sssloanlast" type="number">
  </div>
</div>
<div class="form-group sssloan row mb-3">
  <label or="sssloanDate" class="col-md-4 col-form-label text-md-right">LOAN START DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo isset($sssloanDate) ? $sssloanDate : ''; ?>" class="form-control" name="sssloanDate" id="sssloanDate" type="date">
  </div>
</div>
<div class="form-group sssloan row mb-3">
  <label for="sssloanDuedate" class="col-md-4 col-form-label text-md-right">LOAN END DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo $sssloanDuedate; ?>" class="form-control" name="sssloanDuedate" id="sssloanDuedate" type="date">
  </div>
</div>
</div>
<div class="border mb-2 border-primary p-2">
<div class="form-group row mb-3">
  <label for="sssloan" class="col-md-12 col-form-label text-md-center"><strong>SSS CALAMITY</strong></label>
</div>
<div class="form-group  row mb-3">
  <label for="sssloanDuedate" class="col-md-4 col-form-label text-md-right">PAYMENT </label>
  <div class="col-md-8">
    <select  style="font-weight:bold;font-size:16px;;max-width:300px;"  class="form-control form-select" name="ssscalamityPayment" id="ssscalamityPayment" novalidate>
        <option id="none" value="" <?php if(empty($ssscalamityPayment)){ ?>selected<?php } ?> >Select Payment Method</option>
        <option id="cutoff" value="2" <?php if($ssscalamityPayment == '2'){ ?>selected<?php } ?>>Per Cut Off</option>
        <option id="month" value="1" <?php if($ssscalamityPayment == '1'){ ?>selected<?php } ?>>Per Month</option>
        <option id="" value="3" <?php if($ssscalamityPayment == '3'){ ?>selected<?php } ?>>Deffered</option>
      </select>
  </div>
</div>
<div class=" ssscalamityRadio form-group row mb-3">
  <label for="slyear" class="col-md-4 col-form-label text-md-right"></label>
  <div class="col-md-8 ">
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "ssscalamityRadio" for="Firstcutoff" >First Cut Off</label>
    <input  style="cursor: default; background-color: #F5F5F5; border: none; font-weight: bold;" type="radio" class="ssscalamityRadio" name ="ssscalamityCutoffSelect" value = "Firstcutoff" id="" <?php if($ssscalamityCutoffSelect == 'Firstcutoff'){ ?>checked<?php } ?>>
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "ssscalamityRadio" for="Firstcutoff">Last Cut Off</label>
    <input  style="font-weight:bold" type="radio" class="ssscalamityRadio" name ="ssscalamityCutoffSelect" value = "Lastcutoff" id="" <?php if($ssscalamityCutoffSelect == 'Lastcutoff'){ ?>checked<?php } ?>> 
  </div>
</div>
<div class="form-group ssscalamity1 align-items-center row mb-3">
  <label for="ssscalamity" class="col-md-4 col-form-label text-md-right">MONTHLY AMORTIZATION</label>
  <div class="col-md-8">
    <input style="font-weight:bold;;max-width:300px;" value="<?php echo isset($ssscalamity) ? $ssscalamity : ''; ?>" class="form-control" name="ssscalamity" id="ssscalamity" type="number">
  </div>
</div>
<div style="display:none;" class="form-group ssscalamity2 align-items-center row mb-3">
  <label for="ssscalamity" class="col-md-4 col-form-label text-md-right">FIRST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
    <input style="font-weight:bold;;max-width:300px;" value="<?php echo isset($ssscalamityFirst) ? $ssscalamityFirst : ''; ?>" class="form-control" name="ssscalamityfirst" id="ssscalamityfirst" type="number">
  </div>
</div>
<div style="display:none;" class="form-group ssscalamity2 align-items-center row mb-3">
  <label for="ssscalamity" class="col-md-4 col-form-label text-md-right">LAST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
    <input style="font-weight:bold;;max-width:300px;" value="<?php echo isset($ssscalamityLast) ? $ssscalamityLast : ''; ?>" class="form-control" name="ssscalamitylast" id="ssscalamitylast" type="number">
  </div>
</div>
<div class="form-group ssscalamity row mb-3">
  <label for="ssscalamityDate" class="col-md-4 col-form-label text-md-right">LOAN START DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo isset($ssscalamityDate) ? $ssscalamityDate : ''; ?>" class="form-control" name="ssscalamityDate" id="ssscalamityDate" type="date">
  </div>
</div>

<div class="form-group ssscalamity row mb-3">
  <label for="ssscalamityDuedate" class="col-md-4 col-form-label text-md-right">LOAN END DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo isset($ssscalamityDuedate) ? $ssscalamityDuedate : ''; ?>" class="form-control" name="ssscalamityDuedate" id="ssscalamityDuedate" type="date">
  </div>
</div>
</div>
<div class="border mb-2 border-warning p-2">
<div class="form-group row mb-3">
  <label for="sssloan" class="col-md-12 col-form-label text-md-center"><strong>PAGIBIG LOAN</strong></label>
</div>
<div class="form-group  row mb-3">
  <label for="sssloanDuedate" class="col-md-4 col-form-label text-md-right">PAYMENT </label>
  <div class="col-md-8">
    <select  style="font-weight:bold;font-size:16px;;max-width:300px;"  class="form-control form-select" name="pagibigloanPayment" id="pagibigloanPayment" novalidate>
        <option id="none" value="" <?php if(empty($pagibigloanPayment)){ ?>selected<?php } ?> >Select Payment Method</option>
        <option id="cutoff" value="2" <?php if($pagibigloanPayment == '2'){ ?>selected<?php } ?>>Per Cut Off</option>
        <option id="month" value="1" <?php if($pagibigloanPayment == '1'){ ?>selected<?php } ?>>Per Month</option>
        <option id="" value="3" <?php if($pagibigloanPayment == '3'){ ?>selected<?php } ?>>Deffered</option>
      </select>
  </div>
</div>
<div class="  pagibigloanRadio form-group row mb-3">
  <label for="slyear" class="col-md-4 col-form-label text-md-right"></label>
  <div class="col-md-8 ">
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "pagibigloanRadio" for="Firstcutoff" >First Cut Off</label>
    <input  style="cursor: default; background-color: #F5F5F5; border: none; font-weight: bold;" type="radio" class="pagibigloanRadio" name ="pagibigloanCutoffSelect" value = "Firstcutoff" id="" <?php if($pagibigloanCutoffSelect == 'Firstcutoff'){ ?>checked<?php } ?>>
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "pagibigloanRadio" for="Firstcutoff">Last Cut Off</label>
    <input  style="font-weight:bold" type="radio" class="pagibigloanRadio" name ="pagibigloanCutoffSelect" value = "Lastcutoff" id="" <?php if($pagibigloanCutoffSelect == 'Lastcutoff'){ ?>checked<?php } ?>> 
  </div>
</div>
<div class="form-group pagibigloan1 align-items-center row mb-3">
  <label for="pagibigloan" class="col-md-4 col-form-label text-md-right">MONTHLY AMORTIZATION</label>
  <div class="col-md-8">
    <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($pagibigloan) ? $pagibigloan : ''; ?>" class="form-control" name="pagibigloan" id="pagibigloan" type="number">
  </div>
</div>
<div style="display:none;" class="form-group  pagibigloan2 align-items-center row mb-3">
  <label for="pagibigloan" class="col-md-4 col-form-label text-md-right">FIRST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
    <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($pagibigloanFirst) ? $pagibigloanFirst : ''; ?>" class="form-control" name="pagibigloanfirst" id="pagibigloanfirst" type="number">
  </div>
</div>
<div style="display:none;" class="form-group pagibigloan2 align-items-center row mb-3">
  <label for="pagibigloan" class="col-md-4 col-form-label text-md-right">LAST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
    <input style="font-weight:bold;max-width:300px;" value="<?php echo isset($pagibigloanLast) ? $pagibigloanLast : ''; ?>" class="form-control" name="pagibigloanlast" id="pagibigloanlast" type="number">
  </div>
</div>
<div class="form-group pagibigloan row mb-3">
  <label for="pagibigloan" class="col-md-4 col-form-label text-md-right">LOAN START DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo isset($pagibigloanDate) ? $pagibigloanDate : ''; ?>" class="pagibigloan form-control" name="pagibigloanDate" id="pagibigloanDate" type="date">
  </div>
</div>
<div class="form-group pagibigloan row mb-3">
  <label for="pagibigloan" class="col-md-4 col-form-label text-md-right">LOAN END DATE</label>
  <div class="col-md-8">
    <input  style="font-weight:bold;font-size:16px;;max-width:300px;"  value="<?php echo isset($pagibigloanDuedate) ? $pagibigloanDuedate : ''; ?>"  class="pagibigloan form-control" name="pagibigloanDuedate" id="pagibigloanDuedate" type="date">
  </div>
</div>
</div>
<div class="border mb-2 border-success p-2">
<div class="form-group row mb-3">
  <label for="sssloan" class="col-md-12 col-form-label text-md-center"><strong>PAGIBIG CALAMITY</strong></label>
</div>
<div class="form-group  row mb-3">
  <label for="sssloanDuedate" class="col-md-4 col-form-label text-md-right">PAYMENT </label>
  <div class="col-md-8">
    <select  style="font-weight:bold;font-size:16px;;max-width:300px;"  class="form-control form-select" name="pagibigcalamityPayment" id="pagibigcalamityPayment" novalidate>
        <option id="none" value="" <?php if(empty($pagibigcalamityPayment)){ ?>selected<?php } ?> >Select Payment Method</option>
        <option id="cutoff" value="2" <?php if($pagibigcalamityPayment == '2'){ ?>selected<?php } ?>>Per Cut Off</option>
        <option id="month" value="1" <?php if($pagibigcalamityPayment == '1'){ ?>selected<?php } ?>>Per Month</option>
        <option id="" value="3" <?php if($pagibigcalamityPayment == '3'){ ?>selected<?php } ?>>Deffered</option>
      </select>
  </div>
</div>
<div class="  pagibigcalamityRadio form-group row mb-3">
  <label for="slyear" class="col-md-4 col-form-label text-md-right"></label>
  <div class="col-md-8 ">
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "pagibigcalamityRadio" for="Firstcutoff" >First Cut Off</label>
    <input  style="cursor: default; background-color: #F5F5F5; border: none; font-weight: bold;" type="radio" class="pagibigcalamityRadio" name ="pagibigcalamityCutoffSelect" value = "Firstcutoff" id="" <?php if($pagibigcalamityCutoffSelect == 'Firstcutoff'){ ?>checked<?php } ?>>
    <label  style ="white-space:nowrap;font-size:16px;font-weight:bold;" class = "pagibigcalamityRadio" for="Firstcutoff">Last Cut Off</label>
    <input  style="font-weight:bold" type="radio" class="pagibigcalamityRadio" name ="pagibigcalamityCutoffSelect" value = "Lastcutoff" id="" <?php if($pagibigcalamityCutoffSelect == 'Lastcutoff'){ ?>checked<?php } ?>> 
  </div>
</div>
<div class="form-group pagibigcalamity1 align-items-center row mb-3">
  <label for="pagibigcalamity" class="col-md-4 col-form-label text-md-right">MONTHLY AMORTIZATION</label>
  <div class="col-md-8">
    <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($pagibigcalamity) ? $pagibigcalamity : ''; ?>"  class="form-control" name="pagibigcalamity" id="pagibigcalamity" type="number">
  </div>
</div>
<div style="display:none;" class="pagibigcalamity2 form-group align-items-center row mb-3">
  <label for="pagibigcalamity" class="col-md-4 col-form-label text-md-right">FIRST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
    <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($pagibigcalamityFirst) ? $pagibigcalamityFirst : ''; ?>"  class="form-control" name="pagibigcalamityfirst" id="pagibigcalamityfirst" type="number">
  </div>
</div>
<div style="display:none;" class="pagibigcalamity2 form-group align-items-center row mb-3">
  <label for="pagibigcalamity" class="col-md-4 col-form-label text-md-right">LAST CUT OFF AMORTIZATION</label>
  <div class="col-md-8">
    <input  style="font-weight:bold;max-width:300px;"  value="<?php echo isset($pagibigcalamityLast) ? $pagibigcalamityLast : ''; ?>"  class="form-control" name="pagibigcalamitylast" id="pagibigcalamitylast" type="number">
  </div>
</div>
<div  class="form-group pagibigcalamity row mb-3">
  <label for="pagibigcalamityDate" class="col-md-4 col-form-label text-md-right">LOAN START DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo isset($pagibigcalamityDate) ? $pagibigcalamityDate : ''; ?>" class="pagibigcalamity form-control" name="pagibigcalamityDate" id="pagibigcalamityDate" type="date">
  </div>
</div>
<div  class="form-group pagibigcalamity row mb-3">
  <label for="pagibigcalamityDuedate" class="col-md-4 col-form-label text-md-right">LOAND END DATE</label>
  <div class="col-md-8">
    <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo isset($pagibigcalamityDuedate) ? $pagibigcalamityDuedate : ''; ?>"  class="pagibigcalamity form-control" name="pagibigcalamityDuedate" id="pagibigcalamityDuedate" type="date">
  </div>
</div>
</div>
<div class="border mb-2 border-dark p-2">
    <div class="form-group row mb-3">
        <label class="col-md-12 col-form-label text-md-center"><strong>SALARY LOAN</strong></label>
    </div>

    <div class="form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right">LOAN AMOUNT</label>
        <div class="col-md-8">
            <input style="font-weight:bold;max-width:300px;" value="<?php echo $salaryloan; ?>" class="form-control" name="salaryloan" id="salaryloan" type="number" step="0.01">
        </div>
    </div>

    <div class="sl form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right">BANK</label>
        <div class="col-md-8">
            <select id="slBank" name="slBank" class="form-control" required>
                <option value="">-- Select Bank --</option>
                <option value="BADA" <?= $slBank == 'BADA' ? 'selected' : '' ?>>BADA</option>
            </select> 
        </div>
    </div>

    <div class="sl form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right">YR/S TO PAY</label>
        <div class="col-md-8">
          <!-- Option 1: Dropdown -->
            <select id="slyear" name="slyear" class="form-control" required>
                <option value="">-- Select Loan Term --</option>
                <option value="1"   <?= $slYear == '1'   ? 'selected' : '' ?>>1 Year (12 Months)</option>
                <option value="1.5" <?= $slYear == '1.5' ? 'selected' : '' ?>>1.5 Years (18 Months)</option>
                <option value="2"   <?= $slYear == '2'   ? 'selected' : '' ?>>2 Years (24 Months)</option>
            </select>
            <!-- <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo $slYear; ?>" class="sl form-control" name="slyear" id="slyear" type="number"> -->
        </div>
    </div>

    <div class="sl form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right">PAYMENT</label>
        <div class="col-md-8">
            <select style="font-weight:bold;font-size:16px;;max-width:300px;" class="sl form-control form-select" name="slPayment" id="slPayment">
                <option value="">Select Payment Method</option>
                <option value="2" <?php if($slPayment == '2') echo 'selected'; ?>>Per Cut Off</option>
                <option value="1" <?php if($slPayment == '1') echo 'selected'; ?>>Per Month</option>
            </select>
        </div>
    </div>

    <div class="sl radio-btn form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right"></label>
        <div class="col-md-8 radio-btn">
            <label style="font-weight:bold;">First Cut Off</label>
            <input type="radio" name="slcutoffSelect" value="Firstcutoff" <?php if($slCutoffSelect == 'Firstcutoff') echo 'checked'; ?>>
            <label style="font-weight:bold;">Last Cut Off</label>
            <input type="radio" name="slcutoffSelect" value="Lastcutoff" <?php if($slCutoffSelect == 'Lastcutoff') echo 'checked'; ?>>
        </div>
    </div>

    <div class="sl1 form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right">LOAN START DATE</label>
        <div class="col-md-8">
            <input style="font-weight:bold;font-size:16px;;max-width:300px;" value="<?php echo $slDate; ?>" class="sl form-control" name="slDate" id="slDate" type="date">
        </div>
    </div>
    
    <div class="sl1 form-group row mb-3">
        <label class="col-md-4 col-form-label text-md-right">LOAN END DATE</label>
        <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;" value="<?php echo $slDuedate; ?>" class="sl form-control" name="slDuedate" id="slDuedate" type="date">
        </div>
    </div>

    <div class="sl1 salary1 form-group align-items-center row mb-3">
        <label class="col-md-4 col-form-label text-md-right">MONTHLY AMORTIZATION</label>
        <div class="col-md-8">
            <input value="<?php echo $slAmortization; ?>" class="sl form-control" name="slAmortization" id="slAmortization" type="number">
        </div>
    </div>
    <div class="sl1 salary2 form-group align-items-center row mb-3">
        <label class="col-md-4 col-form-label text-md-right">FIRST CUT OFF AMORTIZATION</label>
        <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;" value="<?php echo $slAmortizationFirst; ?>" class="sl form-control" name="slAmortizationfirst" id="slAmortizationfirst" type="number">
        </div>
    </div>
    <div class="sl1 salary2 form-group align-items-center row mb-3">
        <label class="col-md-4 col-form-label text-md-right">LAST CUT OFF AMORTIZATION</label>
        <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;" value="<?php echo $slAmortizationLast; ?>" class="sl form-control" name="slAmortizationlast" id="slAmortizationlast" type="number">
        </div>
    </div>
    <div class="sl1 form-group align-items-center row mb-3">
        <label class="col-md-4 col-form-label text-md-right">PRINCIPAL</label>
        <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;" class="sl form-control" name="principal" id="principal" type="number" value="0.00">
        </div>
    </div>
    <div class="sl1 form-group align-items-center row mb-3">
        <label class="col-md-4 col-form-label text-md-right">INTEREST</label>
        <div class="col-md-8">
            <input readonly style="background-color: #F5F5F5;" class="sl form-control" name="interest" id="interest" type="number" value="0.00">
        </div>
    </div>
    <div class="sl1 form-group row mb-3 align-items-center">
        <label for="slBalance" class="col-md-4 col-form-label text-md-right text-uppercase">BALANCE</label>
        <div class="col-md-8">
            <input readonly style="background-color: white; border: 1px solid #0d6efd; font-weight:bold; font-size:16px; max-width:300px;" 
                   value="<?php echo $slBalance; ?>" 
                   class="sl form-control" name="slBalance" id="slBalance" type="number" step="0.01">
        </div>
    </div>

     <!-- <div class="form-row hidden" id="row-balance">
            <label class="form-label">BALANCE</label> -->
            <!-- <div class="form-input">
                <input type="number" id="slBalance" readonly step="0.01">
            </div>
        </div> -->

    <div class="sl1 form-group row mb-3">
        <div class="col-md-4"></div>
        <div class="col-md-8" style="max-width: 330px;">
            <label class="mb-1" style="font-weight: 600; font-size: 14px; color: #333;">Loan Progress</label>
            
            <div class="progress-bar-container">
                <div id="loanProgressBar" class="progress-bar-fill">0%</div>
            </div>
            
            <div id="progressText" class="progress-text">0 of 0 payments made</div>
        </div>
    </div>

    <div class="sl1 form-group align-items-center row mb-3 mt-4">
        <div class="col-12 text-center">
            <button id="fullyPaid" type="button" class="btn-fully-paid">FULLY PAID</button>
            <input id="inputPaid" value="0" name="inputPaid" type="hidden">
        </div>
    </div>
    

</div>
</div>
</div>
</div>
</div>
</div>
<div class="content" id="reportcontent">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a style="cursor:pointer;" id="Lates" class="reportTab nav-link active">Lates</a>
    </li>
    <li class="nav-item">
      <a style="cursor:pointer;" id="OB" class="reportTab nav-link">Official Business</a>
    </li>
    <li class="nav-item">
      <a style="cursor:pointer;" id="SL" class="reportTab nav-link">Sick Leave</a>
    </li>
    <li class="nav-item">
      <a style="cursor:pointer;" id="VL" class="reportTab nav-link">Vacation Leave</a>
    </li>
    <li class="nav-item">
      <a style="cursor:pointer;" id="ML" class="reportTab nav-link">Mandatory Leave</a>
    </li>
    <li class="nav-item">
      <a style="cursor:pointer;" id="UL" class="reportTab nav-link">Unpaid Leave</a>
    </li>
  </ul>
  <div class="m-2 col-sm-2">
      <select name="selectDate" id="selectDate" class="form-select text-center" aria-describedby="button-addon2">
          <option value="" selected disabled>-- Select Date --</option>
          <?php foreach ($options as $option): ?>
              <option value="<?php echo $option['selectedDate']; ?>"><?php echo $option['date']; ?></option>
          <?php endforeach; ?>
      </select>
  </div>
  <div id="tableReport"></div>
  <span id="status"></span>
</div>
<div class="content" id="payother">
  <div class="d-flex py-2 justify-content-end align-items-end">
  <div class="d-flex gap-2 me-auto justify-content-left align-items-left">
      <!-- <span><strong>TOTAL :</strong></span><span id="totalOtherpay">0.00</span> -->
  </div>
  <a <?php if($_SESSION['department'] !== '1' || $_SESSION['department'] !== '2'|| $_SESSION['department'] !== '5'){ ?> onclick="addRow()" <?php } ?> class="btn addPay btn-outline-secondary"><i class='fa-lg fa-solid fa-plus'></i></a>
  </div>
  <div id="paycontainer" class="d-flex align-items-center justify-content-center">
    <table id="otherpaytable" class="table table-bordered">
      <thead class="text-center">
        <th>DATE</th>
        <th>AMOUNT</th>
        <th>REMARKS</th>
        <th>ACTION</th>
      </thead>
      <tbody>
        <?php 
         $id = $_GET['id'];

         $id = mysqli_real_escape_string($con, $id);
     
         $sql="SELECT * FROM pay_otherpayment WHERE employeeId = $id AND datedeleted = ''";
         $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          $idPay = $row['id'];
          $datePay = $row['date'];
          $amountPay = $row['amount'];
          $remarksPay = $row['remarks'];
           ?>
        <tr data-id="<?php echo $idPay ?>">
        <td contenteditable='true' name="datePay"  class="Paycell text-center" data-name="date"><?php echo $datePay; ?></td>
        <td  contenteditable='true' name="amountPay"  class="Paycell payamount text-center" data-name="amount"><?php echo $amountPay; ?></td>
        <td  contenteditable='true' name="remarksPay"  class="Paycell text-center" data-name="remarks"><?php echo $remarksPay; ?></td>
        <td class="text-center"></a>
          <a data-id="<?= $idPay ?>" id="deletePay" class=" btn btn-danger">
         DELETE
        </a>
        </td>
        </tr>
      <?php }
            } else { ?>
      <td colspan="4">No Record</td>
      <?php     } ?>
      <tbody>
    <table>
  </div>
</div>


<script>

<?php if($_SESSION['department'] !== '1' && $_SESSION['department'] !== '2'){ ?>
  $('#forhr input:not(#uploadPic)').attr('readonly', 'readonly');
  $('#employeecontent input:not(#uploadPic)').attr('readonly', 'readonly');
<?php }else{ ?>
  $('#foraccounting input:not(#uploadPic)').attr('readonly', 'readonly');
  $('#foraccounting select').on('mousedown', false).on('focus', false).attr('readonly', 'readonly'); 
  $('input[name="slcutoffSelect"]').attr('onclick', 'return false');
<?php } ?>




// ✅ FIXED addRow2() function - Add this to your pay-updateempinfo.php file
// Replace the existing addRow2() function with this corrected version

function addRow2() {
    var table = document.getElementById("deducttable");
    var today = new Date().toISOString().split('T')[0];
    var newRow = table.insertRow(1);
    
    newRow.setAttribute("class", "text-center addedDeduct");
    
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);
    
    cell1.contentEditable = true;
    cell2.contentEditable = true;
    cell3.contentEditable = true;
    
    cell1.setAttribute("data-name", "date");
    cell2.setAttribute("data-name", "amount");
    cell3.setAttribute("data-name", "remarks");
    cell1.setAttribute("class", "Deductcell");
    cell2.setAttribute("class", "Deductcell deductamount");
    cell3.setAttribute("class", "Deductcell");
    
    cell1.innerHTML = today;
    cell2.innerHTML = "0.00";
    cell3.innerHTML = "Input Remarks";
    cell4.innerHTML = '<a id="deleteDeduct" class="btn btn-danger" data-id="">DELETE</a>';
    
    // ✅ FIX 1: Try multiple possible ID fields from the page
    var empid = $('#employeeId').val() || $('#idinfo').val() || '';
    
    // ✅ FIX 2: Get employee name from the correct field
    var name = $('#empName').val() || $('input[name="empName"]').val() || '';
    
    // ✅ FIX 3: Get branch from correct field
    var branch = $('#empBranch').val() || $('#empAddr').val() || $('input[name="empBranch"]').val() || '';
    
    // ✅ FIX 4: Get position from correct field
    var position = $('#empPosition').val() || $('input[name="empPosition"]').val() || $('#bankPosition').val() || '';
    
    // ✅ FIX 5: Debug - log what we're sending
    console.log('📤 Sending deduction data:', {
        empid: empid,
        name: name,
        position: position,
        branch: branch
    });
    
    // ✅ FIX 6: Validate required fields before AJAX
    if (!empid || empid === '' || empid === 'undefined') {
        console.error('❌ Employee ID is missing!');
        alert('Error: Employee ID not found. Cannot add deduction.');
        newRow.remove();
        return;
    }
    
    if (!name || name === '') {
        console.error('❌ Employee name is missing!');
        alert('Error: Employee name not found. Cannot add deduction.');
        newRow.remove();
        return;
    }
    
    // Send AJAX request to add new deduction
    $.ajax({
        url: 'pay-addotherdeduct.php',
        method: 'POST',
        data: {
            empid: empid,
            name: name,
            position: position,
            branch: branch,
            field: ['date', 'amount', 'remarks'],
            value: [today, '0.00', 'Input Remarks']
        },
        success: function(response) {
            console.log('📥 Raw response:', response);
            
            // Clean and validate response
            var id = parseInt(response.trim());
            
            if(id > 0) {
                console.log('✅ New deduction added with ID:', id);
                newRow.setAttribute("data-id", id);
                newRow.querySelector('#deleteDeduct').setAttribute("data-id", id);
                updateDeductAmount(); // Recalculate total
            } else {
                console.error('❌ Failed to add deduction, invalid ID:', response);
                alert('Failed to add deduction record. Server returned: ' + response);
                newRow.remove();
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ Error adding deduction:', error);
            console.error('Status:', status);
            console.error('Response Text:', xhr.responseText);
            console.error('Response Status:', xhr.status);
            alert('Failed to add deduction record: ' + error);
            newRow.remove();
        }
    });
}

// ✅ Make sure these event handlers are present in your code
$(document).ready(function() {
    console.log('✅ Other Deduction handlers initialized');
    updateDeductAmount();
    
    // Test if handlers are working
    console.log('📊 Deductcell elements found:', $('.Deductcell').length);
    console.log('🗑️ Delete buttons found:', $('#deleteDeduct').length);
});



function addRow() {
    var table = document.getElementById("otherpaytable");
    var today = new Date().toISOString().split('T')[0];
    var newRow = table.insertRow(1);
    
    newRow.setAttribute("class", "text-center addedPay");
    
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);
    
    cell1.contentEditable = true;
    cell2.contentEditable = true;
    cell3.contentEditable = true;
    
    cell1.setAttribute("data-name", "date");
    cell2.setAttribute("data-name", "amount");
    cell3.setAttribute("data-name", "remarks");
    cell1.setAttribute("class", "Paycell");
    cell2.setAttribute("class", "Paycell payamount");
    cell3.setAttribute("class", "Paycell");
    
    cell1.innerHTML = today;
    cell2.innerHTML = "0.00";
    cell3.innerHTML = "Input Remarks";
    cell4.innerHTML = '<a id="deletePay" class="btn btn-danger" data-id="">DELETE</a>';
    
    var empid = $('#employeeId').val();
    var name = $('#empName').val();
    var branch = $('#empAddr').val();
    var position = $('#empPosition').val();
    
    $.ajax({
        url: 'pay-addotherpay.php',
        method: 'POST',
        data: {
            empid: empid,
            name: name,
            position: position,
            branch: branch,
            field: ['date', 'amount', 'remarks'],
            value: [today, '0.00', 'Input Remarks']
        },
        success: function(response) {
            // Clean and validate response
            var id = parseInt(response.trim());
            
            if(id > 0) {
                console.log('✅ New payment added with ID:', id);
                newRow.setAttribute("data-id", id);
                newRow.querySelector('#deletePay').setAttribute("data-id", id);
                updatePayAmount();
            } else {
                console.error('❌ Failed to add payment, invalid ID:', response);
                alert('Failed to add payment record');
                newRow.remove();
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ Error adding payment:', error);
            console.error('Response:', xhr.responseText);
            alert('Failed to add payment record');
            newRow.remove();
        }
    });
}

// UPLOAD PICTURE JS
// UPLOAD PICTURE JS
$(document).ready(function() {
    $('#img').on('click', function() {
        $('#uploadPic').trigger('click');
    });

    $('#uploadPic').on('change', function() {
        if (this.files && this.files[0]) {
            var formData = new FormData();
            formData.append('uploadedFile', this.files[0]);
            formData.append('empId', '<?= $empId ?>');

            $.ajax({
                url: 'pay-updateEmployeePhoto.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var newSrc = 'photo/' + response.split('photo/')[1];
                    $('#img').attr('src', newSrc + '?t=' + new Date().getTime());
                    alert('Photo updated successfully!');
                },
                error: function() {
                    alert('Failed to upload photo.');
                }
            });
        }
    });
});



</script>

<script>
  var reportOptions = <?php echo json_encode($options); ?>; // REPORT PAGE
  var reportEmpId   = '<?php echo $empId; ?>';
</script>
<script src="js/pay-report.js"></script>

<script src="js/payearningupdate.js" crossorigin="anonymous"></script>

<script>

  

var navLinks = document.querySelectorAll('.topnav a');

// Add click event listener to each link
navLinks.forEach(function(link) {
  link.addEventListener('click', function(e) {
    // Prevent default link behavior
    e.preventDefault();
    
    // Remove 'active' class from all links
    navLinks.forEach(function(navLink) {
      navLink.classList.remove('active');
    });
    
    // Add 'active' class to the clicked link
    link.classList.add('active');
    
    // Hide all content divs
    var contents = document.querySelectorAll('.content');
    contents.forEach(function(content) {
      content.style.display = 'none';
    });
    
    // Show the content corresponding to the clicked link
    var targetId = link.getAttribute('href').substring(1);
    document.getElementById(targetId).style.display = 'block';
  });
});


function formatDate(dateString) {
    // Convert the original date string to a JavaScript Date object
    var originalDate = new Date(dateString);
    
    // Get the month in the long format (e.g., "January", "February", etc.)
    var month = originalDate.toLocaleString('default', { month: 'long' });
    
    // Get the day of the month
    var day = originalDate.getDate();
    
    // Get the year
    var year = originalDate.getFullYear();
    
    // Concatenate the parts to form the new date format
    var newDateFormat = month + " " + day + ", " + year;
    
    // Return the new date format
    return newDateFormat;
}


</script>


<script>

  // Function to refresh modal content
function refreshModalContent(employeeId) {
    console.log('Refreshing modal for employee:', employeeId);
    
    // Show loading state
    $('#employeecontent, #earningscontent, #payother, #deductcontent, #reportcontent').html(
        '<div class="text-center p-5"><i class="fas fa-spinner fa-spin fa-3x"></i><br>Loading...</div>'
    );
    
    // Reload the modal content via AJAX
    $.ajax({
        url: 'pay-updateempinfo.php',
        method: 'GET',
        data: { id: employeeId },
        success: function(response) {
            // Find the modal body and replace its content
            var $modalBody = $('.modal-body');
            
            if($modalBody.length) {
                // If inside a modal, update modal body
                $modalBody.html(response);
            } else {
                // If in a page, reload the page
                location.reload();
            }
            
            console.log('✅ Modal content refreshed');
            
            // Re-initialize any plugins if needed
            initializeFormElements();
        },
        error: function(xhr, status, error) {
            console.error('❌ Failed to refresh modal:', error);
            alert('Failed to refresh data. Please close and reopen.');
        }
    });
}



</script>

<script>
var allIds = [ "regularCheck", "probiCheck" ];
function uncheck( event ) 
{
   var id = event.target.id;
   allIds.forEach( function( id ){
      if ( id != event.target.id )
      {
         document.getElementById( id ).checked = false;
      }
   });
}
jQuery("#regularCheck").click(uncheck);
jQuery("#probiCheck").click(uncheck);

var allIds2 = [ "flexCheck", "nonflexCheck" ];
function uncheck( event ) 
{
   var id = event.target.id;
   allIds2.forEach( function( id ){
      if ( id != event.target.id )
      {
         document.getElementById( id ).checked = false;
      }
   });
}
jQuery("#flexCheck").click(uncheck);
jQuery("#nonflexCheck").click(uncheck);

</script>

<script>


var inputChanged = false;

$('#myform input').change(function(){
  inputChanged = true;
});

$('#myform2 input').change(function(){
  inputChanged = true;
});


// ========================================
// Replace the existing #btnsave click handler
// ========================================
$(document).off('click', '#btnsave');

$(document).on('click', '#btnsave', function(event){
    event.preventDefault();
    
    console.log('Save button clicked');

    if(!confirm('Are you sure you want to save these records?')){
        return false;
    }

    $(this).prop('disabled', true).text('Saving...');
    var $btn = $(this);

    var employeeData = {
        idinfo: $('#idinfo').val(),
        empStatus: $("input[name='empStatus']:checked").val(),
        empSched: $("input[name='empSched']:checked").val(),
        empCivil: $('#empCivil').val(),
        remarksSched: $('#remarksSched').val(),
        empPosition: $('#empPosition').val(),
        contactPerson: $('#contactPerson').val(),
        emergencyNum: $('#emergencyNum').val(),
        empBday: $('#empBday').val(),
        empHired: $('#empHired').val(),
        sssinfo: $('#sssinfo').val(),
        tininfo: $('#tininfo').val(),
        pagibiginfo: $('#pagibiginfo').val(),
        philhealthinfo: $('#philhealthinfo').val(),
        empAddr: $('#empAddr').val()
    };

    $.ajax({
        url: 'pay-updateemployee.php',
        method: 'POST',
        data: employeeData,
        success: function(empResponse) {
            console.log('✅ Employee saved:', empResponse);
            
            var formData;
            var postUrl;

            <?php if($_SESSION['department'] !== '1' && $_SESSION['department'] !== '2'){ ?>
                formData = $('#myform2').serialize();
                postUrl = 'pay-updateearningLoan.php';
            <?php } else { ?>
                formData = $('#myform').serialize();
                postUrl = 'pay-updateearningsHR.php';
            <?php } ?>

            $.ajax({
                type: 'POST',
                url: postUrl,
                data: formData,
                dataType: 'json',
                success: function(result){
                    console.log('✅ Loan/HR saved:', result);
                    $btn.prop('disabled', false).text('SAVE');
                    
                    if(result.success) {
                        alert(result.message || 'All records saved successfully!');
                    } else {
                        alert('Records saved. Please verify your data.');
                    }

                    // Reload the parent page — this closes the modal automatically
                    window.location.reload();
                },
                error: function(xhr, status, error){
                    console.error('❌ Loan save failed:', error);
                    console.error('Response Text:', xhr.responseText);
                    $btn.prop('disabled', false).text('SAVE');
                    alert('Records saved. Please verify your data.');

                    // Data is already in DB — reload parent page anyway
                    window.location.reload();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('❌ Employee save failed:', error);
            $btn.prop('disabled', false).text('SAVE');
            alert('Error saving employee data: ' + error);
            // No reload here — first save failed, keep modal open so user can retry
        }
    });
});



function updatePayAmount() {
var payAmount = 0;

// Iterate over each element with the class 'payamount'
$('.payamount').each(function() {
    // Get the text content of the element and parse it as a float
    var amount = parseFloat($(this).text());
    
    // Check if the parsed value is a valid number before adding
    if (!isNaN(amount)) {
        payAmount += amount;
    }
});

// Set the total sum to the element with ID 'totalOtherpay'
$('#totalOtherpay').text(addCommasToNumber(payAmount.toFixed(2))); // toFixed(2) ensures it has two decimal places
}


function updateDeductAmount() {
var deductAmount = 0;
// Iterate over each element with the class 'payamount'
$('.deductamount').each(function() {
    // Get the text content of the element and parse it as a float
    var amountdeduct = parseFloat($(this).text());
    
    // Check if the parsed value is a valid number before adding
    if (!isNaN(amountdeduct)) {
      deductAmount += amountdeduct;
    }
});

// Set the total sum to the element with ID 'totalOtherpay'
$('#totalOtherdeduct').text(addCommasToNumber(deductAmount.toFixed(2))); // toFixed(2) ensures it has two decimal places
}

// ========================================
// OTHER DEDUCTION - INLINE EDIT HANDLER
// ✅ UPDATED TO USE JSON RESPONSE
// ========================================
$(document).on('blur', '.Deductcell', function() {
    var $cell = $(this);
    var newValue = $cell.text().trim();
    var field = $cell.data('name');
    var $row = $cell.closest('tr');
    var id = $row.data('id');
    
    console.log('📝 Deductcell blur - ID:', id, 'Field:', field, 'Value:', newValue);
    
    // ✅ Validate ID
    if (!id || id === '' || id === 'undefined') {
        console.error('❌ No ID found');
        alert('Error: Cannot update record without ID');
        return;
    }
    
    // ✅ Validate amount
    if (field === 'amount') {
        var amount = parseFloat(newValue);
        if (isNaN(amount) || amount < 0) {
            alert('Please enter a valid positive number');
            $cell.text('0.00');
            return;
        }
        newValue = amount.toFixed(2);
        $cell.text(newValue);
    }
    
    // ✅ Validate date
    if (field === 'date') {
        if (!/^\d{4}-\d{2}-\d{2}$/.test(newValue)) {
            alert('Please use date format: YYYY-MM-DD');
            $cell.focus();
            return;
        }
    }
    
    // Show saving indicator
    var originalBg = $cell.css('background-color');
    $cell.css('background-color', '#fff3cd');
    
    $.ajax({
        url: 'pay-updatededuct.php',
        method: 'POST',
        dataType: 'json', // ✅ CRITICAL: Expect JSON
        data: {
            id: id,
            field: field,
            value: newValue
        },
        success: function(response) {
            console.log('📥 Server response:', response);
            
            if (response.success) {
                // Success - green flash
                $cell.css('background-color', '#d4edda');
                setTimeout(function() {
                    $cell.css('background-color', originalBg);
                }, 600);
                
                updateDeductAmount(); // Recalculate total
                console.log('✅ Updated successfully');
            } else {
                // Error - red flash
                $cell.css('background-color', '#f8d7da');
                alert('Failed: ' + (response.error || 'Unknown error'));
                console.error('❌ Update failed:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ AJAX Error:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
            
            $cell.css('background-color', '#f8d7da');
            alert('Failed to update: ' + error);
            
            setTimeout(function() {
                $cell.css('background-color', originalBg);
            }, 1000);
        }
    });
});


// ========================================
// OTHER PAYMENT - INLINE EDIT HANDLER
// ========================================
$(document).on('blur', '.Paycell', function() {
    var $cell = $(this);
    var newValue = $cell.text().trim();
    var field = $cell.data('name');
    var $row = $cell.closest('tr');
    var id = $row.data('id');
    
    console.log('📝 Paycell blur triggered:', {
        id: id,
        field: field,
        value: newValue
    });
    
    // Validate ID exists
    if (!id || id === '' || id === 'undefined') {
        console.error('❌ No ID found for payment row');
        alert('Error: Cannot update record without ID. Please refresh the page.');
        return;
    }
    
    // Validate amount field
    if (field === 'amount') {
        var amount = parseFloat(newValue);
        if (isNaN(amount) || amount < 0) {
            alert('Please enter a valid positive number for amount');
            $cell.text('0.00');
            $cell.focus();
            return;
        }
        newValue = amount.toFixed(2);
        $cell.text(newValue);
    }
    
    // Validate date field
    if (field === 'date') {
        var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(newValue)) {
            alert('Please use date format: YYYY-MM-DD (e.g., 2026-01-12)');
            $cell.focus();
            return;
        }
    }
    
    console.log('💾 Sending update to pay-updateotherpay.php...');
    console.log('📤 Data:', { id: id, field: field, value: newValue });
    
    // Show saving indicator
    var originalBg = $cell.css('background-color');
    $cell.css('background-color', '#fff3cd');
    
    $.ajax({
        url: 'pay-updateotherpay.php',
        method: 'POST',
        data: {
            id: id,
            field: field,
            value: newValue
        },
        dataType: 'json',
        success: function(response) {
            console.log('📥 Response from pay-updateotherpay.php:', response);
            
            if (response.success) {
                // Success indicator
                $cell.css('background-color', '#d4edda');
                setTimeout(function() {
                    $cell.css('background-color', originalBg);
                }, 600);
                
                // Update totals
                updatePayAmount();
                
                console.log('✅ Payment updated successfully');
            } else {
                console.error('❌ Update failed:', response);
                $cell.css('background-color', '#f8d7da');
                alert('Failed to update: ' + (response.error || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ AJAX Error:', error);
            console.error('Status:', status);
            console.error('Response Text:', xhr.responseText);
            
            // Error indicator
            $cell.css('background-color', '#f8d7da');
            alert('Failed to update payment: ' + error);
            
            setTimeout(function() {
                $cell.css('background-color', originalBg);
            }, 1000);
        }
    });
});

// ========================================
// INITIALIZE ON PAGE LOAD
// ========================================
$(document).ready(function() {
    console.log('✅ Other Payment handlers initialized');
    updatePayAmount();
    
    // Test if handlers are working
    console.log('📊 Paycell elements found:', $('.Paycell').length);
});



</script>

<script>


// $(document).ready(function() {
//     console.log('Setting up report tab listeners...');
    
//     // Use jQuery event delegation for dynamically loaded content
//     $(document).off('click', '.reportTab').on('click', '.reportTab', function(e) {
//         e.preventDefault();
//         console.log('Report tab clicked:', $(this).text().trim());
        
//         // Remove 'active' class from all tabs
//         $('.reportTab').removeClass('active');
        
//         // Add 'active' class to clicked tab
//         $(this).addClass('active');
        
//         // Update content
//         getActiveTab();
//         updateTable();
//     });
    
//     // Date selector change handler
//     $('#selectDate').off('change').on('change', function(){
//         console.log('Date selected:', $(this).val());
//         updateTable();
//     });
    
//     // Initial setup
//     getActiveTab();
// });


// function updateTable(){
//   var selectElement = document.getElementById('selectDate');

//   // Get the selected option's text
//   var selectedText = selectElement.options[selectElement.selectedIndex].text;

//   // Get the value of the selected date
//   var date = $('#selectDate').val();var navLinksReport = document.querySelectorAll('.reportTab');
//   var options = <?php echo json_encode($options); ?>;
//   var selectedOption = options.find(option => option.selectedDate === date);

//   $.ajax({
//     url: 'pay-viewempReport.php',
//     type: 'POST',
//     data: {
//         date : selectedOption.date,
//         startdate : selectedOption.startdate,
//         enddate : selectedOption.enddate,
//         activeTab : activeTab,
//         empId : empId
//     },
//     success: function(response) {
//       $('#tableReport').html(response);
//     },
//     error: function(xhr, status, error) {
//         console.error('Error: ' + error);
//     }
//     });
// }

$('#fullyPaid').click(function(e) {
  var inputPaid = $('#inputPaid').val(); // Retrieve value inside the click event
  
  if(inputPaid == 0) {
    confirmation = confirm('Are you sure you want to fully paid this record?');
    if(confirmation){
      $('#inputPaid').val('1');
      console.log('clicked');
      console.log($('#inputPaid').val());
      $(this).css('background-color', 'green');
      $(this).css('border-color', 'green');
      $('#salaryloan').attr('disabled', true);
      $('.sl').attr('disabled', true);
      $('.sl1').attr('disabled', true);
    }else{
      e.preventDefault();
    }
  } else {
    $('#inputPaid').val('0');
    console.log('clicked');
    console.log($('#inputPaid').val());
    $(this).css('background-color', '');
    $(this).css('border-color', '');
    $('#salaryloan').prop('readonly', true);  // ✅ CORRECT
    $('.sl').prop('readonly', true);          // ✅ CORRECT
    $('.sl1').attr('disabled', false);
  }
});




</script>