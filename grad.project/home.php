<?php
// Optional: Start session (useful later if you want login/logout features)
session_start();
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
      .dce {
        color: white;
        margin-left: 40px;
        margin-right: 40px;
      }
      .welcome{
        text-align: center;
        color: white;
        padding-top: 15%;
      }
      .join-us {
        display: flex;
        gap: 10%;
        justify-content: center;
        padding-top: 30px;
      }
      .join-us a {
        text-decoration: none;
        color: brown;
        background-color: white;
        border-radius: 10px;
        align-content: center;
        padding: 10px;
      }

      
    </style>

  </header>
    <main>
        <h1 class="welcome"> Welcome to DCE </h1>
        <marquee width="60%" direction="up" height="100px" style="color: white; margin-left: 29%;">
        <h3>No. 1 trusted source for innovative computer engineering solutions</h3>
        </marquee>
        <p class="dce">
         We're thrilled to have you here. At DCE, we're dedicated to providing innovative and reliable 
        computer engineering solutions tailored to your needs. Explore our services and discover how we can
        help you achieve your technological goals.
        </p>
        <div class="join-us">
        <a href="create-account.php"><h3>JOIN US NOW!</h3></a>
        <a href="index.php"><h3>ALREADY A MEMBER- LOG IN</h3></a>
        </div>
    </main>

</body>
</html>