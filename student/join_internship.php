<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$message = '';

if (isset($_POST['join_id'])) {
    $intern_id = $_POST['join_id'];
    try {
        $stmt = $pdo->prepare("INSERT INTO student_internships (student_id, internship_id) VALUES (?, ?)");
        $stmt->execute([$student_id, $intern_id]);
        $message = "<div style='color: var(--success-color); margin-bottom: 1rem;'>Joined successfully!</div>";
    } catch (PDOException $e) {
        $message = "<div style='color: var(--danger-color); margin-bottom: 1rem;'>You have already joined this internship.</div>";
    }
}

// Fetch available internships that the student hasn't joined yet
$stmt = $pdo->prepare("
    SELECT * FROM internships
    WHERE id NOT IN (SELECT internship_id FROM student_internships WHERE student_id = ?)
");
$stmt->execute([$student_id]);
$available_internships = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div style="margin-bottom: 2rem;">
    <h1>Available Internships</h1>
    <p>Browse and join the programs that match your interests.</p>
</div>

<?php echo $message; ?>

<div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <?php if ($available_internships): ?>
        <?php foreach ($available_internships as $intern): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($intern['title']); ?></h3>
                <p style="color: #64748b; font-size: 0.9rem;"><?php echo htmlspecialchars($intern['company']); ?></p>
                <p><?php echo htmlspecialchars(substr($intern['description'], 0, 100)) . '...'; ?></p>
                <div style="margin-top: 1rem; font-size: 0.85rem; color: #64748b;">
                    <span>Start: <?php echo $intern['start_date']; ?></span><br>
                    <span>End: <?php echo $intern['end_date']; ?></span>
                </div>
                <form method="POST" style="margin-top: 1.5rem;">
                    <input type="hidden" name="join_id" value="<?php echo $intern['id']; ?>">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Join Program</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No new internships available at the moment. Check back later!</p>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
