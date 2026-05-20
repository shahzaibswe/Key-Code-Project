<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$task_id = $_GET['task_id'] ?? null;
$student_id = $_SESSION['user_id'];

if (!$task_id) {
    header("Location: dashboard.php");
    exit;
}

// Verify student is enrolled in the internship this task belongs to
$stmt = $pdo->prepare("
    SELECT t.*, i.title as internship_title
    FROM tasks t
    JOIN student_internships si ON t.internship_id = si.internship_id
    JOIN internships i ON t.internship_id = i.id
    WHERE t.id = ? AND si.student_id = ?
");
$stmt->execute([$task_id, $student_id]);
$task = $stmt->fetch();

if (!$task) {
    die("Unauthorized or Task not found.");
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $file_path = '';

    if (isset($_FILES['submission_file']) && $_FILES['submission_file']['error'] === UPLOAD_ERR_OK) {
        $allowed_extensions = ['pdf', 'zip', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
        $file_name = $_FILES['submission_file']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_extensions)) {
            $error = "Invalid file type. Allowed: " . implode(', ', $allowed_extensions);
        } else {
            $upload_dir = '../uploads/submissions/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $safe_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
            $file_path = 'uploads/submissions/' . $safe_name;
            move_uploaded_file($_FILES['submission_file']['tmp_name'], '../' . $file_path);
        }
    }

    if (empty($error)) {
        $stmt = $pdo->prepare("INSERT INTO submissions (task_id, student_id, content, file_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$task_id, $student_id, $content, $file_path]);
        $message = "Task submitted successfully! <a href='dashboard.php'>Back to Dashboard</a>";
    }
}
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2>Submit Task</h2>
    <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0;"><?php echo htmlspecialchars($task['title']); ?></h3>
        <small style="color: #64748b;"><?php echo htmlspecialchars($task['internship_title']); ?> • Due: <?php echo $task['deadline']; ?></small>
        <p style="margin-top: 10px;"><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
    </div>

    <?php if ($error): ?>
        <div style="color: var(--danger-color); margin-bottom: 1rem;"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($message): ?>
        <div style="color: var(--success-color); margin-bottom: 1rem;"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (empty($message)): ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="content">Submission Notes / Link</label>
            <textarea name="content" id="content" class="form-control" rows="5" required placeholder="Paste your hosted project link or any notes here..."></textarea>
        </div>
        <div class="form-group">
            <label for="submission_file">Upload File (Optional)</label>
            <input type="file" name="submission_file" id="submission_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Assignment</button>
    </form>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
