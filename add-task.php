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

    <section class="add-task-form">
        <form action="">
            <h5>Title</h5>
            <input class="task-input" placeholder="Enter task title" name="title" maxlength="80">
            <br><br>
            <h5>Description</h5>
            <textarea name="description" maxlength="300" rows="10" placeholder="Describe task"></textarea>
            <br><br>
            <h5>Due date</h5>
            <input class="task-input" type="date" name="date" id="">
            <br><br>

            <h5>Priority</h5>
            <input type="radio" id="low" name="priority" value="low">
            <label for="low">low</label>
            <input type="radio" id="medium" name="priority" value="medium">
            <label for="medium">medium</label>
            <input type="radio" id="high" name="priority" value="high">
            <label for="high">high</label>
        </form>

        <div class="publish-task-btn">
            Publish
        </div>

        <div class="cancel-task-btn">
            <a href="./index.php">Cancel</a>
        </div>
    </section>
</body>

</html>