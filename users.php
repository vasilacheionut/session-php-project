<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Inițializare loguri
if (!isset($_SESSION['logs'])) {
    $_SESSION['logs'] = [];
}
