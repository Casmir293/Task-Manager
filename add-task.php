<?php
require_once('./auth/controller/authentication.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .add-task-form {
            border: 1px solid gray;
            padding: 32px;
            border-radius: 12px;
        }

        .task-input,
        textarea {
            padding: 6px;
            border-radius: 12px;
            width: 100%;
        }

        .publish-task-btn {
            padding: 10px;
            text-align: center;
            margin-top: 12px;
            background: green;
            width: 100%;
            color: white;
            border-radius: 12px;
            cursor: pointer;
        }

        .cancel-task-btn {
            padding: 10px;
            text-align: center;
            margin-top: 12px;
            background: red;
            color: white;
            border-radius: 12px;
            cursor: pointer;
        }

        .cancel-task-btn>a {
            text-decoration: none;
            color: white;
        }

        h5 {
            margin: 5px 0px;
        }

        @media(min-width:768px) {
            h1 {
                text-align: center;
            }

            body {
                margin: 80px 150px;
            }
        }

        @media(min-width:1024px) {
            body {
                margin: 80px 450px;
            }

            .task-input,
            textarea {
                padding: 16px 6px;

            }
        }
    </style>
</head>

<body>
    <h1>⏰ My Task Manager</h1>

    <?php
    if (isset($_SESSION['status'])) {
        echo "<h3 style='color: green;'>" . $_SESSION['status'] . "</h3>";
        unset($_SESSION['status']);
    }
    ?>

    <section class="add-task-form">
        <form action="controller/addTask.php" method="post">
            <h5>Title</h5>
            <input class="task-input" placeholder="Enter task title" name="title" maxlength="80">
            <br><br>
            <h5>Description</h5>
            <textarea name="description" maxlength="300" rows="10" placeholder="Describe task"></textarea>
            <br><br>
            <h5>Start date</h5>
            <input class="task-input" type="date" name="start_date">
            <br><br>
            <h5>Due date</h5>
            <input class="task-input" type="date" name="due_date">
            <br><br>

            <h5>Priority</h5>
            <input type="radio" id="low" name="priority" value="low">
            <label for="low">low</label>
            <input type="radio" id="medium" name="priority" value="medium">
            <label for="medium">medium</label>
            <input type="radio" id="high" name="priority" value="high">
            <label for="high">high</label>
            <br>
            <br>

            <h5>Status</h5>
            <input type="radio" id="pending" name="status" value="pending">
            <label for="pending">Pending</label>
            <input type="radio" id="progress" name="status" value="progress">
            <label for="progress">In Progress</label>
            <input type="radio" id="completed" name="status" value="completed">
            <label for="completed">Completed</label>
            <br>
            <br>

            <button class="publish-task-btn" name="publish_task_btn" type="submit" id="btn">
                Publish
            </button>
        </form>

        <div class="cancel-task-btn">
            <a href="./index.php">Cancel</a>
        </div>
    </section>
    <script src="js/app.js"></script>
</body>

</html>