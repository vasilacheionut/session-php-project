<?php

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

// Obține utilizatorul curent
$currentEmail = $_SESSION['auth'];
$currentUser = null;

foreach ($_SESSION['users'] as $user) {
    if ($user['email'] === $currentEmail) {
        $currentUser = $user;
        break;
    }
}

if (!$currentUser) {
    echo "Utilizator invalid.";
    exit;
}

$role = $currentUser['role'];
?>

<h2>Bine ai venit, <?= htmlspecialchars($currentEmail) ?>!</h2>
<p>Rol: <strong><?= $role === 'admin' ? 'Administrator' : 'Utilizator' ?></strong></p>

<ul style="list-style: none; padding: 0;">
    <li><a href="index.php">🏠 Acasă</a></li>
    <li><a href="login.php">🔐 Autentificare</a></li>
    <li><a href="register.php">🧾 Înregistrare</a></li>
</ul>
<hr>
<ul style="list-style: none; padding: 0;">
    <?php if (isset($_SESSION['auth'])): ?>
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="logs.php">📜 Loguri</a></li>
        <li><a href="activity_log.php">📊 Vezi activitatea</a></li>
        <li><a href="change_password.php">🔁 Schimbare parolă</a></li>
        <li><a href="profile.php">👤 Profil</a></li>
        <?php
        // Verificăm dacă utilizatorul e admin
        foreach ($_SESSION['users'] as $u) {
            if ($u['email'] === $_SESSION['auth'] && $u['role'] === 'admin') {
                echo '<li><a href="admin_panel.php">⚙️ Panou Admin</a></li>';
                break;
            }
        }
        ?>
        <li><a href="logout.php">🚪 Deconectare</a></li>
    <?php else: ?>
        <li><a href="login.php">🔐 Autentificare</a></li>
        <li><a href="register.php">🧾 Înregistrare</a></li>
    <?php endif; ?>
</ul>