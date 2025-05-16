<?php
session_start();

if (!isset($_SESSION['auth']) || !isset($_SESSION['users'])) {
    header('Location: login.php');
    exit;
}

// Verificăm dacă userul actual este admin
$current_user = null;
foreach ($_SESSION['users'] as $u) {
    if ($u['email'] === $_SESSION['auth']) {
        $current_user = $u;
        break;
    }
}

if (!$current_user || $current_user['role'] !== 'admin') {
    echo "Acces interzis.";
    exit;
}

// Preluăm indexul utilizatorului care urmează a fi modificat
if (isset($_POST['user_index'], $_POST['action'])) {
    $i = (int) $_POST['user_index'];
    $action = $_POST['action'];

    if (isset($_SESSION['users'][$i])) {
        $target = &$_SESSION['users'][$i]; // referință

        if ($action === 'promote') {
            $target['role'] = 'admin';
        } elseif ($action === 'demote') {
            $target['role'] = 'user';
        }

        $_SESSION['logs'][] = [
            'email' => $_SESSION['auth'],
            'action' => "A modificat rolul utilizatorului {$target['email']} la {$target['role']}",
            'time' => date('Y-m-d H:i:s')
        ];
    }
}

header('Location: admin_panel.php');
exit;
