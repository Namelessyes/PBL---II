<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['user_id'];
$current_username = $_SESSION['username'];
$receiver_id = isset($_GET['receiver_id']) ? (int)$_GET['receiver_id'] : 0;

if ($receiver_id === 0) {
    header("Location: selecter_user.php");
    exit();
}

// Get receiver name
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $receiver_id);
$stmt->execute();
$stmt->bind_result($receiver_username);
$stmt->fetch();
$stmt->close();

// Send message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $msg = trim($_POST['message']);
    if ($msg !== '') {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $current_user_id, $receiver_id, $msg);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat - <?= $receiver_username ?></title>
    <link rel="stylesheet" href="style.css">
    <script>

function fetchMessages() {
    const receiverId = <?= $receiver_id ?>;
    fetch('fetch_messages.php?receiver_id=' + receiverId)
        .then(response => response.json())
        .then(data => {
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = ''; // Clear previous messages

            data.forEach(msg => {
                const msgDiv = document.createElement('div');
                msgDiv.classList.add('message', msg.alignment);

                msgDiv.innerHTML = `
                    <div><strong>${msg.label}</strong></div>
                    <div>${msg.message}</div>
                    <div class="timestamp">${msg.timestamp}</div>
                `;

                chatBox.appendChild(msgDiv);
            });

            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => console.error('Error fetching messages:', error));
}

setInterval(fetchMessages, 2000);
</script>


</head>
<body>
    <div class="chat-container">
        <h2>Chatting with <?= htmlspecialchars($receiver_username) ?></h2>
        <div id="chat-box" class="chat-box"></div>
        <form method="POST" class="chat-form">
            <input type="text" name="message" placeholder="Type message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
   

</body>
</html>
