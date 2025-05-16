<?php
include 'header.php';

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current'] ?? '';
    $new = $_POST['new'] ?? '';
    $changed = false;

    foreach ($_SESSION['users'] as &$user) {
        if ($user['email'] === $_SESSION['auth'] && $user['password'] === $current) {
            $user['password'] = $new;
            $changed = true;

            $_SESSION['logs'][] = [
                'email' => $_SESSION['auth'],
                'action' => 'Schimbare parolă',
                'time' => date('Y-m-d H:i:s')
            ];

            break;
        }
    }

    echo $changed ? "Parolă schimbată cu succes. <a href='dashboard.php'>Înapoi</a>" :
        "Parolă curentă greșită. <a href='change_password.php'>Încearcă din nou</a>";
    exit;
}
?>

<div class="form-container">
    <h2>Schimbă parola</h2>
    <form method="post">
        <label>Parola actuală:<br>
            <input type="password" name="current" required placeholder="Parola actuală"><br>
        </label><br><br>

        <label>Noua parolă:<br>
            <input type="password" name="new" required placeholder="Noua parolă"><br>
        </label><br><br>

        <button type="submit">Salvează</button>
    </form>
</div>

<?php
require_once "print_session.php";
?>
<?php include 'footer.php'; ?>