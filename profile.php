<?php 
include 'header.php';

// Căutăm utilizatorul curent
$currentUser = null;
foreach ($_SESSION['users'] as &$user) {
    if ($user['email'] === $_SESSION['auth']) {
        $currentUser = &$user;
        break;
    }
}

// Actualizare profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = trim($_POST['name']);
    $newAvatar = trim($_POST['avatar']);
    if (!empty($newName)) $currentUser['name'] = $newName;
    if (!empty($newAvatar)) $currentUser['avatar'] = $newAvatar;
    $success = "Profilul a fost actualizat.";
}
?>

    <h1>👤 Profilul meu</h1>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>

    <p><strong>Email:</strong> <?= htmlspecialchars($currentUser['email']) ?></p>
    <p><strong>Nume:</strong> <?= htmlspecialchars($currentUser['name'] ?? 'Nesetat') ?></p>
    <p><strong>Rol:</strong> <?= htmlspecialchars($currentUser['role']) ?></p>
    <p><strong>Avatar:</strong><br>
        <?php if (!empty($currentUser['avatar'])): ?>
            <img src="<?= htmlspecialchars($currentUser['avatar']) ?>" alt="Avatar" width="100">
        <?php else: ?>
            (Fără avatar)
        <?php endif; ?>
    </p>

    <h3>✏️ Editează profilul</h3>
    <form method="POST">
        <label>
            Nume:<br>
            <input type="text" name="name" value="<?= htmlspecialchars($currentUser['name'] ?? '') ?>">
        </label><br><br>
        <label>
            Link Avatar (URL):<br>
            <input type="text" name="avatar" value="<?= htmlspecialchars($currentUser['avatar'] ?? '') ?>">
        </label><br><br>
        <button type="submit">💾 Salvează</button>
    </form>


<?php include 'footer.php'; ?>