<?php
require_once 'db_connection.php';

$table = $_GET['table']; // Table name (e.g., about, projects, contacts)
$id = $_GET['id'] ?? null; // Optional: Fetch a specific record by ID

if ($id) {
    $sql = "SELECT * FROM $table WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
} else {
    $sql = "SELECT * FROM $table";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["status" => "success", "data" => $records]);
?>