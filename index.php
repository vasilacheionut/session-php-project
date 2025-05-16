<?php 
include 'header.php';

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

<?php
return require_once "print_session.php";
?>

<?php include 'footer.php'; ?>