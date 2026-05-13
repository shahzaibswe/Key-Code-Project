<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_user'] = 'Administrator';
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Aspire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-dark d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="premium-card p-5">
                    <h3 class="text-center fw-bold mb-4">Admin Access</h3>
                    <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                    <form method="POST">
                        <div class="mb-3"><input type="text" name="username" class="form-control p-3 rounded-3" placeholder="Username" required></div>
                        <div class="mb-3"><input type="password" name="password" class="form-control p-3 rounded-3" placeholder="Password" required></div>
                        <button type="submit" class="btn btn-primary w-100 py-3">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
