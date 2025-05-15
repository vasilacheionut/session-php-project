<?php
session_start();
include 'users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            echo "Email deja folosit. <a href='register.php'>Încearcă altul</a>";
            exit;
        }
    }

    $_SESSION['users'][] = [
        'email' => $email,
        'password' => $password // în realitate folosește hash!
    ];

    echo "Înregistrare reușită. <a href='login.php'>Mergi la login</a>";
    exit;
}
?>

<h2>Înregistrare</h2>
<form method="post">
    <input type="email" name="email" required placeholder="Email"><br>
    <input type="password" name="password" required placeholder="Parolă"><br>
    <button type="submit">Înregistrare</button>
</form>
<a href="login.php">Ai deja cont?</a>
