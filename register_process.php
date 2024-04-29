<?php

if (isset($_POST['register'])) {

    // Connect to the database using config.php
    require_once 'config.php';

    // Validate reCAPTCHA response
    $captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;
    $captchaSecret = RECAPTCHA_SECRET_KEY; // Your reCAPTCHA secret key

    $res = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$captchaSecret."&response=".$captcha));

    if ($res->success === true) {
        // reCAPTCHA validation successful, continue sign-up process

        // Get the form data
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Check if email already exists
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Error: Email already exists.";
            $stmt->close();
            $mysqli->close();
            exit(); // Stop execution
        }

        // Check if username already exists
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Error: Username already exists.";
            $stmt->close();
            $mysqli->close();
            exit(); // Stop execution
        }

        // Prepare and bind the SQL statement
        $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, first_name, last_name, birthdate, security_question_1, security_answer_1, security_question_2, security_answer_2, security_question_3, security_answer_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $username, $email, $password, $first_name, $last_name, $birthdate, $security_question_1, $security_answer_1, $security_question_2, $security_answer_2, $security_question_3, $security_answer_3);

        // Get the rest of the form data
        $password = $_POST['password'];
        $first_name = $_POST['first_name']; // Add first name field
        $last_name = $_POST['last_name']; // Add last name field
        $birthdate = $_POST['birthdate'];
        // Get the security question and answer data
        $security_question_1 = $_POST['security_question_1'];
        $security_answer_1 = $_POST['security_answer_1'];
        $security_question_2 = $_POST['security_question_2'];
        $security_answer_2 = $_POST['security_answer_2'];
        $security_question_3 = $_POST['security_question_3'];
        $security_answer_3 = $_POST['security_answer_3'];

        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo "New account created successfully! Redirecting...";
            echo "<script>setTimeout(function(){window.location.href='index.php';}, 3000);</script>"; // Redirect after 3 seconds
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the connection
        $stmt->close();
        $mysqli->close();

    } else {
        // reCAPTCHA validation failed
        echo "Error: Human check failed";
        exit(); // Stop execution
    }
}
?>
