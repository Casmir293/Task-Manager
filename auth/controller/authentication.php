<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to gain access";
    header('Location: ./auth/login.php');
    exit(0);
}
