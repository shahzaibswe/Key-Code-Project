<?php
// register.php
require_once 'config/db.php';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, contact, password, role) VALUES (?, ?, ?, ?, 'student')");
        $stmt->execute([$name, $email, $contact, $password]);
        $success = "Registration successful! You can now <a href='login.php'>login</a>.";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $error = "Email already exists.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="auth-form">
    <h2>Student Registration</h2>
    <?php if ($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
    <?php if ($success): ?><p class="success"><?php echo $success; ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>
<?php include 'includes/footer.php'; ?>
