<?php
// Database connection
$host = "localhost";  
$user = "root";       // change if you have a different username
$pass = "";           // change if you set a MySQL password
$dbname = "DCE_student";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all students
$sql = "SELECT * FROM students ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students - DCE</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: brown;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background: white;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: brown;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .btn-back {
            display: block;
            margin: 20px auto;
            text-align: center;
            background: brown;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
        }
        .btn-back:hover {
            background: darkred;
        }
    </style>
</head>
<body>

    <h2>Registered Students</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Date Registered</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['fname']."</td>
                        <td>".$row['mname']."</td>
                        <td>".$row['lname']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['created_at']."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No students found</td></tr>";
        }
        ?>
    </table>

    <a href="index.php" class="btn-back">⬅ Back to Registration</a>

</body>
</html>

<?php $conn->close(); ?>
