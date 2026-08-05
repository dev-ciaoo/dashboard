<?php
include('connection.php');

// adjust session key here if your login uses a different variable name
$username = strtolower(trim($_SESSION['username'] ?? ''));
$isAdmin = in_array($username, ['cdalegre', 'jcvillanueva', 'jatabat', 'caramos']);

$sql = $isAdmin
    ? "SELECT periodKey, label, effectiveDate, MAX(published) AS published FROM pay_bonus GROUP BY periodKey, label, effectiveDate ORDER BY periodKey DESC"
    : "SELECT periodKey, label, effectiveDate FROM pay_bonus WHERE published = '1' GROUP BY periodKey, label, effectiveDate ORDER BY periodKey DESC";
$result = $con->query($sql);
$periods = [];
while ($row = $result->fetch_assoc()) {
    $periods[] = $row;
}

$selectedPeriod = $_GET['period'] ?? ($periods[0]['periodKey'] ?? '');

$branchOrder = ['Head Office', 'Magallanes', 'Manggahan', 'Maragondon', 'Noveleta', 'Poblacion', 'Ternate'];

$employees = [];
if ($isAdmin && $selectedPeriod) {
    $fieldList = "'" . implode("','", $branchOrder) . "'";
    $sql = "SELECT accounts.employeeId AS empId, accounts.fullName, accounts.address,
                   COALESCE(pay_bonus.amount, 0) AS amount,
                   COALESCE(pay_bonus.remarks, '') AS remarks,
                   COALESCE(pay_bonus.acknowledged, 0) AS acknowledged
            FROM accounts
            LEFT JOIN pay_bonus ON pay_bonus.empId = accounts.employeeId AND pay_bonus.periodKey = ?
            WHERE accounts.stats = 0
            ORDER BY FIELD(accounts.address, $fieldList), accounts.employeeId ASC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $selectedPeriod);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bonus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
    background: #f5f6f8;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.page-header {
    margin-bottom: 24px;
}

.page-header h4 {
    font-weight: 700;
    color: #1a2535;
    margin-bottom: 2px;
}

.page-header .subtitle {
    color: #6c757d;
    font-size: 0.9rem;
}

.panel-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    padding: 20px 24px;
    margin-bottom: 24px;
}

.panel-card .form-control,
.panel-card .form-select {
    border-radius: 8px;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.table-scroll-wrapper {
    max-height: 600px;
    overflow-y: auto;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    background: #ffffff;
}

.table {
    margin-bottom: 0;
}

.table-scroll-wrapper thead th {
    position: sticky;
    top: 0;
    background: #f8f9fa;
    color: #1a2535;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    border-bottom: 2px solid #e9ecef;
    z-index: 2;
}

.table tbody tr:hover {
    background-color: #fafbfc;
}

.branch-header th {
    background-color: #eef1f5 !important;
    color: #495057;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.row-amount {
    font-weight: 600;
    color: #1a2535;
}

.badge {
    font-weight: 500;
    padding: 6px 10px;
    border-radius: 6px;
}

.modal-content {
    border-radius: 12px;
    border: none;
}

.modal-header {
    border-bottom: 1px solid #eef1f5;
}

.modal-footer {
    border-top: 1px solid #eef1f5;
}
</style>
</head>
<body class="p-4">

<?php if ($isAdmin): ?>

<div class="container-fluid">
  <div class="page-header">
    <h4>Bonus Periods</h4>
    <div class="subtitle">Create, publish, and manage employee bonus records</div>
  </div>

  <div class="panel-card">
    <div class="d-flex gap-2 mb-3">
      <input type="text" id="newLabel" class="form-control" style="max-width:300px;" placeholder="e.g. 13th Month Pay - December 2026">
      <input type="date" id="newEffectiveDate" class="form-control" style="max-width:180px;" title="Effective Date">
      <button type="button" id="createPeriodBtn" class="btn btn-primary">Create Period</button>
    </div>

    <div class="d-flex gap-2 align-items-center">
      <label><strong>Period:</strong></label>
      <select id="periodSelect" class="form-select" style="max-width:350px;">
        <?php foreach ($periods as $p): ?>
          <option value="<?php echo htmlspecialchars($p['periodKey']); ?>" <?php echo ($p['periodKey'] === $selectedPeriod) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($p['label']); ?><?php echo $p['effectiveDate'] ? ' - ' . htmlspecialchars($p['effectiveDate']) : ''; ?> <?php echo $p['published'] ? '(Published)' : '(Draft)'; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="button" id="togglePublishBtn" class="btn btn-outline-secondary" data-period="<?php echo htmlspecialchars($selectedPeriod); ?>">Toggle Publish</button>
      <button type="button" id="deletePeriodBtn" class="btn btn-outline-danger" data-period="<?php echo htmlspecialchars($selectedPeriod); ?>">Delete Period</button>
      <label class="ms-3"><strong>Branch:</strong></label>
      <select id="branchFilter" class="form-select" style="max-width:220px;">
        <option value="">All</option>
        <?php foreach ($branchOrder as $branchName): ?>
          <option value="<?php echo htmlspecialchars($branchName); ?>"><?php echo htmlspecialchars($branchName); ?></option>
        <?php endforeach; ?>
      </select>
      <button type="button" id="downloadCsvBtn" class="btn btn-outline-success ms-auto">Download CSV</button>
    </div>
  </div>

  <div class="table-scroll-wrapper">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width:90px;">ID</th>
        <th>Employee</th>
        <th style="width:180px;">Amount</th>
        <th>Remarks</th>
        <th style="width:100px;">Acknowledged</th>
        <th style="width:90px;"></th>
      </tr>
    </thead>
    <tbody>
      <?php $currentBranch = null; ?>
      <?php foreach ($employees as $emp): ?>
        <?php if ($emp['address'] !== $currentBranch): $currentBranch = $emp['address']; ?>
        <tr class="table-secondary branch-header" data-branch="<?php echo htmlspecialchars($currentBranch); ?>">
          <th colspan="6"><?php echo htmlspecialchars($currentBranch); ?></th>
        </tr>
        <?php endif; ?>
      <tr data-empid="<?php echo $emp['empId']; ?>"
          data-name="<?php echo htmlspecialchars($emp['fullName']); ?>"
          data-amount="<?php echo $emp['amount']; ?>"
          data-remarks="<?php echo htmlspecialchars($emp['remarks']); ?>"
          data-branch="<?php echo htmlspecialchars($emp['address']); ?>"
          data-acknowledged="<?php echo $emp['acknowledged']; ?>">
        <td class="row-id"><?php echo $emp['empId']; ?></td>
        <td class="row-name"><?php echo htmlspecialchars($emp['fullName']); ?></td>
        <td class="text-end row-amount"><?php echo number_format($emp['amount'], 2); ?></td>
        <td class="row-remarks"><?php echo htmlspecialchars($emp['remarks']); ?></td>
        <td class="text-center"><?php echo $emp['acknowledged'] ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>'; ?></td>
        <td><button class="btn btn-sm btn-primary edit-btn">Edit</button></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>

<div class="modal fade" id="editBonusModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Bonus - <span id="editEmployeeName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editEmpId">
        <div class="mb-3">
          <label class="form-label">Amount</label>
          <input type="number" step="0.01" id="editAmount" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Remarks</label>
          <input type="text" id="editRemarks" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="editSaveBtn" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if ($isAdmin): ?>

$('#createPeriodBtn').on('click', function() {
    var label = $('#newLabel').val().trim();
    var effectiveDate = $('#newEffectiveDate').val();
    if (!label) { alert('Enter a label'); return; }
    if (!effectiveDate) { alert('Select an effective date'); return; }

    var $btn = $(this);
    $btn.prop('disabled', true).text('Creating...');

    $.ajax({
        url: 'pay-bonusrecord.php',
        type: 'POST',
        data: { action: 'createPeriod', label: label, effectiveDate: effectiveDate },
        success: function(response) {
            var data = null;
            try {
                data = JSON.parse(response);
            } catch (e) {
                try {
                    data = JSON.parse(String(response).replace(/^\uFEFF/, '').trim());
                } catch (e2) {
                    console.error('Invalid JSON response from server:', response);
                }
            }
            if (data && data.periodKey) {
                window.location.href = 'pay-bonus.php?period=' + data.periodKey;
            } else {
                // Period was likely created server-side even if the response couldn't be read - refresh to reflect it
                window.location.href = 'pay-bonus.php';
            }
        },
        error: function(xhr, status, error) {
            console.error(status, error);
            $btn.prop('disabled', false).text('Create Period');
        }
    });
});

$('#periodSelect').on('change', function() {
    window.location.href = 'pay-bonus.php?period=' + $(this).val();
});

$('#togglePublishBtn').on('click', function() {
    if (!confirm('Toggle publish status for this bonus period? This will change visibility for all employees.')) {
        return;
    }

    var periodKey = $(this).data('period');
    var $btn = $(this);
    $btn.prop('disabled', true).text('Updating...');

    $.ajax({
        url: 'pay-bonusrecord.php',
        type: 'POST',
        data: { action: 'togglePublish', periodKey: periodKey },
        success: function() { window.location.href = 'pay-bonus.php?period=' + periodKey; },
        error: function(xhr, status, error) {
            console.error(status, error);
            $btn.prop('disabled', false).text('Toggle Publish');
        }
    });
});

$('#deletePeriodBtn').on('click', function() {
    if (!confirm('Delete this bonus period? This will permanently remove all employee bonus records under it, including any already acknowledged. This cannot be undone.')) {
        return;
    }

    if (!confirm('Are you sure? Please confirm again to proceed with deletion.')) {
        return;
    }

    var periodKey = $(this).data('period');
    var $btn = $(this);
    $btn.prop('disabled', true).text('Deleting...');

    $.ajax({
        url: 'pay-bonusrecord.php',
        type: 'POST',
        data: { action: 'deletePeriod', periodKey: periodKey },
        success: function(response) {
            var data = null;
            try {
                data = JSON.parse(response);
            } catch (e) {
                try {
                    data = JSON.parse(String(response).replace(/^\uFEFF/, '').trim());
                } catch (e2) {
                    console.error('Invalid JSON response from server:', response);
                }
            }
            if (data && data.status === 'ok') {
                window.location.href = 'pay-bonus.php';
            } else if (data && data.message) {
                alert(data.message);
                $btn.prop('disabled', false).text('Delete Period');
            } else {
                // Response couldn't be read, but the delete likely still ran server-side - refresh to check
                window.location.href = 'pay-bonus.php';
            }
        },
        error: function(xhr, status, error) {
            console.error(status, error);
            alert('Delete failed');
            $btn.prop('disabled', false).text('Delete Period');
        }
    });
});

$('#branchFilter').on('change', function() {
    var branch = $(this).val();

    $('tbody tr[data-empid]').each(function() {
        var $row = $(this);
        $row.toggle(branch === '' || $row.data('branch') === branch);
    });

    $('tbody tr.branch-header').each(function() {
        var $header = $(this);
        var hasVisible = $header.nextUntil('tr.branch-header', 'tr[data-empid]').filter(':visible').length > 0;
        $header.toggle(hasVisible);
    });
});

$('#downloadCsvBtn').on('click', function() {
    var rows = [['Emp. ID', 'Name', 'Branch', 'Amount', 'Remarks', 'Acknowledged']];

    $('tbody tr[data-empid]').each(function() {
        var $row = $(this);
        rows.push([
            $row.data('empid'),
            $row.data('name'),
            $row.data('branch'),
            parseFloat($row.data('amount')).toFixed(2),
            $row.data('remarks') || '',
            $row.data('acknowledged') == 1 ? 'Yes' : 'No'
        ]);
    });

    var csvContent = rows.map(function(row) {
        return row.map(function(field) {
            var value = String(field).replace(/"/g, '""');
            return '"' + value + '"';
        }).join(',');
    }).join('\n');

    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = <?php echo json_encode('bonus_' . $selectedPeriod . '.csv'); ?>;
    link.click();
});

$(document).on('click', '.edit-btn', function() {
    var $row = $(this).closest('tr');

    $('#editEmpId').val($row.data('empid'));
    $('#editEmployeeName').text($row.data('name'));
    $('#editAmount').val($row.data('amount'));
    $('#editRemarks').val($row.data('remarks'));

    $('#editBonusModal').modal('show');
});

$('#editSaveBtn').on('click', function() {
    var $btn = $(this);
    var empId = $('#editEmpId').val();
    var amount = $('#editAmount').val();
    var remarks = $('#editRemarks').val();
    var $row = $('tr[data-empid="' + empId + '"]');

    $btn.prop('disabled', true).text('Saving...');

    $.ajax({
        url: 'pay-bonusrecord.php',
        type: 'POST',
        data: { action: 'saveAmount', periodKey: <?php echo json_encode($selectedPeriod); ?>, empId: empId, amount: amount, remarks: remarks },
        success: function() {
            $row.data('amount', amount).data('remarks', remarks);
            $row.find('.row-amount').text(parseFloat(amount).toFixed(2));
            $row.find('.row-remarks').text(remarks);
            $('#editBonusModal').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error(status, error);
            alert('Save failed');
        },
        complete: function() {
            $btn.prop('disabled', false).text('Save');
        }
    });
});

<?php endif; ?>
</script>
</body>
</html>