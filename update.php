<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table']; // Table name (e.g., about, projects, contacts)
    $id = $_POST['id']; // ID of the record to update
    $data = $_POST['data']; // Data to update (associative array)

    $updates = [];
    foreach ($data as $key => $value) {
        $updates[] = "$key = :$key";
    }
    $updates = implode(", ", $updates);

    $sql = "UPDATE $table SET $updates WHERE id = :id";
    $stmt = $conn->prepare($sql);

    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Record updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update record"]);
    }
}
?>