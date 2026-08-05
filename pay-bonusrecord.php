<?php
include('connection.php');

$action = $_POST['action'] ?? '';

// adjust session key here if your login uses a different variable name
$username = strtolower(trim($_SESSION['username'] ?? ''));
$isAdmin = in_array($username, ['cdalegre', 'jcvillanueva', 'jatabat', 'caramos']);

$adminActions = ['createPeriod', 'togglePublish', 'saveAmount', 'syncEmployees', 'deletePeriod'];
if (in_array($action, $adminActions) && !$isAdmin) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'unauthorized']);
    exit;
}

switch ($action) {

    case 'createPeriod':
        $label = trim($_POST['label']);
        $effectiveDate = trim($_POST['effectiveDate'] ?? '');
        $periodKey = date('YmdHis');

        if ($effectiveDate === '' || !DateTime::createFromFormat('Y-m-d', $effectiveDate)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid effective date']);
            break;
        }

        $empResult = $con->query("SELECT employeeId FROM accounts WHERE stats = 0");
        $stmt = $con->prepare("INSERT INTO pay_bonus (periodKey, label, effectiveDate, empId) VALUES (?, ?, ?, ?)");
        while ($row = $empResult->fetch_assoc()) {
            $empId = $row['employeeId'];
            $stmt->bind_param('sssi', $periodKey, $label, $effectiveDate, $empId);
            $stmt->execute();
        }
        echo json_encode(['status' => 'ok', 'periodKey' => $periodKey]);
        break;

    case 'togglePublish':
        $periodKey = $_POST['periodKey'];
        $stmt = $con->prepare("UPDATE pay_bonus SET published = 1 - published WHERE periodKey = ?");
        $stmt->bind_param('s', $periodKey);
        $stmt->execute();
        echo json_encode(['status' => 'ok']);
        break;

    case 'saveAmount':
        $periodKey = $_POST['periodKey'];
        $empId = (int) $_POST['empId'];
        $amount = (float) $_POST['amount'];
        $remarks = $_POST['remarks'];

        $labelStmt = $con->prepare("SELECT label, effectiveDate FROM pay_bonus WHERE periodKey = ? LIMIT 1");
        $labelStmt->bind_param('s', $periodKey);
        $labelStmt->execute();
        $labelRow = $labelStmt->get_result()->fetch_assoc();
        $label = $labelRow['label'] ?? '';
        $effectiveDate = $labelRow['effectiveDate'] ?? null;

        $stmt = $con->prepare("INSERT INTO pay_bonus (periodKey, label, effectiveDate, empId, amount, remarks)
                                VALUES (?, ?, ?, ?, ?, ?)
                                ON DUPLICATE KEY UPDATE amount = ?, remarks = ?");
        $stmt->bind_param('sssidsds', $periodKey, $label, $effectiveDate, $empId, $amount, $remarks, $amount, $remarks);
        $stmt->execute();
        echo json_encode(['status' => 'ok']);
        break;

    case 'getMyBonuses':
        if (!isset($_SESSION['employeeId'])) {
            echo json_encode(['total' => '0.00', 'count' => 0, 'items' => []]);
            break;
        }
        $empId = $_SESSION['employeeId'];
        $periodKey = $_POST['periodKey'] ?? '';

        if ($periodKey !== '') {
            $stmt = $con->prepare("SELECT label, amount, remarks FROM pay_bonus WHERE empId = ? AND periodKey = ? AND published = '1' ORDER BY periodKey DESC");
            $stmt->bind_param('is', $empId, $periodKey);
        } else {
            $stmt = $con->prepare("SELECT label, amount, remarks FROM pay_bonus WHERE empId = ? AND published = '1' ORDER BY periodKey DESC");
            $stmt->bind_param('i', $empId);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        $total = 0;
        while ($row = $result->fetch_assoc()) {
            $items[] = [
                'label' => $row['label'],
                'amount' => number_format((float) $row['amount'], 2),
                'remarks' => $row['remarks']
            ];
            $total += (float) $row['amount'];
        }
        echo json_encode(['total' => number_format($total, 2), 'count' => count($items), 'items' => $items]);
        break;
        
    case 'getAmount':
        $empId = $_SESSION['employeeId'];
        $periodKey = $_POST['periodKey'];
        $stmt = $con->prepare("SELECT amount, remarks, acknowledged FROM pay_bonus WHERE periodKey = ? AND empId = ?");
        $stmt->bind_param('si', $periodKey, $empId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            echo json_encode([
                'amount' => number_format((float) $row['amount'], 2),
                'remarks' => $row['remarks'],
                'acknowledged' => (int) $row['acknowledged']
            ]);
        } else {
            echo json_encode(['amount' => '0.00', 'remarks' => '', 'acknowledged' => 0]);
        }
        break;

    case 'acknowledge':
        $empId = $_SESSION['employeeId'];
        $periodKey = $_POST['periodKey'];
        $stmt = $con->prepare("UPDATE pay_bonus SET acknowledged = 1, acknowledged_at = NOW() WHERE periodKey = ? AND empId = ?");
        $stmt->bind_param('si', $periodKey, $empId);
        $stmt->execute();
        echo json_encode(['status' => 'ok']);
        break;

    case 'syncEmployees':
        $periodKey = $_POST['periodKey'];

        $labelStmt = $con->prepare("SELECT label, effectiveDate FROM pay_bonus WHERE periodKey = ? LIMIT 1");
        $labelStmt->bind_param('s', $periodKey);
        $labelStmt->execute();
        $labelRow = $labelStmt->get_result()->fetch_assoc();
        $label = $labelRow['label'] ?? '';
        $effectiveDate = $labelRow['effectiveDate'] ?? null;

        $existing = [];
        $existingStmt = $con->prepare("SELECT empId FROM pay_bonus WHERE periodKey = ?");
        $existingStmt->bind_param('s', $periodKey);
        $existingStmt->execute();
        $existingResult = $existingStmt->get_result();
        while ($row = $existingResult->fetch_assoc()) {
            $existing[] = $row['empId'];
        }

        $allEmp = $con->query("SELECT employeeId FROM accounts WHERE stats = 0");
        $insertStmt = $con->prepare("INSERT INTO pay_bonus (periodKey, label, effectiveDate, empId) VALUES (?, ?, ?, ?)");
        $added = 0;
        while ($row = $allEmp->fetch_assoc()) {
            $empId = $row['employeeId'];
            if (!in_array($empId, $existing)) {
                $insertStmt->bind_param('sssi', $periodKey, $label, $effectiveDate, $empId);
                $insertStmt->execute();
                $added++;
            }
        }
        echo json_encode(['status' => 'ok', 'added' => $added]);
        break;

    case 'deletePeriod':
        $periodKey = $_POST['periodKey'] ?? '';

        if ($periodKey === '') {
            echo json_encode(['status' => 'error', 'message' => 'No period specified']);
            break;
        }

        $deleteStmt = $con->prepare("DELETE FROM pay_bonus WHERE periodKey = ?");
        $deleteStmt->bind_param('s', $periodKey);
        $deleteStmt->execute();
        echo json_encode(['status' => 'ok']);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'invalid action']);
}