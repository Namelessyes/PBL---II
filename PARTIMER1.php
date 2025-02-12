<?php
// Include configuration file for database connection
include("BACKEND/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partimer - Job Platform</title>
    <link rel="stylesheet" href="PARTIMER CSS/PARTIMER1.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="PARTIMER1.php">Home</a></li>
            <li><a href="BACKEND/REGISTER.php">Register</a></li>
            <li><a href="BACKEND/LOGIN.php">Login</a></li>
            <li><a href="BACKEND/POST.php">Post a Job</a></li>
            <li><a href="BACKEND/APPLY.php">Apply for Jobs</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1>Welcome to Partimer</h1>
        <p>A platform connecting students with job providers.</p>

        <!-- Login Form -->
        <h2>Login</h2>
        <form action="BACKEND/LOGIN.php" method="POST">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Registration Form -->
        <h2>Register</h2>
        <form action="BACKEND/REGISTER.php" method="POST">
            <input type="text" name="name" placeholder="Enter Full Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Create Password" required>
            <button type="submit">Register</button>
        </form>
    </div>

</body>
</html>
