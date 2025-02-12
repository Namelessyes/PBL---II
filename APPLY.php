<?php
include("CONFIG.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $job_id = $_POST["job_id"];

    $sql = "INSERT INTO applications (student_id, job_id) VALUES ('$student_id', '$job_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Application submitted!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
