<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireStudentLogin();

$student_id = $_SESSION['student_id'];
$student = $pdo->query("SELECT * FROM students WHERE id = $student_id")->fetch();
$reg = $pdo->query("SELECT * FROM registrations WHERE student_id = $student_id")->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Aspire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="dashboard-sidebar d-none d-lg-block" style="width: 280px; position: fixed;">
            <div class="px-4 mb-5">
                <h3 class="fw-bold text-white d-flex align-items-center">
                    <div class="bg-primary text-white rounded-3 p-1 me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-bolt fs-6"></i></div>
                    ASPIRE
                </h3>
            </div>
            <nav>
                <a href="dashboard.php" class="sidebar-link active"><i class="fas fa-grid-2"></i> Overview</a>
                <a href="profile.php" class="sidebar-link"><i class="fas fa-user"></i> My Profile</a>
                <a href="admit-card.php" class="sidebar-link"><i class="fas fa-id-card"></i> Admit Card</a>
                <a href="take-test.php" class="sidebar-link"><i class="fas fa-pen-nib"></i> Mock Tests</a>
                <a href="results.php" class="sidebar-link"><i class="fas fa-chart-line"></i> Analytics</a>
                <div class="mt-5 px-3">
                    <a href="../logout.php" class="btn btn-outline-danger w-100 rounded-3">Logout</a>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-grow-1 p-4" style="margin-left: 280px;">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h2 class="fw-bold mb-1">Hello, <?php echo explode(' ', $student['full_name'])[0]; ?>!</h2>
                    <p class="text-muted mb-0">Track your progress and upcoming tests.</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white p-2 rounded-circle shadow-sm">
                        <img src="../<?php echo $student['profile_pic']; ?>" class="rounded-circle" width="45" height="45">
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="premium-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="bg-primary-subtle text-primary rounded-3 p-2"><i class="fas fa-check-double"></i></div>
                            <span class="badge bg-success-subtle text-success">Active</span>
                        </div>
                        <h6 class="text-muted mb-1">Account Status</h6>
                        <h4 class="fw-bold mb-0"><?php echo $reg['status'] ?? 'Pending'; ?></h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="premium-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="bg-secondary-subtle text-secondary rounded-3 p-2"><i class="fas fa-calendar"></i></div>
                        </div>
                        <h6 class="text-muted mb-1">Next Test</h6>
                        <h4 class="fw-bold mb-0">Dec 31, 2025</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="premium-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="bg-info-subtle text-info rounded-3 p-2"><i class="fas fa-trophy"></i></div>
                        </div>
                        <h6 class="text-muted mb-1">Global Rank</h6>
                        <h4 class="fw-bold mb-0"># --</h4>
                    </div>
                </div>
            </div>

            <div class="premium-card p-4">
                <h5 class="fw-bold mb-4">Performance Insights</h5>
                <div class="text-center py-5">
                    <i class="fas fa-chart-area fs-1 text-light mb-3"></i>
                    <p class="text-muted">No test data available yet. Start your first mock to see analytics.</p>
                    <a href="take-test.php" class="btn btn-premium px-4">Start Mock Test</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
