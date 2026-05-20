<?php
// student/joining_form.php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic validation and file upload
    if (isset($_FILES['fee_receipt']) && $_FILES['fee_receipt']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
        $filename = $_FILES['fee_receipt']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_name = "receipt_" . $_SESSION['user_id'] . "_" . time() . "." . $ext;
            $upload_path = "../uploads/" . $new_name;

            if (move_uploaded_file($_FILES['fee_receipt']['tmp_name'], $upload_path)) {
                $stmt = $pdo->prepare("UPDATE users SET fee_receipt = ?, status = 'awaiting_approval' WHERE id = ?");
                $stmt->execute([$new_name, $_SESSION['user_id']]);
                $success = "Joining form submitted! Please wait for admin approval.";
                header("Refresh: 3; url=dashboard.php");
            } else {
                $error = "Failed to upload file.";
            }
        } else {
            $error = "Invalid file type. Only JPG, PNG, PDF allowed.";
        }
    } else {
        $error = "Please upload the fee receipt.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Joining Form</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container auth-form">
        <h2>Internship Joining Form</h2>
        <?php if ($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
        <?php if ($success): ?><p class="success"><?php echo $success; ?></p><?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" value="<?php echo htmlspecialchars($user['name']); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Upload Fee Receipt (JPG/PNG/PDF)</label>
                <input type="file" name="fee_receipt" required>
            </div>
            <button type="submit" class="btn">Submit for Approval</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
