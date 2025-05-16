<?php
session_start();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email invalid.';
    }

    if (strlen($password) < 3) {
        $errors[] = 'Parola trebuie să aibă minim 3 caractere.';
    }

    // verificare existență
    foreach ($_SESSION['users'] ?? [] as $user) {
        if ($user['email'] === $email) {
            $errors[] = 'Email deja folosit.';
            break;
        }
    }

    if (empty($errors)) {
        $_SESSION['users'][] = [
            'email' => $email,
            'password' => $password,
            'role' => $role
        ];

        $_SESSION['logs'][] = [
            'email' => $email,
            'action' => 'Înregistrare cont',
            'time' => date('Y-m-d H:i:s')
        ];

        $_SESSION['auth'] = $email;
        header('Location: dashboard.php');
        exit;
    }
}
?>

<?php include 'public_header.php'; ?>

<div class="form-container">

<h1>Înregistrare</h1>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <?php foreach ($errors as $e) echo "<p>$e</p>"; ?>
    </div>
<?php endif; ?>

<form method="POST">
    <label>Email:<br>
        <input type="email" name="email" required>
    </label><br><br>

    <label>Parolă:<br>
        <input type="password" name="password" required>
    </label><br><br>

    <label>Rol:<br>
        <select name="role">
            <option value="user">Utilizator</option>
            <option value="admin">Administrator</option>
        </select>
    </label><br><br>

    <button type="submit">Înregistrează-te</button>
</form>

<p class="account">Ai deja cont? <a href="login.php">Autentificare</a></p>

</div>

<?php include 'public_footer.php'; ?>
