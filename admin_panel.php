<?php
include 'header.php';

// Verificăm dacă utilizatorul autentificat este administrator
$current_user = null;
foreach ($_SESSION['users'] as $u) {
    if ($u['email'] === $_SESSION['auth']) {
        $current_user = $u;
        break;
    }
}

if (!$current_user || $current_user['role'] !== 'admin') {
    echo "<p style='color:red;'>Acces interzis. Doar administratorii pot accesa această pagină.</p>";
    include 'footer.php';
    exit;
}
?>

<h1>Panou Administrator - Gestionare Utilizatori</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Email</th>
        <th>Rol</th>
        <th>Acțiuni</th>
    </tr>

    <?php foreach ($_SESSION['users'] as $index => $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
            <td>
                <?php if ($user['email'] !== $_SESSION['auth']): ?>
                    <form method="post" action="update_role.php" style="display:inline;">
                        <input type="hidden" name="user_index" value="<?= $index ?>">
                        <button type="submit" name="action" value="promote">Promovează</button>
                        <button type="submit" name="action" value="demote">Retrogradează</button>
                    </form>
                <?php else: ?>
                    <em>(Tu)</em>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
