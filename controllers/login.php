<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';


$db = new Database();
$pdo = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $userModel = new User($pdo);
    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'level' => $user['level']
        ];

        if ($user['level'] === 'admin') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../views/home.php');
        }
        exit;
    } else {
        echo "<script>alert('Email atau Password salah');window.location='../views/login.php';</script>";
    }
}
