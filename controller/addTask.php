<?php
session_start();
require_once('../private/dbconn.php');

if (isset($_POST['publish_task_btn'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $priority = mysqli_real_escape_string($conn, $_POST['priority']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $user_id = $_SESSION['auth_user']['id'];

    if (
        !empty($title) &&
        !empty($description) &&
        !empty($start_date) &&
        !empty($due_date) &&
        !empty($priority) &&
        !empty($status)
    ) {
        $insert_task = "INSERT INTO tasks (user_id, title, description, start_date, due_date, priority, status) VALUES ('$user_id', '$title', '$description', '$start_date', '$due_date', '$priority', '$status')";
        $insert_task_run = mysqli_query($conn, $insert_task);

        if ($insert_task_run) {
            $_SESSION['status'] = "Task added successfully";
            header("Location: ../index.php");
            exit(0);
        } else {
            $_SESSION['status'] = "There was a problem adding task";
            header('Location: ../add-task.php');
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Fill all fields";
        header('Location: ../add-task.php');
        exit(0);
    }
}

mysqli_close($conn);
