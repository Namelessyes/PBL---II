<?php
include 'db.php';

// Fetch all messages with sender and receiver names
$query = "
    SELECT messages.id, messages.message, messages.timestamp,
           u1.username AS sender_name,
           u2.username AS receiver_name
    FROM messages
    JOIN users u1 ON messages.sender_id = u1.id
    JOIN users u2 ON messages.receiver_id = u2.id
    ORDER BY messages.timestamp DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdf6e3;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f0a500;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h2>All Messages</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Message</th>
            <th>Timestamp</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['sender_name']) ?></td>
                <td><?= htmlspecialchars($row['receiver_name']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= htmlspecialchars($row['timestamp']) ?></td>
                <td>
                    <form method="POST" action="delete_messages.php" onsubmit="return confirm('Delete this message?');">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="delete-btn" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
