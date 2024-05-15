<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .task-wrap {
            border: 1px solid black;
            padding: 16px;
            border-radius: 12px;
            background: white;
            margin-bottom: 16px;
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .task-top>h3 {
            margin: 0px;
        }

        .task-subfooter {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .priority {
            font-weight: 900;
        }

        .date {
            display: flex;
            gap: 10px;
        }

        .date-label {
            font-weight: 900;
        }

        .empty-task {
            font-size: x-large;
            text-align: center;
        }

        .indicator {
            height: 13px;
            width: 13px;
            background: green;
            border-radius: 50%;
        }

        .completed {
            display: flex;
            gap: 4px;
            align-items: center;
            font-weight: 900;
            cursor: pointer;
        }

        .task-footer {
            display: flex;
            gap: 10px;
        }

        .foot-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .edit {
            color: green;
            cursor: pointer;
        }

        .delete {
            color: red;
            cursor: pointer;
        }

        .edited {
            color: gray;
        }
    </style>
</head>

<body>
    <?php
    require_once('./private/dbconn.php');

    $user_id = $_SESSION['auth_user']['id'];

    $all_tasks_query = "SELECT * FROM tasks WHERE user_id = '$user_id'";
    $all_tasks_query_run = mysqli_query($conn, $all_tasks_query);

    if ($all_tasks_query_run && mysqli_num_rows($all_tasks_query_run) > 0) {
        while ($task = mysqli_fetch_assoc($all_tasks_query_run)) {
    ?>

            <section class="task-wrap">
                <div class="task-top">
                    <h3><?= $task['title']; ?></h3>
                    <div class="priority"><?= $task['priority']; ?></div>
                </div>

                <div>
                    <?= $task['description']; ?>
                </div>

                <div class="task-subfooter">
                    <div class="date">
                        <div>
                            <div class="date-label">Start date</div>
                            <div><?= $task['start_date']; ?></div>
                        </div>
                        <div>
                            <div class="date-label">Due date</div>
                            <div><?= $task['due_date']; ?></div>
                        </div>
                    </div>
                    <div class="completed">
                        <div class="indicator"></div>
                        <div><?= $task['status']; ?></div>
                    </div>
                </div>

                <div class="foot-wrap">
                    <div class="task-footer">
                        <p class="edit"><a href="edit-task.php?id=<?= $task['id']; ?>">Edit</a></p>
                        <p class="delete"><a href="./controller/delete-task.php?id=<?= $task['id']; ?>">Delete</a></p>
                    </div>
                </div>
            </section>

        <?php
        }
    } else {
        ?>
        <div class="empty-task">
            You do not have any task!
        </div>
    <?php
    }
    mysqli_close($conn);
    ?>
</body>

</html>