 <?php
    include('../../private/dbconn.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../vendor/autoload.php';
    require_once '../../private/secret.php';

    function sendemail_verify($username, $email, $token)
    {
        global $pwd;
        $mail = new PHPMailer(true);

        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Username   = 'casmir293@gmail.com';
        $mail->Password   = $pwd;
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('casmir293@gmail.com', $username);
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verificatition from My Task Manager';
        $email_template = "
    <h2>You have Registered with My Task Manager</h2>
    <p>Verify your email address with the below link to enable your login access.</p>
    <br/><br/>
    <button><a href='http://localhost/task-manager/auth/controller/verify-email.php?token=$token'>Verify!</a></button>
    ";
        $mail->Body = $email_template;
        $mail->send();
        echo 'Message has been sent';
    }

    // validate input data
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST["register_btn"]) && !empty($username) && !empty($email) && !empty($password)) {
        $token = md5(rand());

        // Check if email or username exists, if they don't, register the user.
        $check_email_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);
        $check_username_query = "SELECT username FROM users WHERE username='$username' LIMIT 1";
        $check_username_query_run = mysqli_query($conn, $check_username_query);

        if (mysqli_num_rows($check_email_query_run) > 0) {
            $_SESSION['status'] = "Email already exists, use another email.";
            header("Location: ../register.php");
            exit(0);
        } else if (mysqli_num_rows($check_username_query_run) > 0) {
            $_SESSION['status'] = "Username already exists";
            header("Location: ../register.php");
            exit(0);
        } else {
            $query = "INSERT INTO users (username, email, password, token) VALUES ('$username', '$email', '$password', '$token')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                sendemail_verify("$username", "$email", "$token");
                $_SESSION['status'] = "Registration Successful! Please verify your email";
                header("Location: ../login.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Registration Failed!";
                header('Location: ../register.php');
                exit(0);
            }
        }
    } else {
        $_SESSION['status'] = "Fill all fields!";
        header("Location: ../register.php");
        exit(0);
    }

    mysqli_close($conn);
