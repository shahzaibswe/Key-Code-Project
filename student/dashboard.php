<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Fetch joined internships
$stmt = $pdo->prepare("
    SELECT i.*, si.status
    FROM internships i
    JOIN student_internships si ON i.id = si.internship_id
    WHERE si.student_id = ?
");
$stmt->execute([$student_id]);
$my_internships = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch pending tasks
$stmt = $pdo->prepare("
    SELECT t.*, i.title as internship_title
    FROM tasks t
    JOIN student_internships si ON t.internship_id = si.internship_id
    JOIN internships i ON t.internship_id = i.id
    LEFT JOIN submissions s ON t.id = s.task_id AND s.student_id = ?
    WHERE si.student_id = ? AND s.id IS NULL
");
$stmt->execute([$student_id, $student_id]);
$pending_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Data for Chart.js (Submission Status)
$stmt = $pdo->prepare("
    SELECT status, COUNT(*) as count
    FROM submissions
    WHERE student_id = ?
    GROUP BY status
");
$stmt->execute([$student_id]);
$submission_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stats_labels = [];
$stats_data = [];
foreach ($submission_stats as $stat) {
    $stats_labels[] = ucfirst($stat['status']);
    $stats_data[] = $stat['count'];
}
?>

<div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <a href="join_internship.php" class="btn btn-primary">Browse Internships</a>
</div>

<div class="grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <div class="left-col">
        <section class="card">
            <h3>My Internships</h3>
            <?php if ($my_internships): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid #e2e8f0; text-align: left;">
                            <th style="padding: 10px;">Program</th>
                            <th style="padding: 10px;">Status</th>
                            <th style="padding: 10px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($my_internships as $intern): ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 10px;"><?php echo htmlspecialchars($intern['title']); ?></td>
                                <td style="padding: 10px;"><span class="badge" style="padding: 2px 8px; border-radius: 10px; background: #dcfce7; color: #166534;"><?php echo ucfirst($intern['status']); ?></span></td>
                                <td style="padding: 10px;"><a href="tasks.php?internship_id=<?php echo $intern['id']; ?>">View Tasks</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You haven't joined any internships yet.</p>
            <?php endif; ?>
        </section>

        <section class="card">
            <h3>Pending Tasks</h3>
            <?php if ($pending_tasks): ?>
                <ul style="list-style: none; padding: 0;">
                    <?php foreach ($pending_tasks as $task): ?>
                        <li style="padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <strong style="display: block;"><?php echo htmlspecialchars($task['title']); ?></strong>
                                <small style="color: #64748b;"><?php echo htmlspecialchars($task['internship_title']); ?> • Due: <?php echo $task['deadline']; ?></small>
                            </div>
                            <a href="submit_task.php?task_id=<?php echo $task['id']; ?>" class="btn btn-primary">Submit</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No pending tasks! Good job.</p>
            <?php endif; ?>
        </section>
    </div>

    <div class="right-col">
        <section class="card">
            <h3>Performance</h3>
            <canvas id="performanceChart"></canvas>
        </section>
    </div>
</div>

<script>
const ctx = document.getElementById('performanceChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($stats_labels); ?>,
        datasets: [{
            label: 'Submissions',
            data: <?php echo json_encode($stats_data); ?>,
            backgroundColor: ['#2563eb', '#22c55e', '#ef4444'],
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

<?php require_once '../includes/footer.php'; ?>
