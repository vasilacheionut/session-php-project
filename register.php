<?php
session_start();
include 'users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            echo "Email deja folosit.";
            exit;
        }
    }

    if ($email === 'root@admin.com') {
        $_SESSION['users'][] = [
            'email' => $email,
            'password' => $password,
            'role' => 'admin'
        ];    
    } else {
        $_SESSION['users'][] = [
            'email' => $email,
            'password' => $password,
            'role' => 'user'
        ];    
    }


    echo "Cont creat cu succes. <a href='login.php'>Login</a>";
    exit;
}
?>

<h2>Înregistrare</h2>
<form method="post">
    <input type="email" name="email" required placeholder="Email"><br>
    <input type="password" name="password" required placeholder="Parolă"><br>
    <button type="submit">Înregistrare</button>
</form>
