<?php
require 'conn.php'; 
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    
    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    $stmt->close();

    if ($user) {
        // Generate token
        $token = bin2hex(random_bytes(50));

        // Store in database
        $stmt = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chuhaokon@gmail.com';
            $mail->Password = 'jlnb wada orpk evce'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('chuhaokon@gmail.com', 'Biohub');
            $mail->addAddress($email);

            $resetLink = "http://localhost/Assignment/reset_password.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = "Password Reset";
            $mail->Body = "Click <a href='$resetLink'>here</a> to reset your password.";

            $mail->send();

            echo"<script>
                alert('Check your email spam for the reset link.');
                window.location.href = 'index.php';
            </script>";
        }catch (Exception $e) {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "<script>
                alert('Email Not Found!');
                window.history.back(); 
              </script>";
        exit();
    }
}
?>