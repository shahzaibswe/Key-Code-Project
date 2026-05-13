<?php
session_start();

function isStudentLoggedIn() {
    return isset($_SESSION['student_id']);
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function requireStudentLogin() {
    if (!isStudentLoggedIn()) {
        header("Location: ../login.php");
        exit();
    }
}

function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function uploadFile($file, $targetDir) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return "";
    $targetFile = $targetDir . time() . '_' . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    }
    return "";
}
?>