<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['student_id'] = $user['id'];
        $_SESSION['student_name'] = $user['full_name'];
        header("Location: student/dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Aspire Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="premium-card p-5">
                    <h3 class="text-center fw-bold mb-4">Student Login</h3>
                    <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                    <form method="POST">
                        <div class="mb-3"><input type="email" name="email" class="form-control p-3 rounded-3" placeholder="Email" required></div>
                        <div class="mb-3"><input type="password" name="password" class="form-control p-3 rounded-3" placeholder="Password" required></div>
                        <button type="submit" class="btn btn-premium w-100 py-3">Login</button>
                    </form>
                    <p class="text-center mt-4">New here? <a href="register.php">Create account</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
