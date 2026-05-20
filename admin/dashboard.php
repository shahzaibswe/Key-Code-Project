<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Stats
$total_students = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'student'")->fetchColumn();
$total_internships = $pdo->query("SELECT COUNT(*) FROM internships")->fetchColumn();
$pending_submissions = $pdo->query("SELECT COUNT(*) FROM submissions WHERE status = 'submitted'")->fetchColumn();
?>

<h1>Admin Dashboard</h1>

<div class="grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 2rem;">
    <div class="card" style="text-align: center;">
        <h2 style="margin: 0; font-size: 2.5rem; color: var(--primary-color);"><?php echo $total_students; ?></h2>
        <p style="color: #64748b;">Total Students</p>
    </div>
    <div class="card" style="text-align: center;">
        <h2 style="margin: 0; font-size: 2.5rem; color: var(--success-color);"><?php echo $total_internships; ?></h2>
        <p style="color: #64748b;">Programs</p>
    </div>
    <div class="card" style="text-align: center;">
        <h2 style="margin: 0; font-size: 2.5rem; color: var(--danger-color);"><?php echo $pending_submissions; ?></h2>
        <p style="color: #64748b;">Pending Submissions</p>
    </div>
</div>

<div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="card">
        <h3>Quick Actions</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 10px;"><a href="manage_internships.php" class="btn btn-primary" style="width: 80%; text-align: center;">Manage Internships</a></li>
            <li style="margin-bottom: 10px;"><a href="manage_tasks.php" class="btn" style="width: 80%; text-align: center; background: #64748b; color: white;">Manage Tasks</a></li>
            <li style="margin-bottom: 10px;"><a href="review_submissions.php" class="btn" style="width: 80%; text-align: center; background: #22c55e; color: white;">Review Submissions</a></li>
        </ul>
    </div>

    <div class="card">
        <h3>System Info</h3>
        <p>Current Time: <?php echo date('Y-m-d H:i:s'); ?></p>
        <p>Database: SQLite (Cross-compatible PDO)</p>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
