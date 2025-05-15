<?php
include 'auth.php';

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

$loggedUser = null;
foreach ($_SESSION['users'] as $user) {
    if ($user['email'] === $_SESSION['auth']) {
        $loggedUser = $user;
        break;
    }
}

?>

<h2>Bun venit, <?= htmlspecialchars($_SESSION['auth']) ?></h2>
<p>Rol: <?= $loggedUser['role'] ?></p>
<p>Ultima activitate: <?= $_SESSION['last_active'][$_SESSION['auth']] ?? 'N/A' ?></p>
<ul>
    <li><a href="change_password.php">Schimbă parola</a></li>
    <li><a href="activity_log.php">Vezi activitatea</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
