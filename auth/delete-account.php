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

        .update-btn {
            padding: 10px;
            text-align: center;
            margin-top: 12px;
            background: green;
            color: white;
            border-radius: 12px;
            cursor: pointer;
            width: 100%;
        }

        .cancel-btn {
            padding: 10px;
            text-align: center;
            margin-top: 12px;
            background: red;
            color: white;
            border-radius: 12px;
            cursor: pointer;
        }

        .cancel-btn>a {
            text-decoration: none;
            color: white;
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
        <h2>Delete Account</h2>

        <?php
        if (isset($_SESSION['status'])) {
            echo "<h3 style='color: green;'>" . $_SESSION['status'] . "</h3>";
            unset($_SESSION['status']);
        }
        ?>

        <form action="./controller/delete-logic.php" method="post" onsubmit="showLoading()">
            <label for="password">Password</label> <br>
            <input name="password" maxlength="15" type="password" placeholder="Enter your Password">
            <br>
            <button type="submit" class="update-btn" name="delete_btn" id="btn">Delete Account</button>

            <div class="cancel-btn">
                <a href="../profile.php">Cancel</a>
            </div>
        </form>
    </section>

    <script src=" ../js/app.js"></script>
</body>

</html>