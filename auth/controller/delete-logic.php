<?php
session_start();

require_once('../../private/dbconn.php');

$username = $_SESSION['auth_user']['username'];
$password = $_POST['password'];

if (isset($_POST["delete_btn"]) && !empty($password)) {
    $verify_query = "SELECT password FROM users WHERE username = '$username' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_assoc($verify_query_run);
        $my_password = $row['password'];

        if (password_verify($password, $my_password)) {
            $delete_query = "DELETE FROM users WHERE username='$username' LIMIT 1";
            $delete_query_run = mysqli_query($conn, $delete_query);

            if ($delete_query_run) {
                unset($_SESSION['authenticated']);
                unset($_SESSION['auth_user']);
                $_SESSION['status'] = "Account deleted successfully";
                header("Location: ../register.php");
                exit();
            } else {
                $_SESSION['status'] = "Error deleting account";
                header("Location: ../delete-account.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Incorrect password";
            header("Location: ../delete-account.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Incorrect password";
        header("Location: ../delete-account.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Password cannot be empty.";
    header("Location: ../delete-account.php");
    exit();
}

mysqli_close($conn);
