<?php
// student/tasks.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$today = date('Y-m-d');

// Fetch all tasks
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY unlock_date ASC");
$tasks = $stmt->fetchAll();

// Fetch student submissions
$stmt = $pdo->prepare("SELECT * FROM submissions WHERE student_id = ?");
$stmt->execute([$student_id]);
$submissions = [];
foreach ($stmt->fetchAll() as $sub) {
    $submissions[$sub['task_id']] = $sub;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_task'])) {
    $task_id = $_POST['task_id'];
    $text = $_POST['submission_text'];
    $link = $_POST['submission_link'];

    // Check if already submitted
    if (isset($submissions[$task_id])) {
        $stmt = $pdo->prepare("UPDATE submissions SET submission_text = ?, submission_link = ?, status = 'pending' WHERE student_id = ? AND task_id = ?");
        $stmt->execute([$text, $link, $student_id, $task_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO submissions (student_id, task_id, submission_text, submission_link) VALUES (?, ?, ?, ?)");
        $stmt->execute([$student_id, $task_id, $text, $link]);
    }
    header("Location: tasks.php?success=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Tasks</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Internship Tasks</h1>
        <?php if (isset($_GET['success'])): ?><p class="success">Task submitted successfully!</p><?php endif; ?>

        <div class="task-grid">
            <?php foreach ($tasks as $task): ?>
                <?php
                $is_locked = $today < $task['unlock_date'];
                $submission = $submissions[$task['id']] ?? null;
                ?>
                <div class="card task-card <?php echo $is_locked ? 'locked' : ''; ?>">
                    <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
                    <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>

                    <?php if ($is_locked): ?>
                        <p class="lock-msg">Locked until <?php echo $task['unlock_date']; ?></p>
                    <?php else: ?>
                        <?php if ($submission): ?>
                            <div class="submission-status">
                                <p>Status: <span class="status-badge <?php echo $submission['status']; ?>"><?php echo ucfirst($submission['status']); ?></span></p>
                                <?php if ($submission['feedback']): ?>
                                    <p><strong>Feedback:</strong> <?php echo htmlspecialchars($submission['feedback']); ?></p>
                                    <p><strong>Marks:</strong> <?php echo $submission['marks']; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <button onclick="document.getElementById('task-modal-<?php echo $task['id']; ?>').style.display='block'" class="btn">
                            <?php echo $submission ? 'Edit Submission' : 'Submit Task'; ?>
                        </button>

                        <div id="task-modal-<?php echo $task['id']; ?>" class="modal" style="display:none;">
                            <div class="modal-content">
                                <h3>Submit: <?php echo htmlspecialchars($task['title']); ?></h3>
                                <form method="POST">
                                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                    <div class="form-group">
                                        <label>Submission Text / Description</label>
                                        <textarea name="submission_text" required><?php echo $submission['submission_text'] ?? ''; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Project Link (GitHub/Drive)</label>
                                        <input type="url" name="submission_link" value="<?php echo $submission['submission_link'] ?? ''; ?>" required>
                                    </div>
                                    <button type="submit" name="submit_task" class="btn">Submit</button>
                                    <button type="button" onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="btn-secondary">Cancel</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
