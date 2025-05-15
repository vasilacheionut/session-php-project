<?php
session_start();

include 'users.php';

// Remember me
if (!isset($_SESSION['auth']) && isset($_COOKIE['remember_me'])) {
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $_COOKIE['remember_me']) {
            $_SESSION['auth'] = $user['email'];
            break;
        }
    }
}

// Logare automată a ultimei accesări
if (isset($_SESSION['auth'])) {
    $_SESSION['last_active'][$_SESSION['auth']] = date('Y-m-d H:i:s');

    $_SESSION['logs'][] = [
        'email' => $_SESSION['auth'],
        'action' => 'Accessed page: ' . $_SERVER['PHP_SELF'],
        'time' => date('Y-m-d H:i:s')
    ];
}
