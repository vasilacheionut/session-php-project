<?php
include 'auth.php';

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}
?>

<h2>Bine ai venit, <?= htmlspecialchars($_SESSION['auth']) ?>!</h2>
<p>Ai acces la această pagină protejată.</p>
<a href="logout.php">Logout</a>
