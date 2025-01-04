<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "portfolio";

try {
    
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $full_name = filter_input(INPUT_POST, "full_name", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $phone_number = filter_input(INPUT_POST, "phone_number", FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

        
        if (empty($full_name) || empty($email) || empty($message)) {
            throw new Exception("Please fill in all required fields.");
        }

        
        $sql = "INSERT INTO contacts (full_name, email, phone_number, subject, message) 
                VALUES (:full_name, :email, :phone_number, :subject, :message)";
        $stmt = $conn->prepare($sql);

        
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone_number", $phone_number);
        $stmt->bindParam(":subject", $subject);
        $stmt->bindParam(":message", $message);

        
        $stmt->execute();

        
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (PDOException $e) {
    
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
} catch (Exception $e) {
    
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
} finally {
    
    $conn = null;
}
?>