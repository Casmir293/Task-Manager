<?php
session_start();
require_once('../../private/dbconn.php');

$username = $_SESSION['auth_user']['username'];
$old_password = $_POST["old_password"];
$new_password = $_POST["new_password"];

if (isset($_POST["update_btn"]) && !empty($old_password) && !empty($new_password)) {
    $verify_query = "SELECT password FROM users WHERE username = '$username' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_assoc($verify_query_run);
        $old_hashed_password = $row['password'];

        // Verify old password and hash the new password
        if (password_verify($old_password, $old_hashed_password)) {
            $new_hash_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_query = "UPDATE users SET password = '$new_hash_password' WHERE username = '$username' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if ($update_query_run) {
                $_SESSION['status'] = "Password updated successfully";
            } else {
                $_SESSION['status'] = "Error updating password";
            }
        } else {
            $_SESSION['status'] = "Incorrect old password";
        }
    } else {
        $_SESSION['status'] = "Incorrect details";
    }
} else {
    $_SESSION['status'] = "Fill the password fields.";
}

mysqli_close($conn);

header("Location: ../../profile.php");
exit();
