<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table']; 
    $data = $_POST['data']; 

    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $stmt = $conn->prepare($sql);

    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Record created successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to create record"]);
    }
}
?>