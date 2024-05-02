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
            margin: 130px 60px;
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

        <form action="" method="post">
            <label for="username">Username</label> <br>
            <input name="username" maxlength="25" placeholder="Enter your Username">
            <br><br>
            <label for="password">Password</label> <br>
            <input name="password" type="password" maxlength="15" placeholder="Enter your password">
            <br>
            <p>Don't have an account? <a href="./register.php">Register</a></p>
            <br>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>

</html>