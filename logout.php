<?php
session_start();
session_destroy();

// Șterge cookie-ul "remember_me"
setcookie('remember_me', '', time() - 3600, "/");

header('Location: login.php');
exit;
