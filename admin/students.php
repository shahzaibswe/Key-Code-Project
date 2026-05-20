<?php
// admin/students.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = '';

// Handle Approval
if (isset($_POST['approve'])) {
    $student_id = $_POST['student_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $instructions = $_POST['instructions'];

    $stmt = $pdo->prepare("UPDATE users SET status = 'approved', start_date = ?, end_date = ?, instructions = ? WHERE id = ?");
    $stmt->execute([$start_date, $end_date, $instructions, $student_id]);
    $message = "Student approved and internship schedule set.";
}

// Handle Rejection
if (isset($_POST['reject'])) {
    $student_id = $_POST['student_id'];
    $stmt = $pdo->prepare("UPDATE users SET status = 'rejected' WHERE id = ?");
    $stmt->execute([$student_id]);
    $message = "Student application rejected.";
}

$stmt = $pdo->query("SELECT * FROM users WHERE role = 'student' ORDER BY created_at DESC");
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Students</h1>
        <?php if ($message): ?><p class="success"><?php echo $message; ?></p><?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Fee Receipt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td><span class="status-badge <?php echo $student['status']; ?>"><?php echo ucfirst($student['status']); ?></span></td>
                    <td>
                        <?php if ($student['fee_receipt']): ?>
                            <a href="../uploads/<?php echo $student['fee_receipt']; ?>" target="_blank">View Receipt</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($student['status'] === 'awaiting_approval'): ?>
                            <button onclick="document.getElementById('approve-modal-<?php echo $student['id']; ?>').style.display='block'" class="btn-sm">Approve</button>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                <button type="submit" name="reject" class="btn-sm btn-danger">Reject</button>
                            </form>
                        <?php elseif ($student['status'] === 'approved'): ?>
                            <a href="offer_letter.php?id=<?php echo $student['id']; ?>" class="btn-sm">Offer Letter</a>
                            <a href="../student/certificate.php?admin_view=<?php echo $student['id']; ?>" class="btn-sm btn-secondary">Certificate</a>

                            <div id="approve-modal-<?php echo $student['id']; ?>" class="modal" style="display:none;">
                                <div class="modal-content">
                                    <h3>Approve Internship</h3>
                                    <form method="POST">
                                        <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" name="start_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" name="end_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Instructions</label>
                                            <textarea name="instructions" required></textarea>
                                        </div>
                                        <button type="submit" name="approve" class="btn">Confirm Approval</button>
                                        <button type="button" onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="btn-secondary">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
