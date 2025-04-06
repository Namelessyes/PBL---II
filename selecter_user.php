<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['user_id'];

// Fetch other users to chat with
$stmt = $conn->prepare("SELECT id, username FROM users WHERE id != ?");
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }

      .user-select {
        max-width: 600px;
        margin: 50px auto;
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        text-align: center;
      }

      h2 {
        color: #333;
        margin-bottom: 10px;
      }

      h3 {
        color: #555;
        margin-bottom: 20px;
      }

      ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      li {
        margin: 10px 0;
      }

      a {
        display: block;
        text-decoration: none;
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        font-weight: bold;
      }

      a:hover {
        background-color: #038d5b;
      }

      @media (max-width: 600px) {
        .user-select {
          margin: 20px;
          padding: 20px;
        }

        a {
          font-size: 16px;
          padding: 10px 15px;
        }
      }
    </style>
</head>
<body>

    <div class="user-select">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></h2>
        <h3>Select a user to chat with:</h3>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><a href="chat.php?receiver_id=<?= $user['id'] ?>">
                    <?= htmlspecialchars($user['username']) ?>
                </a></li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>
</html>
