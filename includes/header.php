<?php
session_start();
// Calculate base path for reliable links
$current_dir = str_replace('\\', '/', dirname($_SERVER['PHP_SELF']));
$root_dir = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$request_uri = str_replace('\\', '/', $_SERVER['REQUEST_URI']);

// Simple base path detection
$base_path = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/student/') !== false) ? '../' : './';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Portal</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="<?php echo $base_path; ?>index.php" class="logo">InternPortal</a>
            <ul class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="<?php echo $base_path; ?>admin/dashboard.php">Admin Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $base_path; ?>student/dashboard.php">Dashboard</a></li>
                        <li><a href="<?php echo $base_path; ?>student/profile.php">Profile</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo $base_path; ?><?php echo $_SESSION['role']; ?>/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $base_path; ?>student/login.php">Student Login</a></li>
                    <li><a href="<?php echo $base_path; ?>admin/login.php">Admin Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <main class="container">
