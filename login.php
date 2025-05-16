<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $_SESSION['auth'] = $email;

                // remember me
                if (isset($_POST['remember'])) {
                    setcookie('remember_me', $email, time() + (86400 * 7), "/");
                }

                $_SESSION['logs'][] = [
                    'email' => $email,
                    'action' => 'Autentificare cu succes',
                    'time' => date('Y-m-d H:i:s')
                ];

                header('Location: dashboard.php');
                exit;
            }
        }
    }

    $errors[] = 'Email sau parolă incorecte.';
}
?>

<?php include 'public_header.php'; ?>

<div class="form-container">
<h1>Login</h1>

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

    <label>
        <input type="checkbox" name="remember"> Ține-mă minte
    </label><br><br>

    <button type="submit">Autentificare</button>
</form>

<p>Nu ai cont? <a href="register.php">Înregistrează-te</a></p>

</div>

<?php include 'public_footer.php'; ?>
