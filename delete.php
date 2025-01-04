<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table']; 
    $id = $_POST['id']; 

    $sql = "DELETE FROM $table WHERE id = : id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete record"]);
    }
}
?>