<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../student/login.php");
    exit;
}

$student_id = $_GET['student_id'] ?? $_SESSION['user_id'];
$intern_id = $_GET['internship_id'] ?? null;

// Only allow admin or the student themselves
if ($_SESSION['role'] !== 'admin' && $_SESSION['user_id'] != $student_id) {
    die("Unauthorized");
}

$stmt = $pdo->prepare("
    SELECT u.name as student_name, i.title as internship_title, i.company, si.joined_at, si.status
    FROM student_internships si
    JOIN users u ON si.student_id = u.id
    JOIN internships i ON si.internship_id = i.id
    WHERE si.student_id = ? AND si.internship_id = ?
");
$stmt->execute([$student_id, $intern_id]);
$cert = $stmt->fetch();

if (!$cert) die("Internship record not found");
?>

<div class="card" style="border: 10px double #2563eb; padding: 50px; text-align: center; max-width: 800px; margin: 0 auto; position: relative;">
    <div style="font-size: 3rem; color: #2563eb; font-weight: bold; margin-bottom: 20px;">CERTIFICATE</div>
    <div style="font-size: 1.5rem; letter-spacing: 5px; margin-bottom: 40px;">OF COMPLETION</div>

    <p>This is to certify that</p>
    <div style="font-size: 2.5rem; font-family: 'Georgia', serif; border-bottom: 2px solid #333; display: inline-block; padding: 0 40px; margin: 20px 0;">
        <?php echo htmlspecialchars($cert['student_name']); ?>
    </div>

    <p style="margin-top: 30px;">has successfully completed the internship program in</p>
    <div style="font-size: 1.5rem; font-weight: bold; margin: 10px 0;">
        <?php echo htmlspecialchars($cert['internship_title']); ?>
    </div>
    <p>at <strong><?php echo htmlspecialchars($cert['company']); ?></strong></p>

    <div style="margin-top: 50px; display: flex; justify-content: space-around;">
        <div>
            <p>____________________</p>
            <p>Program Director</p>
        </div>
        <div>
            <p>____________________</p>
            <p>Company Mentor</p>
        </div>
    </div>

    <div style="margin-top: 30px; font-size: 0.9rem; color: #64748b;">
        Issued on: <?php echo date('F j, Y'); ?>
    </div>
</div>

<div style="margin-top: 2rem; text-align: center;" class="no-print">
    <button onclick="window.print()" class="btn btn-primary">Download Certificate</button>
    <a href="../student/dashboard.php" class="btn">Back to Dashboard</a>
</div>

<style>
@media print {
    .no-print { display: none; }
    nav, footer { display: none; }
    body { background: white; padding: 0; }
    .card { box-shadow: none; border: 10px double #2563eb !important; }
}
</style>

<?php require_once '../includes/footer.php'; ?>
