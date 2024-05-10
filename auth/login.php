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
            width: 50%;
            padding: 10px;
            border-radius: 16px;
            margin-top: 4px;
            float: right;
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
        <h2>Login</h2>

        <?php
        if (isset($_SESSION['status'])) {
            echo "<h3 style='color: green;'>" . $_SESSION['status'] . "</h3>";
            unset($_SESSION['status']);
        }
        ?>

        <form action="./controller/login-logic.php" method="post" onsubmit="showLoading()">
            <label for="username">Username</label> <br>
            <input name="login_username" maxlength="50" placeholder="Enter your Username">
            <br><br>
            <label for="password">Password</label> <br>
            <input name="login_password" type="password" maxlength="15" placeholder="Enter your password">
            <p><a href="./forgot-password.php">Forgot password?</a></p>
            <button type="submit" name="login_btn" id="btn">Submit</button>
            <br> <br> <br>
            <hr>
            <p>Did not receive email verification? <a href="./resend-email-verification.php">Resend</a></p>
            <p>Don't have an account? <a href="./register.php">Register</a></p>
            <br>
        </form>
    </section>

    <script src=" ../js/app.js"></script>
</body>

</html>