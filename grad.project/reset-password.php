<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dce_student";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Piassword</title>
    <style>
        .form-container {
            background-color: brown;
            padding: 25px;
            width: 30%;
            padding-bottom: 6%;
            border-radius: 5px;
            margin: 6% auto;
            color: white;
        }
        h1 {
            text-align: center;
            color: brown;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h2>Reset Your Password Here</h2>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php elseif (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="password">Type New Password:</label><br>
        <input type="password" name="password" id="password" required autocomplete="new-password"><br><br>

        <label for="confirm_password">Confirm New Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required autocomplete="new-password"><br><br>

        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
