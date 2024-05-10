<?php
session_start();
require_once('./controller/auth.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Task Manager</title>
    <style>
        section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: #bbb;
            padding: 32px 0px;
            margin: 50px 40px;
            border-radius: 16px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 16px;
            margin-top: 4px;
        }

        button {
            width: 80%;
            padding: 10px;
            border-radius: 16px;
            margin-top: 4px;
            float: right;
            cursor: pointer;
        }

        p {
            font-size: 12px;
        }

        @media(min-width:768px) {
            section {
                margin: 150px;
            }
        }
    </style>
</head>

<body>
    <section>
        <h1>⏰ My Task Manager</h1>
        <h2>Reset Password</h2>

        <?php
        if (isset($_SESSION['status'])) {
            echo "<h3 style='color: green;'>" . $_SESSION['status'] . "</h3>";
            unset($_SESSION['status']);
        }
        ?>

        <form action="./controller/forgot-password-logic.php" method="post" onsubmit="showLoading()">
            <input type="hidden" name="password_token" value="<?php if (isset($_GET['token'])) {
                                                                    echo $_GET['token'];
                                                                } ?>">

            <label for="email">Email Address</label> <br>
            <input name="email" type="hidden" maxlength="50" value="<?php if (isset($_GET['email'])) {
                                                                        echo $_GET['email'];
                                                                    } ?>" placeholder="Enter your Email">
            <input name="email" maxlength="50" value="<?php if (isset($_GET['email'])) {
                                                            echo $_GET['email'];
                                                        } ?>" placeholder="Enter your Email" disabled>
            <br>
            <br>
            <label for="email">New Password</label> <br>
            <input name="new_password" maxlength="15" type="password" placeholder="Enter your new password">
            <br>
            <br>
            <button type="submit" name="update_pwd_btn" id="btn">Update Password</button>
        </form>
    </section>

    <script src=" ../js/app.js"></script>
</body>

</html>