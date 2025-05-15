<?php
session_start();

// Dacă deja ești autentificat, nu face nimic
if (!isset($_SESSION['auth']) && isset($_COOKIE['remember_me'])) {
    // căutăm emailul din cookie în lista de useri
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $_COOKIE['remember_me']) {
            $_SESSION['auth'] = $_COOKIE['remember_me'];
            break;
        }
    }
}
