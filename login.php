<?php
session_start();
include 'users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['auth'] = $email;

            if ($remember) {
                setcookie('remember_me', $email, time() + (86400 * 7), "/"); // 7 zile
            }

            header('Location: dashboard.php');
            exit;
        }
    }

    echo "Email sau parolă greșită.";
}
?>

<h2>Login</h2>
<form method="post">
    <input type="email" name="email" required placeholder="Email"><br>
    <input type="password" name="password" required placeholder="Parolă"><br>
    <label>
        <input type="checkbox" name="remember"> Ține-mă minte
    </label><br>
    <button type="submit">Login</button>
</form>
<a href="register.php">Nu ai cont?</a>

