<?php
session_start();
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
            <label for="email">Email Address</label> <br>
            <input name="email" maxlength="25" placeholder="Enter your Email">
            <br>
            <br>
            <label for="email">New Password</label> <br>
            <input name="password" maxlength="15" placeholder="Enter your new password">
            <br>
            <br>
            <button type="submit" name="submit_btn" id="btn">Update Password</button>
        </form>
    </section>

    <script src=" ../js/app.js"></script>
</body>

</html>