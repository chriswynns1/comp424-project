<?php
require_once 'config.php';
?>

<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<script>
function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    // Check if fields are empty
    if (username === "" || email === "" || password === "" || confirmPassword === "") {
        alert("All fields are required.");
        return false;
    }

    // Check email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Invalid email format.");
        return false;
    }

    // Check if password meets minimum requirements
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}

function checkPasswordStrength() {
    var password = document.getElementById("password").value;
    var passwordStrength = document.getElementById("password-strength");

    // Check password strength and update message
    if (password.length < 8) {
        passwordStrength.innerHTML = "Password too weak";
        passwordStrength.style.color = "red";
    } else {
        passwordStrength.innerHTML = "Password strength: Strong";
        passwordStrength.style.color = "green";
    }
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="registerstyles.css"> 
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
                <form action="register_process.php" method="post" onsubmit="return validateForm()">
                    <label for="username">Username:</label>
                    <input id="username" name="username" required="" type="text" /><br>
                    <label for="email">Email:</label>
                    <input id="email" name="email" required="" type="email" /><br>
                    <label for="password">Password:</label>
                    <input id="password" name="password" required="" type="password" onkeyup="checkPasswordStrength()" /><br>
                    <em id="password-strength"></em><br> <!-- Password strength indicator -->
                    <label for="confirm_password">Confirm Password:</label>
                    <input id="confirm_password" name="confirm_password" required="" type="password" /><br> <!-- Confirm password field -->
                    <!-- Add first name field -->
                    <label for="first_name">First Name:</label>
                    <input id="first_name" name="first_name" required="" type="text" /><br>
                    <!-- Add last name field -->
                    <label for="last_name">Last Name:</label>
                    <input id="last_name" name="last_name" required="" type="text" /><br>
                    <!-- Add the birthdate field -->
                    <label for="birthdate">Birthdate:</label>
                    <input id="birthdate" name="birthdate" required="" type="date" /><br>
                    <label for="security_question_1">Security Question 1:</label>
                    <select name="security_question_1" id="security_question_1">
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <option value="What city were you born in?">What city were you born in?</option>

                    </select><br>
                    <label for="security_answer_1">Answer:</label>
                    <input type="text" name="security_answer_1" id="security_answer_1" required><br><br>

                    <label for="security_question_2">Security Question 2:</label>
                    <select name="security_question_2" id="security_question_2">
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <option value="What city were you born in?">What city were you born in?</option>

                    </select><br>
                    <label for="security_answer_2">Answer:</label>
                    <input type="text" name="security_answer_2" id="security_answer_2" required><br><br>

                    <label for="security_question_3">Security Question 3:</label>
                    <select name="security_question_3" id="security_question_3">
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <option value="What city were you born in?">What city were you born in?</option>

                    </select><br>
                    <label for="security_answer_3">Answer:</label>
                    <input type="text" name="security_answer_3" id="security_answer_3" required><br><br>
                    <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
                    <input name="register" type="submit" value="Register" />
                </form>
                <br>
                <strong>Already have an account? </strong>
                <a href="index.php">Login</a>
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