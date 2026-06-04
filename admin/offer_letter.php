<?php
// admin/offer_letter.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit();
}

$student_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'student' AND status = 'approved'");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found or not approved.");
}
?>
<?php include (strpos($_SERVER["PHP_SELF"], "/admin/") !== false || strpos($_SERVER["PHP_SELF"], "/student/") !== false ? "../includes/header.php" : "includes/header.php"); ?>
    <div class="no-print">
        <button onclick="window.print()">Print Offer Letter</button>
        <a href="students.php">Back to Students</a>
    </div>
    <div class="letter-container">
        <div class="header">
            <h1>Internship Offer Letter</h1>
            <p>Internship Portal Inc.</p>
        </div>
        <div class="date">
            <p>Date: <?php echo date('Y-m-d'); ?></p>
        </div>
        <p>To,</p>
        <p><strong><?php echo htmlspecialchars($student['name']); ?></strong><br>
        Email: <?php echo htmlspecialchars($student['email']); ?></p>

        <p>Subject: Internship Offer Letter</p>

        <p>Dear <?php echo htmlspecialchars($student['name']); ?>,</p>

        <p>We are pleased to offer you an internship position at Internship Portal Inc. Based on your application and interest, we believe you will be a valuable addition to our team.</p>

        <p>Your internship is scheduled to begin on <strong><?php echo $student['start_date']; ?></strong> and is expected to end on <strong><?php echo $student['end_date']; ?></strong>.</p>

        <p>During this period, you will be working on various tasks as outlined in your student dashboard. Please follow the instructions provided to ensure successful completion of the program.</p>

        <p>We look forward to working with you.</p>

        <div class="footer">
            <p>Sincerely,</p>
            <br>
            <p><strong>Admin</strong><br>
            Director, Internship Portal Inc.</p>
        </div>
    </div>
</main><?php include (strpos($_SERVER["PHP_SELF"], "/admin/") !== false || strpos($_SERVER["PHP_SELF"], "/student/") !== false ? "../includes/footer.php" : "includes/footer.php"); ?>
