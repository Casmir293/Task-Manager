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

        .date-label {
            font-weight: 900;
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
    <section class="task-wrap">
        <div class="task-top">
            <h3>Learn PHP</h3>
            <div class="priority">high</div>
        </div>

        <div>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque voluptatibus commodi delectus maxime ab quas quaerat sint dolore alias sed explicabo autem molestiae perferendis, libero, sequi laudantium nihil nisi atque?
        </div>

        <div class="task-subfooter">
            <div>
                <div class="date-label">Due date</div>
                <div>08/5/2024</div>
            </div>
            <div class="completed">
                <div class="indicator"></div>
                <div>Completed</div>
            </div>
        </div>

        <div class="foot-wrap">
            <div class="task-footer">
                <p class="edit">Edit</p>
                <p class="delete">Delete</p>
            </div>
            <div class="edited">Edited</div>
        </div>
    </section>
</body>

</html>