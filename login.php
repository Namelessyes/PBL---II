 <?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Secure way: Fetch hashed password and verify using password_verify()
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: selecter_user.php");
            exit();
        } else {
            $error = "Invalid credentials";
        }
    } else {
        $error = "Invalid credentials";
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      .container {
        padding: 16px;
        max-width: 500px;
        margin: auto;
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
        margin-top: 50px;
        font-family: Arial, sans-serif;
      }

      input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
        border-radius: 5px;
      }

      input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }

      .loginbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        font-size: 16px;
        border-radius: 5px;
      }

      .loginbtn:hover {
        opacity: 1;
      }

      .signin {
        background-color: #f1f1f1;
        text-align: center;
        padding: 10px;
        border-radius: 0 0 10px 10px;
      }

      .error {
        color: red;
        margin-bottom: 15px;
        text-align: center;
      }

      a {
        color: dodgerblue;
      }
    </style>
</head>
<body>

  <form method="POST" action="login.php">
    <div class="container">
      <h1>Login</h1>
      <p>Please enter your credentials to log in.</p>
      <hr>

      <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <label for="username"><b>Username</b></label>
      <input type="text" name="username" placeholder="Username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" name="password" placeholder="Password" required>

      <button type="submit" class="loginbtn">Login</button>
    </div>

    <div class="container signin">
      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </form>

</body>
</html>
