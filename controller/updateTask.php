<?php
session_start();
require_once('../private/dbconn.php');

if (isset($_POST['update_task_btn'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $priority = mysqli_real_escape_string($conn, $_POST['priority']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $task_id = $_GET['id'];

    if (
        !empty($title) &&
        !empty($description) &&
        !empty($start_date) &&
        !empty($due_date) &&
        !empty($priority) &&
        !empty($status)
    ) {
        $update_task = "UPDATE tasks SET title = '$title', description = '$description', start_date = '$start_date', due_date = '$due_date', priority = '$priority', status = '$status' WHERE id = '$task_id'";

        $update_task_run = mysqli_query($conn, $update_task);

        if ($update_task_run) {
            $_SESSION['status'] = "Task updated successfully";
            header("Location: ../index.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Updating Task Failed!";
            header('Location: ../add-task.php');
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Fill all fields";
        header("Location: ../edit-task.php?id=$task_id");
        exit(0);
    }
}

mysqli_close($conn);
