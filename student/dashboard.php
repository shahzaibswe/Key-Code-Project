<?php
// student/dashboard.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Stats for Charts
$total_tasks = $pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
$stmt = $pdo->prepare("SELECT status, COUNT(*) as count FROM submissions WHERE student_id = ? GROUP BY status");
$stmt->execute([$_SESSION['user_id']]);
$submission_stats = $stmt->fetchAll();

$approved_count = 0;
$pending_count = 0;
$rejected_count = 0;

foreach ($submission_stats as $stat) {
    if ($stat['status'] === 'approved') $approved_count = $stat['count'];
    if ($stat['status'] === 'pending') $pending_count = $stat['count'];
    if ($stat['status'] === 'rejected') $rejected_count = $stat['count'];
}

$not_submitted = max(0, $total_tasks - ($approved_count + $pending_count + $rejected_count));
?>
<?php include '../includes/header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <main class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>

        <div class="dashboard-grid">
            <div class="card profile-info">
                <h3>Profile Info</h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
                <p><strong>Status:</strong> <span class="status-badge <?php echo $user['status']; ?>"><?php echo ucfirst($user['status']); ?></span></p>
            </div>

            <?php if ($user['status'] === 'approved'): ?>
                <div class="card">
                    <h3>Your Performance</h3>
                    <canvas id="performanceChart"></canvas>
                </div>
                <script>
                    const ctx = document.getElementById('performanceChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Approved', 'Pending', 'Rejected', 'Not Submitted'],
                            datasets: [{
                                data: [<?php echo "$approved_count, $pending_count, $rejected_count, $not_submitted"; ?>],
                                backgroundColor: ['#43a047', '#ffe082', '#e53935', '#ddd']
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });
                </script>
            <?php endif; ?>

            <?php if ($user['status'] === 'pending'): ?>
                <div class="card alert">
                    <h3>Complete Your Joining</h3>
                    <p>Please fill the joining form and upload your fee receipt to start your internship.</p>
                    <a href="joining_form.php" class="btn">Joining Form</a>
                </div>
            <?php elseif ($user['status'] === 'approved'): ?>
                <div class="card success">
                    <h3>Internship Details</h3>
                    <p><strong>Start Date:</strong> <?php echo $user['start_date']; ?></p>
                    <p><strong>End Date:</strong> <?php echo $user['end_date']; ?></p>
                    <p><strong>Instructions:</strong> <?php echo nl2br(htmlspecialchars($user['instructions'])); ?></p>
                    <a href="tasks.php" class="btn">View Tasks</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php include '../includes/footer.php'; ?>
