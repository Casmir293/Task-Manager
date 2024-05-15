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

function resend_email_verify($username, $email, $token)
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
    $mail->Subject = 'Resend -   Email Verificatition from My Task Manager';
    $email_template = "
    <h2>You have Registered with My Task Manager</h2>
    <p>Verify your email address with the below link to enable your login access.</p>
    <br/><br/>
    <button><a href='http://localhost/task-manager/auth/controller/verify-email.php?token=$token'>Verify!</a></button>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if (isset($_POST['verify_btn'])) {
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check_email_query = "SELECT * FROM users WHERE email ='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_email_query_run) > 0) {

            $row = mysqli_fetch_assoc($check_email_query_run);

            if ($row['verify_status'] == "0") {
                $username = $row['username'];
                $email = $row['email'];
                $token = $row['token'];

                resend_email_verify("$username", "$email", "$token");
                $_SESSION['status'] = "Verification link has been sent to your email";
                header("Location: ../login.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Email already verified, please login.";
                header("Location: ../login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "You are not a registered user, kindly register your account.";
            header('Location: ../register.php');
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Kindly enter a valid email address!";
        header('Location: ../resend-email-verification.php');
        exit(0);
    }
}

mysqli_close($conn);
