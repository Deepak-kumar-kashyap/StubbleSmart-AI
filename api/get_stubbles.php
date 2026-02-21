<?php
require_once '../db.php';

header('Content-Type: application/json');

try {
    // Get all stubbles
    $stmt = $pdo->query("SELECT * FROM stubbles ORDER BY created_at DESC");
    $stubbles = $stmt->fetchAll();
    
    // Get stats
    $statsStmt = $pdo->query("SELECT status, COUNT(*) as count FROM stubbles GROUP BY status");
    $statsData = $statsStmt->fetchAll();
    $stats = [
        'total' => count($stubbles),
        'pending' => 0,
        'verified' => 0,
        'collected' => 0,
        'carbon_saved' => 0 // Mocked calculation
    ];
    
    foreach ($statsData as $row) {
        $stats[$row['status']] = (int)$row['count'];
    }
    
    // Carbon saving logic: 1 ton stubble prevented from burning saves ~1.5 tons CO2
    // For MVP, we'll assume each entry is ~2 tons
    $stats['carbon_saved'] = $stats['collected'] * 2 * 1.5;

    echo json_encode([
        'stubbles' => $stubbles,
        'stats' => $stats
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
