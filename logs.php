<?php
include 'auth.php';

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

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

$isAdmin = $currentUser['role'] === 'admin';
$logs = $_SESSION['logs'] ?? [];

// 🔽 Export loguri
if (isset($_POST['export'])) {
    $exportLogs = array_filter($logs, function($log) use ($isAdmin, $currentEmail) {
        return $isAdmin || $log['email'] === $currentEmail;
    });

    $content = "Jurnal de activitate - export\n\n";
    foreach ($exportLogs as $log) {
        $content .= "[{$log['time']}] {$log['email']} - {$log['action']}\n";
    }

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="logs_export.txt"');
    header('Content-Length: ' . strlen($content));
    echo $content;
    exit;
}

// 🔽 Șterge toate logurile (doar admin)
if (isset($_POST['clear_logs']) && $isAdmin) {
    $_SESSION['logs'][] = [
        'email' => $currentEmail,
        'action' => 'ȘTERGEREA TUTUROR LOGURILOR',
        'time' => date('Y-m-d H:i:s')
    ];

    // Păstrăm doar logul care anunță ștergerea
    $_SESSION['logs'] = [end($_SESSION['logs'])];

    header('Location: logs.php');
    exit;
}
?>

<h2>Jurnal activitate - <?= $isAdmin ? 'Toți utilizatorii' : 'Activitatea ta' ?></h2>

<form method="post" style="margin-bottom: 15px; display: inline;">
    <button type="submit" name="export">📥 Exportă loguri</button>
</form>

<?php if ($isAdmin): ?>
    <form method="post" style="margin-bottom: 15px; display: inline;" onsubmit="return confirm('Sigur vrei să ștergi toate logurile?');">
        <button type="submit" name="clear_logs">🗑️ Șterge toate logurile</button>
    </form>
<?php endif; ?>

<table border="1" cellpadding="5">
    <tr>
        <th>Email</th>
        <th>Acțiune</th>
        <th>Data/Ora</th>
    </tr>

    <?php foreach ($logs as $log): ?>
        <?php if ($isAdmin || $log['email'] === $currentEmail): ?>
            <tr>
                <td><?= htmlspecialchars($log['email']) ?></td>
                <td><?= htmlspecialchars($log['action']) ?></td>
                <td><?= $log['time'] ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<br>
<a href="dashboard.php">Înapoi la dashboard</a>
