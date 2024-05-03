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
            padding: 10px;
            background: green;
            color: white;
            border-radius: 12px;
            float: right;
            cursor: pointer;

        }

        .add-task-btn>a {
            text-decoration: none;
            color: white;
        }

        .task-wrapper {
            margin-top: 100px;
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
            <?php include './components/menu.php'; ?>
        </div>

        <div class="add-task-btn">
            <a href="./add-task.php">+ Add new task</a>
        </div>

        <section class="task-wrapper">
            <div class="empty-task">
                You do not have any task!
            </div>

            <div>
                <?php include './components/task-list.php'; ?>
            </div>


        </section>


    </section>
</body>

</html>