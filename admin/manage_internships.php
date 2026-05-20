<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_internship'])) {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $stmt = $pdo->prepare("INSERT INTO internships (title, company, description, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $company, $description, $start_date, $end_date]);
    $message = "Internship program added successfully!";
}

$internships = $pdo->query("SELECT * FROM internships ORDER BY created_at DESC")->fetchAll();
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Manage Internships</h1>
    <button onclick="document.getElementById('addForm').style.display='block'" class="btn btn-primary">Add New Program</button>
</div>

<?php if ($message): ?>
    <div style="color: var(--success-color); margin-bottom: 1rem;"><?php echo $message; ?></div>
<?php endif; ?>

<div id="addForm" class="card" style="display: none; margin-bottom: 2rem;">
    <h3>Add New Internship</h3>
    <form method="POST">
        <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>
        <button type="submit" name="add_internship" class="btn btn-primary">Save Program</button>
        <button type="button" onclick="document.getElementById('addForm').style.display='none'" class="btn" style="background: #e2e8f0;">Cancel</button>
    </form>
</div>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 10px;">Title</th>
                <th style="padding: 10px;">Company</th>
                <th style="padding: 10px;">Duration</th>
                <th style="padding: 10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($internships as $intern): ?>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 10px;"><?php echo htmlspecialchars($intern['title']); ?></td>
                    <td style="padding: 10px;"><?php echo htmlspecialchars($intern['company']); ?></td>
                    <td style="padding: 10px; font-size: 0.85rem;"><?php echo $intern['start_date']; ?> to <?php echo $intern['end_date']; ?></td>
                    <td style="padding: 10px;">
                        <a href="manage_tasks.php?internship_id=<?php echo $intern['id']; ?>">Tasks</a> |
                        <a href="generate_offer.php?id=<?php echo $intern['id']; ?>">Offer Letter</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
