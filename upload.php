<?php
// Global error handler to catch everything and return JSON
function handleFatalError() {
    $error = error_get_last();
    if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_COMPILE_ERROR)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Fatal Error: ' . $error['message'], 'file' => $error['file'], 'line' => $error['line']]);
        exit;
    }
}
register_shutdown_function('handleFatalError');

// Disable plain text error display
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once 'db.php';

header('Content-Type: application/json');

// Check if POST data is missing (often due to post_max_size exceeded)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) {
    echo json_encode(['success' => false, 'message' => 'Post data exceeded server limits (post_max_size). Try a smaller image.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $latitude = $_POST['latitude'] ?? null;
    $longitude = $_POST['longitude'] ?? null;
    $confidence = $_POST['confidence'] ?? 0;
    
    if (isset($_FILES['image']) && $latitude !== null && $longitude !== null) {
        $uploadDir = 'uploads/';
        
        // Ensure directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['image']['name']));
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO stubbles (image_path, latitude, longitude, confidence, status) VALUES (?, ?, ?, ?, 'verified')");
                $stmt->execute([$uploadFile, $latitude, $longitude, $confidence]);
                echo json_encode(['success' => true, 'message' => 'Stubble recorded successfully!']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            $error = error_get_last();
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file. Check folder permissions.', 'debug' => $error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing required data. Latitude: ' . $latitude . ', Longitude: ' . $longitude]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
