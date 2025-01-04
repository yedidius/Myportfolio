<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table']; 
    $id = $_POST['id']; 
    $data = $_POST['data']; 

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