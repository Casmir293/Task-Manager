<?php
require_once('./auth/controller/authentication.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <style>
        nav {
            display: flex;
            gap: 16px;
        }

        nav>p>a {
            font-size: large;
            font-weight: bold;
        }

        body {
            background-color: whitesmoke;
        }

        .wrapper {
            padding: 12px;
        }

        .add-task-btn {
            display: flex;
            justify-content: space-between;
        }

        .add-task-btn>p>a {
            text-decoration: none;
            color: white;
            background: green;
            padding: 6px 8px;
            border-radius: 12px;
        }

        .task-wrapper {
            margin-top: 10px;
        }

        .empty-task {
            font-size: x-large;
            text-align: center;
        }

        @media(min-width:768px) {
            .wrapper {
                margin: 150px;
                background-color: white;
                border-radius: 12px;
                padding: 20px 50px;
            }

            h1 {
                text-align: center;
            }

            nav {
                justify-content: center;
                margin-bottom: 20px;
            }
        }

        @media(min-width:1024px) {
            .wrapper {
                margin: 150px 350px;
                padding: 20px 250px;
            }
        }
    </style>
</head>

<body>
    <section class="wrapper">
        <h1>⏰ My Task Manager</h1>

        <div>
            <?php include_once('./components/menu.php'); ?>
        </div>

        <div class="add-task-btn">
            <h3>Hello <?= $_SESSION['auth_user']['username']; ?>!</h3>
            <p><a href="./add-task.php">+ Add new task</a></p>
        </div>

        <section class="task-wrapper">
            <div class="empty-task">
                You do not have any task!
            </div>

            <div>
                <?php include_once('./components/task-list.php'); ?>
            </div>
        </section>
    </section>
</body>

</html>