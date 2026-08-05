<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
table, th, td {
  border:1px solid black;
  margin-left: auto;
  margin-right: auto;
  font-size: 11.5px;
}
th:nth-child(odd) {
     background-color: yellow;
}

th:nth-child(even) {
     background-color: yellow;
}
.hiLi{
  background-color: #FFA07A!important;
  /* color: green; */
}
.hide{
  visibility: hidden;
}

#noRecord {
  position: relative; 
  font-size: 150%; 
  margin-left: auto; 
  margin-right: auto; 
  top: 300px;
}
embed{
  margin: 0!important;
  width: 100%;
  height: 1200px;
}
#displayhere {
  margin: 0;
}
</style>



</head>

<body>

</style>

<table style="width: 100%; position:relative; top: 50px;" class="table" id="tablelist" >
<tr>
  <th width="300px">Document ID</th>
  <th width="250px">Policy/Manual Title</th>
  <th width="100px">Document Type</th>
  <th width="70px">Category</th>
  <th width="500px">Description</th>
  <th>Version</th>
  <th width="200px">Date Approved</th>
  <th width="200px">Board Approved Date</th>
  <th width="200px">Effective Date</th>
  <th width="200px">Revised Date</th>
  <th width="200px">Review Date</th>
  <th width="190px">Owner</th>
  <th width="200px">Person Responsible</th>
  <th width="90px">Location</th>
  <th width="420px">File Name</th>
  <th width="190px">Notes</th>
  <th width="190px">Keywords</th>
  <th width="190px">Remarks</th>
  <th>Action</th>
</tr>

<?php
include('connection.php');

if (isset($_POST['instCode'])) {


  $search1 = $_POST['instCode'];
  $searchTerms = explode(' ', $search1);
  $searchTermBits = array();
  foreach ($searchTerms as $term) {
      $term = trim($term);
      if (!empty($term)) {
          $searchTermBits[] = " policyName LIKE '%$term%'
                                OR policyPR LIKE '%$term%' 
                                OR policyLocation LIKE '%$term%'   
                                OR policySearchable LIKE '%" . $search1 . "%' ";
    }
  }
	if(!empty($search1)){
		$r_sql = "SELECT * FROM `policy` WHERE ".implode(' AND ', $searchTermBits)." ";
		$r_query = mysqli_query($con, $r_sql);
		if(mysqli_num_rows($r_query) > 0) {
			while($row = mysqli_fetch_assoc($r_query)) {
        ?>
        <tr>    
          <td><?php echo $row['docsId']; ?></td>
          <td><?php echo $row['policyName']; ?></td>
          <td><?php echo $row['docsType']; ?></td>
          <td><?php echo $row['policyCat']; ?></td>
          <td><?php echo $row['policyDesc']; ?></td>
          <td><?php echo $row['policyVers']; ?></td>
          <td><?php echo $row['policyDateApproved']; ?></td>
          <td><?php echo $row['policyBoardApproved']; ?></td>
          <td><?php echo $row['policyEffectiveDate']; ?></td>
          <td><?php echo $row['policyRevisedDate']; ?></td>
          <td><?php echo $row['policyReviewDate']; ?></td>
          <td><?php echo $row['policyOwner']; ?></td>
          <td><?php echo $row['policyPR']; ?></td>
          <?php if($row['policyLocation'] = 'Intranet(Dashboard') {
            echo "<td><a href='#'>Intranet(Dashboard)</a></td>";
          }
          ?>
          <td><?php echo $row['policyFileName']; ?></td>
          <td><?php echo $row['policyNotes']; ?></td>
          <td><?php echo $row['policyKeyword']; ?></td>
          <td><?php echo $row['policyRemarks']; ?></td>
          <td><button class="btn btn-primary btn-sm result"  id= "<?= $row['id']; ?>" name="results" value="<?= $row['id']; ?>" type="button">OPEN</button></td>
        <?php
        }
        echo "</table>" ;   
			}else {
        echo '<span id="noRecord">No Records Found!</span>';
        // echo '<script>$("#tablelist").addClass("hide");</script>';
      }
	}else {
		echo '<script>alert("input something to search");</script>';
    // echo '<script>$("#tablelist").addClass("hide");</script>';
	}
}
?>

<div id="displayhere"></div>

<script>
  $(document).ready(function () {
  $('.result').click(function (e) {
    var loanIds = $(this).attr('id');
    var type = $(this).attr('value');
    document.getElementById('tablelist').style.display = 'none';
    if (type == 1) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/AntiMoneyLaundering.pdf" type="application/pdf" />');
    }
    if (type == 2) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/AuditProgramV3.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 3) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/CodeofConduct.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 4) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/ComplianceProgram.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 5) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/CSOM.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 6) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/CreditRiskManagement.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 7) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/CCC.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 8) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/DepositRecord.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    // if (type == 9) {
    //   loanTarget = $('#displayhere').html('<embed src="./pdf/EmpEmeLoan.pdf" type="application/pdf" width="100%" height="1000px" />');
    // }
    if (type == 10) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/EB.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 11) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/itPolicy.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 12) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/InternalAuditPolicy.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 13) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/InvestmentRiskManagement.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 14) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/LiquidityRiskManagement.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 15) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/RiskManagementPolicy.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 16) {
      loanTarget = $('#displayhere').html('<embed src="./pdf/SCPR.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 17){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ASMD.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 18){
      loanTarget = $('#displayhere').html('<embed src="./pdf/PCAB.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 19){
      loanTarget = $('#displayhere').html('<embed src="./pdf/SRM.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 20){
      loanTarget = $('#displayhere').html('<embed src="./pdf/penaltyDiscount.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 21){
      loanTarget = $('#displayhere').html('<embed src="./pdf/CPRMS.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 22){
      loanTarget = $('#displayhere').html('<embed src="./pdf/OP.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 23){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITHandbook.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 24){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-CMS.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 25){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-CCorner.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 26){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-Fserver.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 27){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-HRCorner.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 28){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManualInventory.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 29){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-ITCorner.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 30){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-LMS.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 31){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-ITPolicynProcedure.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 32){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-QSystem.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 33){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-SS.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 34){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ITManual-Treasury.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 35){
      loanTarget = $('#displayhere').html('<embed src="./pdf/officerEmployeePolicy.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 36){
      loanTarget = $('#displayhere').html('<embed src="./pdf/SocialMediaRiskMngmnt.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 37){
      loanTarget = $('#displayhere').html('<embed src="./pdf/bankGuarantee.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 38){
      loanTarget = $('#displayhere').html('<embed src="./pdf/CorporateGovernancePolicy.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 39){
      loanTarget = $('#displayhere').html('<embed src="./pdf/AuditCommitteeCharter.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 40){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ExecutiveCommitteCharter.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 41){
      loanTarget = $('#displayhere').html('<embed src="./pdf/ROPApolicy.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 42){
      loanTarget = $('#displayhere').html('<embed src="./pdf/SecurityManual.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 43){
      loanTarget = $('#displayhere').html('<embed src="./pdf/SuccessionPlanning.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 44){
      loanTarget = $('#displayhere').html('<embed src="./pdf/recoveryPlanv1.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    if (type == 45){
      loanTarget = $('#displayhere').html('<embed src="./pdf/manualOpsv2.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 46){
      loanTarget = $('#displayhere').html('<embed src="./pdf/RPT.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 47){
      loanTarget = $('#displayhere').html('<embed src="./pdf/BCP.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 48){
      loanTarget = $('#displayhere').html('<embed src="./pdf/accntngMan.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 49){
      loanTarget = $('#displayhere').html('<embed src="./pdf/BOF.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 50){
      loanTarget = $('#displayhere').html('<embed src="./pdf/DLC.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 51){
      loanTarget = $('#displayhere').html('<embed src="./pdf/DC.pdf" type="application/pdf" width="100%" height="1000px" />');
    }

    if (type == 52){
      loanTarget = $('#displayhere').html('<embed src="./pdf/CPIT.pdf" type="application/pdf" width="100%" height="1000px" />');
    }
    // $.ajax({
      //   type: 'POST',
      //   url: loanTarget,
      //   data: {
      //     loanId: loanIds
      //   },
      //   // async: false,
      //   // dataType: 'binary',
      //   contentType: "application/xml; charset=utf-8",
      //   success: function (previewPDF) {
      
      //     // $('#displayhere').html(result);
      //     // $('#displayhere').html('<embed src="pdfCCC.php" type="application/pdf" width="100%" height="1900px" />');
      //     $useLoanId = loanIds;
      //   }
      // });
  });
});
</script>

</body>
</html>