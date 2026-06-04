<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Helper to get relative base path
$base_path = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : './';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Portal</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Internship Portal</div>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="<?php echo $base_path; ?>admin/dashboard.php">Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $base_path; ?>student/dashboard.php">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo $base_path; ?>logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $base_path; ?>login.php">Student Login</a></li>
                    <li><a href="<?php echo $base_path; ?>admin/login.php">Admin Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
