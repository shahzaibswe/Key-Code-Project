<?php
// index.php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: student/dashboard.php");
    }
    exit();
}
?>
<?php include 'includes/header.php'; ?>
<section class="hero">
    <h1>Welcome to the Internship Portal</h1>
    <p>Kickstart your career with our structured internship programs.</p>
    <div class="cta-buttons">
        <a href="register.php" class="btn">Register as Student</a>
        <a href="login.php" class="btn btn-secondary">Student Login</a>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
