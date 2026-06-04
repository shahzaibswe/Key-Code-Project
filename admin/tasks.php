<?php
// admin/tasks.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $unlock_date = $_POST['unlock_date'];
    $deadline = $_POST['deadline'];

    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, unlock_date, deadline) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $description, $unlock_date, $deadline]);
    $message = "Task created successfully.";
}

$tasks = $pdo->query("SELECT * FROM tasks ORDER BY unlock_date ASC")->fetchAll();
?>
<?php include (strpos($_SERVER["PHP_SELF"], "/admin/") !== false || strpos($_SERVER["PHP_SELF"], "/student/") !== false ? "../includes/header.php" : "includes/header.php"); ?>
    <div class="container">
        <h1>Manage Internship Tasks</h1>
        <?php if ($message): ?><p class="success"><?php echo $message; ?></p><?php endif; ?>

        <section class="card">
            <h3>Create New Task</h3>
            <form method="POST">
                <div class="form-group">
                    <label>Task Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>Unlock Date</label>
                    <input type="date" name="unlock_date" required>
                </div>
                <div class="form-group">
                    <label>Deadline</label>
                    <input type="date" name="deadline" required>
                </div>
                <button type="submit" name="create_task" class="btn">Create Task</button>
            </form>
        </section>

        <section class="task-list">
            <h3>Existing Tasks</h3>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Unlock Date</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo $task['unlock_date']; ?></td>
                        <td><?php echo $task['deadline']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</main><?php include (strpos($_SERVER["PHP_SELF"], "/admin/") !== false || strpos($_SERVER["PHP_SELF"], "/student/") !== false ? "../includes/footer.php" : "includes/footer.php"); ?>
