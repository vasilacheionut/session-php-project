<?php 
include 'header.php';

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

echo "<h2>Log activitate - " . htmlspecialchars($_SESSION['auth']) . "</h2>";

foreach ($_SESSION['logs'] as $log) {
    if ($log['email'] === $_SESSION['auth']) {
        echo "[" . $log['time'] . "] - " . $log['action'] . "<br>";
    }
}
echo "<br><a href='dashboard.php'>Înapoi</a>";

return require_once "print_session.php";

include 'footer.php'; 