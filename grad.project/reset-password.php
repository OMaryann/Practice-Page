<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "DCE_student";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = $error = "";
$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid or missing token.");
}

// Check if token exists and is not expired
$stmt = $conn->prepare("SELECT email, expires_at FROM password_resets WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Invalid or expired token.");
}

$row = $result->fetch_assoc();
$email = $row['email'];
$expires_at = strtotime($row['expires_at']);

if (time() > $expires_at) {
    $conn->prepare("DELETE FROM password_resets WHERE token = ?")->bind_param("s", $token)->execute();
    die("Reset link has expired. Please request a new one.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update user's password
        $stmt = $conn->prepare("UPDATE students SET password_hash = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        if ($stmt->execute()) {
            // Delete used token
            $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            $success = "Your password has been reset. <a href='index.php'>Click here to login</a>.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php elseif (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="password">New Password:</label><br>
        <input type="password" name="password" id="password" required autocomplete="new-password"><br><br>

        <label for="confirm_password">Confirm New Password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required autocomplete="new-password"><br><br>

        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
