<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireAdminLogin();

$search = $_GET['q'] ?? '';
$status_filter = $_GET['status'] ?? '';

$sql = "SELECT r.*, s.full_name, s.mobile, s.district, p.transaction_id, p.receipt_image FROM registrations r
        JOIN students s ON r.student_id = s.id
        JOIN payments p ON r.id = p.registration_id WHERE 1=1";

$params = [];
if($search) {
    $sql .= " AND (s.full_name LIKE ? OR s.mobile LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if($status_filter) {
    $sql .= " AND r.status = ?";
    $params[] = $status_filter;
}

$sql .= " ORDER BY r.id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$regs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrations | Aspire Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container-fluid p-4">
        <div class="premium-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Student Registrations</h3>
                <a href="dashboard.php" class="btn btn-light border"><i class="fas fa-arrow-left me-2"></i>Dashboard</a>
            </div>

            <form class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="q" class="form-control p-3 rounded-3" placeholder="Search by name or mobile..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select p-3 rounded-3">
                        <option value="">All Statuses</option>
                        <option value="Pending" <?php echo $status_filter=='Pending'?'selected':''; ?>>Pending</option>
                        <option value="Verified" <?php echo $status_filter=='Verified'?'selected':''; ?>>Verified</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-premium w-100 h-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr><th>Student</th><th>District</th><th>Transaction ID</th><th>Receipt</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($regs as $row): ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($row['full_name']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($row['mobile']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($row['district']); ?></td>
                            <td><code><?php echo htmlspecialchars($row['transaction_id']); ?></code></td>
                            <td><a href="../<?php echo htmlspecialchars($row['receipt_image']); ?>" target="_blank" class="text-decoration-none"><i class="fas fa-file-invoice me-1"></i>View</a></td>
                            <td>
                                <span class="badge <?php echo $row['status']=='Verified'?'bg-success-subtle text-success':'bg-warning-subtle text-warning'; ?> p-2 px-3 rounded-pill">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <?php if($row['status'] !== 'Verified'): ?>
                                    <a href="approve.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success rounded-pill px-3">Approve</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
