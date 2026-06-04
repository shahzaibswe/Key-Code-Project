<?php
// admin/review.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$submission_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT s.*, u.name as student_name, t.title as task_title
                     FROM submissions s
                     JOIN users u ON s.student_id = u.id
                     JOIN tasks t ON s.task_id = t.id
                     WHERE s.id = ?");
$stmt->execute([$submission_id]);
$submission = $stmt->fetch();

if (!$submission) {
    die("Submission not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $marks = $_POST['marks'];
    $feedback = $_POST['feedback'];

    $stmt = $pdo->prepare("UPDATE submissions SET status = ?, marks = ?, feedback = ? WHERE id = ?");
    $stmt->execute([$status, $marks, $feedback, $submission_id]);
    header("Location: dashboard.php");
    exit();
}
?>
<?php include (strpos($_SERVER["PHP_SELF"], "/admin/") !== false || strpos($_SERVER["PHP_SELF"], "/student/") !== false ? "../includes/header.php" : "includes/header.php"); ?>
    <div class="container">
        <h1>Review Submission</h1>
        <div class="card">
            <h3><?php echo htmlspecialchars($submission['task_title']); ?> by <?php echo htmlspecialchars($submission['student_name']); ?></h3>
            <p><strong>Text:</strong> <?php echo nl2br(htmlspecialchars($submission['submission_text'])); ?></p>
            <p><strong>Link:</strong> <a href="<?php echo htmlspecialchars($submission['submission_link']); ?>" target="_blank"><?php echo htmlspecialchars($submission['submission_link']); ?></a></p>

            <hr>

            <form method="POST">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="approved" <?php echo $submission['status'] == 'approved' ? 'selected' : ''; ?>>Approve</option>
                        <option value="rejected" <?php echo $submission['status'] == 'rejected' ? 'selected' : ''; ?>>Reject</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Marks</label>
                    <input type="number" name="marks" value="<?php echo $submission['marks']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Feedback</label>
                    <textarea name="feedback" required><?php echo htmlspecialchars($submission['feedback']); ?></textarea>
                </div>
                <button type="submit" class="btn">Update Submission</button>
            </form>
        </div>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</main><?php include (strpos($_SERVER["PHP_SELF"], "/admin/") !== false || strpos($_SERVER["PHP_SELF"], "/student/") !== false ? "../includes/footer.php" : "includes/footer.php"); ?>
