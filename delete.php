<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table']; // Table name (e.g., about, projects, contacts)
    $id = $_POST['id']; // ID of the record to delete

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