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
    $mail->Host       = 'casmir.dev';
    $mail->Username   = 'webdev@casmir.dev';
    $mail->Password   = $pwd;
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('webdev@casmir.dev', $username);
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Password reset from My Task Manager';
    $email_template = "
    <h2>You have requested a password rest on your Task Manager account</h2>
    <p>Verify your email address with the below link to enable you to set a new password.</p>
    <br/><br/>
    <button><a href='http://localhost/task-manager/auth/reset-password.php?email=$email&token=$token'>Verify!</a></button>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Send new password reset link
if (isset($_POST['submit_btn'])) {
    if (!empty(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $check_email_query = "SELECT * FROM users WHERE email ='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_email_query_run) > 0) {
            $row = mysqli_fetch_assoc($check_email_query_run);
            $username = $row['username'];
            $stored_email = $row['email'];
            $token = md5(rand());

            $update_token = "UPDATE users SET token = '$token' WHERE email = '$stored_email' LIMIT 1";
            $update_token_run = mysqli_query($conn, $update_token);

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
}

// Update the password
if (isset($_POST["update_pwd_btn"])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = mysqli_real_escape_string($conn, $_POST['password_token']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    if (!empty($token)) {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $check_token = "SELECT token FROM users WHERE token='$token' LIMIT 1";
            $check_token_run = mysqli_query($conn, $check_token);

            if (mysqli_fetch_assoc($check_token_run) > 0) {
                $update_password = "UPDATE users SET password = '$hashed_password' WHERE token = '$token' LIMIT 1";
                $update_password_run = mysqli_query($conn, $update_password);
                if ($update_password_run) {
                    $new_token = md5(rand());
                    $change_token = "UPDATE users SET token = '$new_token' WHERE token = '$token' LIMIT 1";
                    $change_token_run = mysqli_query($conn, $change_token);
                    $_SESSION['status'] = "Updated password successfully";
                    header("Location: ../login.php");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Could not update password, something went wrong.";
                    header("Location: ../reset-password.php?email=$email&token=$token");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid token";
                header("Location: ../reset-password.php?email=$email&token=$token");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Fill all fields";
            header("Location: ../reset-password.php?email=$email&token=$token");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No token available";
        header('Location: ../reset-password.php');
        exit(0);
    }
}

mysqli_close($conn);
