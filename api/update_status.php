<?php
// Global error handler to catch everything and return JSON
function handleFatalError() {
    $error = error_get_last();
    if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_COMPILE_ERROR)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Fatal Error: ' . $error['message']]);
        exit;
    }
}
register_shutdown_function('handleFatalError');

error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once '../db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;
    
    // Validate status
    $allowedStatuses = ['pending', 'verified', 'collected'];
    
    if ($id && in_array($status, $allowedStatuses)) {
        try {
            $stmt = $pdo->prepare("UPDATE stubbles SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);
            echo json_encode(['success' => true, 'message' => 'Status updated to ' . $status]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data. ID: ' . $id . ', Status: ' . $status]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
