<?php
require_once '../config/database.php';
require_once '../models/User.php';

$db = new Database();
$conn = $db->connect();

$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

    if ($user->register($username, $email, $password, $level)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = '../views/login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal.'); window.location.href = '../views/register.php';</script>";
    }
}
