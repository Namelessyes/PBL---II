<?php
include("CONFIG.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider_id = $_POST["provider_id"];
    $job_title = $_POST["job_title"];
    $job_description = $_POST["job_description"];
    $required_skills = $_POST["required_skills"];
    $pay_rate = $_POST["pay_rate"];

    $sql = "INSERT INTO jobs (provider_id, job_title, job_description, required_skills, pay_rate) 
            VALUES ('$provider_id', '$job_title', '$job_description', '$required_skills', '$pay_rate')";

    if ($conn->query($sql) === TRUE) {
        echo "Job posted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
