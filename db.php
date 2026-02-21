<?php
$host = 'localhost';
$dbname = 'stubblesmart';
$username = 'root'; // Default XAMPP/WAMP username
$password = '';     // Default XAMPP/WAMP password

if (basename($_SERVER['PHP_SELF']) !== 'db.php') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        die(json_encode(["success" => false, "message" => "Connection failed: " . $e->getMessage()]));
    }
}
?>
