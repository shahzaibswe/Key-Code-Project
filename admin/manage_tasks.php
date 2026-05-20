<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$internship_id = $_GET['internship_id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $int_id = $_POST['internship_id'];

    $stmt = $pdo->prepare("INSERT INTO tasks (internship_id, title, description, deadline) VALUES (?, ?, ?, ?)");
    $stmt->execute([$int_id, $title, $description, $deadline]);
    $message = "Task added successfully!";
}

$internships = $pdo->query("SELECT id, title FROM internships")->fetchAll();
$query = "SELECT t.*, i.title as internship_title FROM tasks t JOIN internships i ON t.internship_id = i.id";
if ($internship_id) {
    $stmt = $pdo->prepare($query . " WHERE t.internship_id = ? ORDER BY t.created_at DESC");
    $stmt->execute([$internship_id]);
} else {
    $stmt = $pdo->query($query . " ORDER BY t.created_at DESC");
}
$tasks = $stmt->fetchAll();
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Manage Tasks</h1>
    <button onclick="document.getElementById('addForm').style.display='block'" class="btn btn-primary">Add New Task</button>
</div>

<?php if ($message): ?>
    <div style="color: var(--success-color); margin-bottom: 1rem;"><?php echo $message; ?></div>
<?php endif; ?>

<div id="addForm" class="card" style="display: <?php echo $internship_id ? 'block' : 'none'; ?>; margin-bottom: 2rem;">
    <h3>Create Task</h3>
    <form method="POST">
        <div class="form-group">
            <label>Internship Program</label>
            <select name="internship_id" class="form-control" required>
                <?php foreach ($internships as $i): ?>
                    <option value="<?php echo $i['id']; ?>" <?php echo ($internship_id == $i['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($i['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Task Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Deadline</label>
            <input type="datetime-local" name="deadline" class="form-control">
        </div>
        <button type="submit" name="add_task" class="btn btn-primary">Create Task</button>
        <button type="button" onclick="document.getElementById('addForm').style.display='none'" class="btn" style="background: #e2e8f0;">Cancel</button>
    </form>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 10px;">Task</th>
                <th style="padding: 10px;">Program</th>
                <th style="padding: 10px;">Deadline</th>
                <th style="padding: 10px;">Submissions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 10px;"><?php echo htmlspecialchars($task['title']); ?></td>
                    <td style="padding: 10px;"><?php echo htmlspecialchars($task['internship_title']); ?></td>
                    <td style="padding: 10px; font-size: 0.85rem;"><?php echo $task['deadline']; ?></td>
                    <td style="padding: 10px;"><a href="review_submissions.php?task_id=<?php echo $task['id']; ?>">Review</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
