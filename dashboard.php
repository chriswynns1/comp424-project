<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect them to the login page
    header("Location: login.php");
    exit;
}

// Include database configuration
require_once "config.php";

// Update last login date and increment login count
$user_id = $_SESSION['id']; // Corrected variable name
$now = date('Y-m-d H:i:s');
$update_query = "UPDATE users SET last_login_date='$now', login_count=login_count+1 WHERE id=$user_id";

if ($mysqli->query($update_query) === false) {
    die("Error updating last login date: " . $mysqli->error);
}

// Retrieve user's information
$select_query = "SELECT * FROM users WHERE id=$user_id";
$result = $mysqli->query($select_query);

if ($result === false) {
    die("Error fetching user information: " . $mysqli->error);
}

$user = $result->fetch_assoc();

// If the user is logged in, display the dashboard content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashstyles.css">
</head>
    
<body>
    <div class="bubble-container">
        <div class="bubbles">            
            <span style="--i:29"></span>
            <span style="--i:44"></span>
            <span style="--i:19"></span>
            <span style="--i:15"></span>
            <span style="--i:43"></span>
            <span style="--i:46"></span>
            <span style="--i:28"></span>
            <span style="--i:33"></span>
            <span style="--i:36"></span>
            <span style="--i:18"></span>
            <span style="--i:32"></span>
            <span style="--i:42"></span>
            <span style="--i:23"></span>
            <span style="--i:26"></span>
            <span style="--i:11"></span>
            <span style="--i:31"></span>
            <span style="--i:22"></span>
            <span style="--i:47"></span>
            <div class="wrapper">
                <div class = "container">
                    <h1>Welcome to the Dashboard, <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>!</h1>
                    <p>You have logged in <?php echo $user['login_count']; ?> times.</p>
                    <p>Last login date: <?php echo $user['last_login_date']; ?></p><br><br>
                    <p>Download the company confidential file <a href="company_confidential_file.txt" download="">here</a></p><br><br>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <span style="--i:21"></span>
            <span style="--i:25"></span>
            <span style="--i:37"></span>
            <span style="--i:38"></span>
            <span style="--i:34"></span>
            <span style="--i:14"></span>
            <span style="--i:41"></span>
            <span style="--i:17"></span>
            <span style="--i:12"></span>
            <span style="--i:24"></span>
            <span style="--i:45"></span>
            <span style="--i:40"></span>
            <span style="--i:35"></span>
            <span style="--i:27"></span>
            <span style="--i:20"></span>
            <span style="--i:13"></span>
            <span style="--i:16"></span>
            <span style="--i:39"></span>
        </div>
    </div>
</body>
</html>
