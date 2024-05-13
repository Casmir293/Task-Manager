<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../../private/dbconn.php');

// validate input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = test_input($_POST["login_username"]);
$password = $_POST["login_password"];

if (isset($_POST["login_btn"]) && !empty($username) && !empty($password)) {
    $verify_query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_assoc($verify_query_run);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            if ($row['verify_status'] == '1') {
                $_SESSION['authenticated'] = true;
                $_SESSION['auth_user'] = [
                    'email' => $row['email'],
                    'username' => $row['username'],
                    'id' => $row['id'],
                ];
                $_SESSION['status'] = "Login successful";
                header("Location: ../../index.php");
                exit();
            } else {
                $_SESSION['status'] = "You have not verified your email. Kindly do so and try again!";
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Incorrect login details";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Incorrect login details";
        header("Location: ../login.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Fill all fields!";
    header("Location: ../login.php");
    exit();
}

mysqli_close($conn);
