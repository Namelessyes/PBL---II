<?php
include("CONFIG.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $provider_id = $_POST["provider_id"];
    $amount = $_POST["amount"];

    $sql = "INSERT INTO payments (student_id, provider_id, amount) VALUES ('$student_id', '$provider_id', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment recorded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
