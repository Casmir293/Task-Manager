<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../vendor/autoload.php';
require_once '../../private/secret.php';
require_once('../../private/dbconn.php');

function send_verification_link($username, $email, $token)
{
    global $pwd;
    $mail = new PHPMailer(true);

    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'casmir293@gmail.com';
    $mail->Password   = $pwd;
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('casmir293@gmail.com', $username);
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Password reset from My Task Manager';
    $email_template = "
    <h2>You have requested a password rest on your Task Manager account</h2>
    <p>Verify your email address with the below link to enable you to set a new password.</p>
    <br/><br/>
    <button><a href='http://localhost/task-manager/auth/reset-password.php?email=$email?token=$token'>Verify!</a></button>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if (isset($_POST['submit_btn']) && !empty(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $check_email_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $row = mysqli_fetch_assoc($check_email_query_run);
        $username = $row['username'];
        $stored_email = $row['email'];
        $token = md5(rand());

        send_verification_link("$username", "$stored_email", "$token");
        $_SESSION['status'] = "Password reset link has been sent to your email";
        header("Location: ../login.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Email not registered.";
        header('Location: ../forgot-password.php');
        exit(0);
    }
} else {
    $_SESSION['status'] = "Kindly enter a valid email address!";
    header('Location: ../forgot-password.php');
    exit(0);
}

mysqli_close($conn);
