<?php
// admin/dashboard.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Get Stats
$stats = [
    'total_students' => $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'student'")->fetchColumn(),
    'pending_approval' => $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'awaiting_approval'")->fetchColumn(),
    'active_interns' => $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'approved'")->fetchColumn(),
    'total_tasks' => $pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn(),
];

// Recent Submissions
$stmt = $pdo->query("SELECT s.*, u.name as student_name, t.title as task_title
                     FROM submissions s
                     JOIN users u ON s.student_id = u.id
                     JOIN tasks t ON s.task_id = t.id
                     ORDER BY s.submitted_at DESC LIMIT 5");
$recent_submissions = $stmt->fetchAll();
?>
<?php include '../includes/header.php'; ?>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="stats-grid">
            <div class="card">
                <h3>Total Students</h3>
                <p class="stat-num"><?php echo $stats['total_students']; ?></p>
            </div>
            <div class="card">
                <h3>Pending Approval</h3>
                <p class="stat-num"><?php echo $stats['pending_approval']; ?></p>
            </div>
            <div class="card">
                <h3>Active Interns</h3>
                <p class="stat-num"><?php echo $stats['active_interns']; ?></p>
            </div>
            <div class="card">
                <h3>Total Tasks</h3>
                <p class="stat-num"><?php echo $stats['total_tasks']; ?></p>
            </div>
        </div>

        <section class="recent-activity">
            <h2>Recent Submissions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_submissions as $sub): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sub['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($sub['task_title']); ?></td>
                        <td><?php echo ucfirst($sub['status']); ?></td>
                        <td><a href="review.php?id=<?php echo $sub['id']; ?>">Review</a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($recent_submissions)): ?>
                        <tr><td colspan="4">No recent submissions.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
        <div style="margin-top: 20px;">
            <a href="students.php" class="btn">Manage Students</a>
            <a href="tasks.php" class="btn btn-secondary">Manage Tasks</a>
        </div>
    </div>
<?php include '../includes/footer.php'; ?>
