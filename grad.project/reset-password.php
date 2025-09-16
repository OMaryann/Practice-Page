<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dce_student";

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

// Check expiration
if (time() > $expires_at) {
    $del = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
    $del->bind_param("s", $token);
    $del->execute();
    $del->close();
    die("Reset link has expired. Please request a new one.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE students SET password_hash = ? WHERE email = ?");
        $update->bind_param("ss", $hashed_password, $email);
        if ($update->execute()) {
            $delete = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $delete->bind_param("s", $token);
            $delete->execute();
            $delete->close();

            $success = "Your password has been reset. <a href='index.php'>Click here to login</a>.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
        $update->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
<style>
    .form-container {
        background-color: white;
        padding:25px;
        width: 30%;
        padding-bottom: 6%;
        border-radius: 5px;
        margin-left: auto;
        margin-right: auto;
        background-color: brown;
        }

        h1 {
            text-align: center;
            margin-top: 6%;
            color: brown;
            padding: 10px;
            }

        

</style>
    </header>
    <main>
<main>
            <h1>DCE</h1><br>
    <div class="form-container">
        <h2>Reset Password</h2><br>

        <?php if (!empty($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p style="color:green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="post">
            <div class="input">
                <input type="password" name="password" placeholder="New Password" required style="width: 100%; height: 25px;"><br><br>
            </div>
            <div class="input">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required style="width: 100%; height: 25px;"><br>
            </div><br>
            <div class="sendbotton">
                <input type="submit" value="Submit" style="border: none; padding: 8px; border-radius: 4px; background-color: black; color: white; cursor: pointer;">
            </div>
        </form>
</div>

    </main>
    <footer>

    </footer>
</body>
</html>