<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

$current_user_id = $_SESSION['user_id'] ?? null;
$receiver_id = $_GET['receiver_id'] ?? null;

if (!$current_user_id || !$receiver_id) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT messages.*, u1.username AS sender_name, u2.username AS receiver_name
    FROM messages
    JOIN users u1 ON messages.sender_id = u1.id
    JOIN users u2 ON messages.receiver_id = u2.id
    WHERE (sender_id = ? AND receiver_id = ?)
       OR (sender_id = ? AND receiver_id = ?)
    ORDER BY timestamp ASC
");
$stmt->bind_param("iiii", $current_user_id, $receiver_id, $receiver_id, $current_user_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $row['alignment'] = ($row['sender_id'] == $current_user_id) ? 'right' : 'left';
    $row['label'] = $row['sender_name'] . ' → ' . $row['receiver_name'];
    $messages[] = $row;
}

echo json_encode($messages);
?>
