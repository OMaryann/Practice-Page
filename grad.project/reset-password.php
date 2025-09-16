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
    <title>Reset Password</title>
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
    <main>
        <h1>DCE</h1><br>
        <div class="form-container">
            <h2>Reset Password</h2><br>
            <form method="post">
                <div class="input">
                    <label for="new-password">New Password:</label> 
                    <input type="password" id="new-password" name="new_password" placeholder="New Password" required><br><br>
                </div>
                <div class="input">
                    <label for="confirm-password">Confirm Password:</label> 
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required><br><br>
                </div>
                <div class="sendbutton">
                    <input type="submit" value="Submit" style="border: none; padding: 8px; border-radius: 4px; background-color: black; color: white; cursor: pointer;">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
