<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireAdminLogin();

$total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$total_revenue = $pdo->query("SELECT SUM(amount) FROM payments WHERE status = 'Approved'")->fetchColumn() ?: 0;
$pending = $pdo->query("SELECT COUNT(*) FROM registrations WHERE status = 'Pending'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | Aspire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
        <div class="dashboard-sidebar d-none d-lg-block" style="width: 280px; position: fixed;">
            <div class="px-4 mb-5 text-white"><h3>ASPIRE ADMIN</h3></div>
            <nav>
                <a href="dashboard.php" class="sidebar-link active"><i class="fas fa-chart-pie"></i> Analytics</a>
                <a href="registrations.php" class="sidebar-link"><i class="fas fa-users"></i> Students</a>
                <a href="manage-tests.php" class="sidebar-link"><i class="fas fa-file-signature"></i> Tests</a>
                <a href="reports.php" class="sidebar-link"><i class="fas fa-file-invoice-dollar"></i> Reports</a>
                <div class="mt-5 px-3"><a href="../logout.php" class="btn btn-outline-danger w-100">Logout</a></div>
            </nav>
        </div>

        <div class="flex-grow-1 p-4" style="margin-left: 280px;">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold">Platform Overview</h2>
                <div class="bg-white p-2 rounded-3 shadow-sm border px-3">
                    <small class="text-muted">Status:</small> <span class="text-success fw-bold">Live</span>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="premium-card p-4">
                        <div class="bg-primary-subtle text-primary rounded-3 p-2 d-inline-block mb-3"><i class="fas fa-user-graduate fs-4"></i></div>
                        <h6 class="text-muted">Total Students</h6>
                        <h3 class="fw-bold mb-0"><?php echo $total_students; ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="premium-card p-4">
                        <div class="bg-success-subtle text-success rounded-3 p-2 d-inline-block mb-3"><i class="fas fa-wallet fs-4"></i></div>
                        <h6 class="text-muted">Approved Revenue</h6>
                        <h3 class="fw-bold mb-0">Rs. <?php echo number_format($total_revenue); ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="premium-card p-4">
                        <div class="bg-warning-subtle text-warning rounded-3 p-2 d-inline-block mb-3"><i class="fas fa-clock fs-4"></i></div>
                        <h6 class="text-muted">Pending Reviews</h6>
                        <h3 class="fw-bold mb-0"><?php echo $pending; ?></h3>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="premium-card p-4">
                        <h5 class="fw-bold mb-4">Registration Trends</h5>
                        <canvas id="regChart" height="250"></canvas>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="premium-card p-4">
                        <h5 class="fw-bold mb-4">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="registrations.php" class="btn btn-premium py-3">Verify Payments</a>
                            <button class="btn btn-light py-3 border">Generate Admit Cards</button>
                            <button class="btn btn-light py-3 border">Export Student Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('regChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Registrations',
                    data: [12, 19, 15, 25],
                    borderColor: '#6366f1',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.1)'
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });
    </script>
</body>
</html>
