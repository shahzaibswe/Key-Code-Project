<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$task_id = $_GET['task_id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id'])) {
    $sub_id = $_POST['review_id'];
    $status = 'reviewed';
    $feedback = $_POST['feedback'];
    $score = $_POST['score'];

    $stmt = $pdo->prepare("UPDATE submissions SET status = ?, feedback = ?, score = ? WHERE id = ?");
    $stmt->execute([$status, $feedback, $score, $sub_id]);
    $message = "Submission reviewed successfully!";
}

$query = "
    SELECT s.*, u.name as student_name, t.title as task_title
    FROM submissions s
    JOIN users u ON s.student_id = u.id
    JOIN tasks t ON s.task_id = t.id
";

if ($task_id) {
    $stmt = $pdo->prepare($query . " WHERE s.task_id = ? ORDER BY s.submitted_at DESC");
    $stmt->execute([$task_id]);
} else {
    $stmt = $pdo->query($query . " ORDER BY s.status ASC, s.submitted_at DESC");
}
$submissions = $stmt->fetchAll();
?>

<h1>Review Submissions</h1>
<?php if ($message): ?>
    <div style="color: var(--success-color); margin-bottom: 1rem;"><?php echo $message; ?></div>
<?php endif; ?>

<div class="grid" style="display: grid; gap: 20px;">
    <?php foreach ($submissions as $sub): ?>
        <div class="card" style="border-left: 5px solid <?php echo $sub['status'] == 'submitted' ? 'var(--danger-color)' : 'var(--success-color)'; ?>">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h3 style="margin-top: 0;"><?php echo htmlspecialchars($sub['student_name']); ?></h3>
                    <p><strong>Task:</strong> <?php echo htmlspecialchars($sub['task_title']); ?></p>
                    <p><strong>Submitted:</strong> <?php echo $sub['submitted_at']; ?></p>
                    <div style="background: #f1f5f9; padding: 10px; border-radius: 4px; margin: 10px 0;">
                        <strong>Content:</strong><br><?php echo nl2br(htmlspecialchars($sub['content'])); ?>
                        <?php if ($sub['file_path']): ?>
                            <br><a href="<?php echo '../' . $sub['file_path']; ?>" target="_blank" style="color: var(--primary-color);">View Attachment</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="min-width: 250px;">
                    <form method="POST">
                        <input type="hidden" name="review_id" value="<?php echo $sub['id']; ?>">
                        <div class="form-group">
                            <label>Score (0-100)</label>
                            <input type="number" name="score" class="form-control" value="<?php echo $sub['score']; ?>" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label>Feedback</label>
                            <textarea name="feedback" class="form-control" rows="2" required><?php echo htmlspecialchars($sub['feedback']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;"><?php echo $sub['status'] == 'reviewed' ? 'Update Review' : 'Submit Review'; ?></button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (!$submissions): ?>
        <p>No submissions found.</p>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
