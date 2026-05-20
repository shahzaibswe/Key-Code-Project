<?php
require_once '../config/db.php';
require_once '../includes/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = 'admin';
        $_SESSION['name'] = $user['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        // For development/initial setup, if no admin exists, create one with admin/admin
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'");
        if ($stmt->fetchColumn() == 0) {
            $hashed = password_hash('admin', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES ('Admin', 'admin@example.com', ?, 'admin')");
            $stmt->execute([$hashed]);
            $error = "Initial admin account created (admin@example.com / admin). Please try again.";
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<div class="card" style="max-width: 400px; margin: 0 auto;">
    <h2>Admin Login</h2>
    <?php if ($error): ?>
        <div style="color: var(--danger-color); margin-bottom: 1rem;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="email">Admin Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%; background: #1e293b;">Login as Admin</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
