<?php

// Include database configuration
$mysqli = require __DIR__ . "/database.php";

// Get email from POST request
$email = $_POST["email"];

// Generate a random token
$token = bin2hex(random_bytes(16));

// Hash the token
$token_hash = hash("sha256", $token);

// Calculate expiry time (30 minutes from now)
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

// Prepare SQL statement
$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

// Bind parameters and execute query
$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

// Check if the update was successful
if ($mysqli->affected_rows) {

    // Include mailer configuration
    $mail = require __DIR__ . "/mailer.php";

    // Set up email parameters
    $mail->setFrom("comp424project123@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    // Send the email
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }

}

echo "Message sent, please check your inbox.";

?>
