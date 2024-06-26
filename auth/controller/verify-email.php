<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../../private/dbconn.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $verify_query = "SELECT token, verify_status FROM users WHERE token = '$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    $row = mysqli_fetch_assoc($verify_query_run);

    if (mysqli_num_rows($verify_query_run) > 0) {

        if ($row['verify_status'] == "0") {
            $clicked_token = $row['token'];

            $update_query = "UPDATE users SET verify_status = '1' WHERE token = '$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if ($update_query_run) {
                $_SESSION['status'] = "Account verified successfully!";
            } else {
                $_SESSION['status'] = "Verification failed!";
            }
        } else {
            $_SESSION['status'] = "Email already verified, please login.";
        }
    } else {
        $_SESSION['status'] = "This token does not exist";
    }
} else {
    $_SESSION['status'] = "Not Allowed";
}

mysqli_close($conn);

header("Location: ../login.php");
exit();
