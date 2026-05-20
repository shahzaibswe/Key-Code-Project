<?php
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM internships WHERE id = ?");
$stmt->execute([$id]);
$intern = $stmt->fetch();

if (!$intern) die("Internship not found");
?>

<div class="card" id="printable">
    <div style="text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px;">
        <h1 style="margin: 0;"><?php echo htmlspecialchars($intern['company']); ?></h1>
        <p>Official Internship Offer Letter</p>
    </div>

    <div style="margin-bottom: 40px;">
        <p>Date: <?php echo date('F j, Y'); ?></p>
        <p>Subject: Offer of Internship for the position of <strong><?php echo htmlspecialchars($intern['title']); ?></strong></p>
    </div>

    <div style="line-height: 1.8;">
        <p>Dear Candidate,</p>
        <p>We are pleased to offer you an internship at <strong><?php echo htmlspecialchars($intern['company']); ?></strong>.
        Your internship is scheduled to begin on <strong><?php echo $intern['start_date']; ?></strong> and end on <strong><?php echo $intern['end_date']; ?></strong>.</p>

        <p>During this period, you will be reporting to the program manager and will be responsible for the tasks assigned to you through the portal.
        We expect you to maintain a high level of professionalism and dedication towards your work.</p>

        <p>We look forward to having you on our team.</p>
    </div>

    <div style="margin-top: 60px; display: flex; justify-content: space-between;">
        <div>
            <p>____________________</p>
            <p>Authorized Signatory</p>
            <p><?php echo htmlspecialchars($intern['company']); ?></p>
        </div>
        <div>
            <p>____________________</p>
            <p>Student Signature</p>
        </div>
    </div>
</div>

<div style="margin-top: 2rem; text-align: center;" class="no-print">
    <button onclick="window.print()" class="btn btn-primary">Print Offer Letter</button>
    <a href="manage_internships.php" class="btn">Back</a>
</div>

<style>
@media print {
    .no-print { display: none; }
    nav, footer { display: none; }
    body { background: white; }
    .card { box-shadow: none; border: none; }
}
</style>

<?php require_once '../includes/footer.php'; ?>
