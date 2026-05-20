<?php
// student/certificate.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role'] === 'admin' && isset($_GET['admin_view'])) {
    $student_id = $_GET['admin_view'];
} else {
    if ($_SESSION['role'] !== 'student') {
        header("Location: ../login.php");
        exit();
    }
    $student_id = $_SESSION['user_id'];
}

// Check if all tasks are completed and approved
$total_tasks = $pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
$stmt = $pdo->prepare("SELECT COUNT(*) FROM submissions WHERE student_id = ? AND status = 'approved'");
$stmt->execute([$student_id]);
$completed_tasks = $stmt->fetchColumn();

$is_complete = ($total_tasks > 0 && $completed_tasks >= $total_tasks);

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$student_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internship Certificate</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .certificate-container {
            border: 10px solid #222;
            padding: 50px;
            text-align: center;
            background: #fff;
            color: #333;
            max-width: 800px;
            margin: 50px auto;
        }
        .certificate-container h1 { font-size: 50px; }
        .certificate-container h2 { border-bottom: 2px solid #333; display: inline-block; padding-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($is_complete): ?>
            <div class="certificate-container" id="certificate">
                <h1>Certificate of Completion</h1>
                <p>This is to certify that</p>
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p>has successfully completed the Internship Program</p>
                <p>from <strong><?php echo $user['start_date']; ?></strong> to <strong><?php echo $user['end_date']; ?></strong>.</p>
                <br><br>
                <p>Admin Signature</p>
            </div>
            <button onclick="window.print()" class="btn">Print Certificate</button>
        <?php else: ?>
            <div class="card error">
                <h3>Certificate Not Available</h3>
                <p>You must complete and get approval for all <?php echo $total_tasks; ?> tasks to earn your certificate.</p>
                <p>Completed: <?php echo $completed_tasks; ?></p>
            </div>
        <?php endif; ?>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
