<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dce_student";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape inputs
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Fetch user by email
    $sql = "SELECT id, fname, password_hash FROM students WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) 
      { 
        $row = $result->fetch_assoc();
        $password_hash = $row['password_hash'];

        if (password_verify($password, $password_hash)) {

            // if  Password is correct, create session and redirect to home.php else display "Invalid email or password"
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fname'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DCE</title>

  <link rel="shortcut icon" href="images 2/graphic-design.jpg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <header>
    <style>
      * {
        margin: 0;
        padding: 0;

      }

      body {
        background-image: url('images/graphic-design2.png');
        background-repeat: no-repeat;
        background-size: cover;
        font-family: sans-serif;
      }

      h1 {
        text-align: center;
        margin-top: 6%;
        color: white;
        padding: 10px;
      }

      h2 {
        text-align: center;
      }

      .input {
        display: flex;
        gap: 10px;
      }

      .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
      }

      .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 90%;
        max-width: 400px;
      }

      .summit {
        padding: 10px;
        margin-top: 20px;
        background-color: black;
        color: white;
      }

      .fp-card {
        margin-top: 18px;
      }

      .fp {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }

      .fp:hover,
      .fp:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }

      .sendbotton {
        display: flex;
        gap: 50px;
        margin-left: 50px;
      }

      #form {
        margin-top: 20px;

      }

      .form-container {
        background-color: white;
        padding: 25px;
        width: 30%;
        padding-bottom: 6%;
        border-radius: 5px;
        margin-left: auto;
        margin-right: auto;
      }
    </style>

  </header>

  <main>
    <h1>DCE</h1><br>
    <div class="form-container">
      <h2>Login</h2><br><br>

      <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

      <p1>Sign in to start your session</p1><br><br>
      <form action="" method="post">
        <div class="input">
          <label for="username" required><i class="material-icons">person</i> </label>
          <input type="email" style="width: 125%; height: 25px; " id="email" name="email"
            placeholder="Enter your email"><br> <br><br>
        </div>
        <div class="input">
          <label for="password"><i class="material-icons">lock</i></label>
          <input type="password" style="width: 125%; height: 25px;" id="password" name="password"
            placeholder=" Enter your Password"><br> <br>
        </div><br>

        <div class="sendbotton">
          <div>
            <input type="submit" value="Login"
              style="border: none;  padding: 8px; border-radius: 4px; background-color: black; color: white; cursor: pointer;">
          </div>
          <div class="fp-card">
            <a href="create-account.php"
              style="text-decoration: none; padding-top: 15px; color: black; font-size: 12px;">Create Account</a>
          </div>
          <div class="fp-card" id="fgp-card">
            <a href="#fp-modal" style="text-decoration: none; padding-top: 15px; color: black; font-size: 12px;">Forgot
              Password</a>
          </div>
        </div>
      </form>

      <!-- MODALS -->
      <div id="fp-modal" class="modal">
        <div class="modal-content">
          <a href="forgot_password.php" class="fp">&times;</a>
          <h4>Forgot Password</h4>
          <form id="form">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required style="width: 250px; height: 25px;"><br>
            <button type="submit" class="summit">Reset Password</button>
          </form>
        </div>
      </div>
  </main>
  <footer>

  </footer>

  <script>
    // Get the modal
    var modal = document.getElementById('fp-modal');

    // Get the link that opens the modal
    var link = document.querySelector('a[href="#fp-modal"]');

    // Get the close button
    var closeBtn = document.querySelector('.fp');

    // Function to open the modal
    link.onclick = function (event) {
      event.preventDefault();
      modal.style.display = 'block';
    }

    // Function to close the modal
    closeBtn.onclick = function (event) {
      event.preventDefault();
      modal.style.display = 'none';
    }

    // Close the modal when clicking outside
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
  </script>
</body>

</html>