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

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 1px solid black;
            background: #fff;
            padding: 32px 0px;
            margin: 50px 5px;
            border-radius: 16px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 16px;
            margin-top: 4px;
        }

        button {
            width: 50%;
            padding: 10px;
            border-radius: 16px;
            margin-top: 4px;
            float: right;
        }

        p {
            font-size: 12px;
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


        @media(min-width:768px) {
            section {
                margin: 150px;
            }
        }
    </style>
</head>

<body>
    <div>
        <section>
            <h1>⏰ My Task Manager</h1>
            <?php include_once('./components/menu.php'); ?>
            <form action="" method="post">
                <label for="email">Email</label> <br>
                <input name="email" maxlength="25" placeholder="Enter your email" value="<?= $_SESSION['auth_user']['email']; ?>" disabled>
                <label for=" username">Username</label> <br>
                <input name="username" maxlength="25" placeholder="Enter your Username" value="<?= $_SESSION['auth_user']['username']; ?>" disabled>
                <br><br>
                <label for="old_password">Old Password</label> <br>
                <input name="old_password" type="password" maxlength="15" placeholder="Enter old password">
                <br><br>
                <label for="new_password">New Password</label> <br>
                <input name="new_password" type="password" maxlength="15" placeholder="Enter new password">
                <br><br>
                <div class="publish-task-btn">
                    Update
                </div>
                <div class="cancel-task-btn">
                    <a href="./index.php">Cancel</a>
                </div>
            </form>
        </section>
    </div>
</body>

</html>