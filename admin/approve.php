<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireAdminLogin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo->prepare("UPDATE registrations SET status = 'Verified' WHERE id = ?")->execute([$id]);
    $pdo->prepare("UPDATE payments SET status = 'Approved' WHERE registration_id = ?")->execute([$id]);
    $_SESSION['toast_msg'] = "Student #$id approved successfully.";
}

header("Location: registrations.php");
exit();
?>