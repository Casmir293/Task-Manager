<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../../private/dbconn.php');

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
                header("Location: ../login.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Verification failed!";
                header("Location: ../login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Email already verified, please login.";
            header("Location: ../login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "This token does not exist";
        header("Location: ../login.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Not Allowed";
    header("Location: ../login.php");
    exit(0);
}

mysqli_close($conn);
