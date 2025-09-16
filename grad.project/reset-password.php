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
</head>
<body>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php elseif (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <h1>DCE</h1><br>
        <div class="form-container">
        <h2>Reset Password</h2><br>
        <form action="mailto:" method=" post">
            <div class="input">
                <label for="new-password" required>  </label> 
                <input type="password" style="width: 100%; height: 25px; " id="username" name="username" placeholder="New Password" ><br> <br>
            </div>
            <div class="input">
                <label for="confirm-password"></label> 
                <input type="password" style="width: 100%; height: 25px;" id="password" name="password" placeholder="Confirm Password"><br> 
            </div><br>
            <div class="sendbotton">
              <div>
                <input type = "submit" value = "Submit"  style="border: none;  padding: 8px; border-radius: 4px; background-color: black; color: white; cursor: pointer;">
              </div>
              
            </div>
        </form>
</body>
</html>
