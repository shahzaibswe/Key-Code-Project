<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$internship_id = $_GET['internship_id'] ?? null;
$student_id = $_SESSION['user_id'];

if (!$internship_id) {
    header("Location: dashboard.php");
    exit;
}

// Fetch internship details
$stmt = $pdo->prepare("SELECT * FROM internships WHERE id = ?");
$stmt->execute([$internship_id]);
$internship = $stmt->fetch();

// Fetch tasks for this internship and check if student has submitted them
$stmt = $pdo->prepare("
    SELECT t.*, s.status as submission_status, s.score, s.feedback
    FROM tasks t
    LEFT JOIN submissions s ON t.id = s.task_id AND s.student_id = ?
    WHERE t.internship_id = ?
");
$stmt->execute([$student_id, $internship_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div style="margin-bottom: 2rem;">
    <h1>Tasks: <?php echo htmlspecialchars($internship['title']); ?></h1>
    <p><?php echo htmlspecialchars($internship['company']); ?></p>
</div>

<div class="grid" style="display: grid; gap: 20px;">
    <?php if ($tasks): ?>
        <?php foreach ($tasks as $task): ?>
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="margin-top: 0;"><?php echo htmlspecialchars($task['title']); ?></h3>
                        <p><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
                        <small style="color: #64748b;">Deadline: <?php echo $task['deadline']; ?></small>
                    </div>
                    <div>
                        <?php if ($task['submission_status']): ?>
                            <span class="badge" style="padding: 4px 12px; border-radius: 12px; background: #dcfce7; color: #166534;">
                                <?php echo ucfirst($task['submission_status']); ?>
                            </span>
                            <?php if ($task['score']): ?>
                                <div style="margin-top: 10px; font-weight: bold; text-align: right;">Score: <?php echo $task['score']; ?>/100</div>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="submit_task.php?task_id=<?php echo $task['id']; ?>" class="btn btn-primary">Submit Now</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($task['feedback']): ?>
                    <div style="margin-top: 15px; padding: 10px; background: #f8fafc; border-left: 4px solid var(--primary-color);">
                        <strong>Feedback:</strong><br>
                        <?php echo nl2br(htmlspecialchars($task['feedback'])); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tasks assigned for this internship yet.</p>
    <?php endif; ?>
</div>

<div style="margin-top: 2rem;">
    <a href="dashboard.php" style="text-decoration: none; color: var(--primary-color);">← Back to Dashboard</a>
</div>

<?php require_once '../includes/footer.php'; ?>
