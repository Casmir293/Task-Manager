<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "Logout successful";
header("Location: ../login.php");
