<?php
session_start();
require_once('../private/dbconn.php');

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $delete_query = "DELETE FROM tasks WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $task_id);
    $delete_result = mysqli_stmt_execute($stmt);

    if ($delete_result) {
        $_SESSION['status'] = "Task deleted successfully";
    } else {
        $_SESSION['status'] = "Failed to delete task";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

header('Location: ../index.php');
exit();
