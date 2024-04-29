<?php
session_start();

if (isset($_POST['login'])) {
    require_once 'config.php'; // Include the config file
    
    // Prepare and bind the SQL statement
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Execute the SQL statement
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $hashed_password);

        // Fetch the result
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set the session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;

            // Redirect to the user's dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> 
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
                    <h1>Login to Your Account</h1>
                    <!-- Login form -->
                    <form action="index.php" method="post"> <!-- Use the same PHP file to process form submissions -->
                        <label for="username">Username:</label>
                        <input id="username" name="username" required type="text" />

                        <label for="password">Password:</label> 
                        <input id="password" name="password" required type="password" />

                        <input name="login" type="submit" value="Login" />
                    </form>
                    <br>
                    <!-- Additional links for password reset and registration -->
                    <a href="forgot-password.php">Forgot password?</a><br><br>
                    <strong>Don't have an account yet?</strong> 
                    <br>
                    <a href="register.php">Sign Up</a>
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
