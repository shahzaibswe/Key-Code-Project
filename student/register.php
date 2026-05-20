<?php
require_once '../config/db.php';
require_once '../includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'student')");
        $stmt->execute([$name, $email, $password]);
        $success = "Registration successful! You can now <a href='login.php'>login</a>.";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000 || strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
            $error = "Email already exists.";
        } else {
            $error = "An error occurred. Please try again.";
        }
    }
}
?>

<div class="card" style="max-width: 400px; margin: 0 auto;">
    <h2>Student Registration</h2>
    <?php if ($error): ?>
        <div style="color: var(--danger-color); margin-bottom: 1rem;"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div style="color: var(--success-color); margin-bottom: 1rem;"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
    </form>
    <p style="margin-top: 1rem; text-align: center;">Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php require_once '../includes/footer.php'; ?>
