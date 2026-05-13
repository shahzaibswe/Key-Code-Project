<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $profile_pic = uploadFile($_FILES['profile_pic'], 'uploads/profiles/');
    $receipt_image = uploadFile($_FILES['receipt_image'], 'uploads/receipts/');

    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO students (full_name, father_name, cnic, dob, gender, email, mobile, whatsapp, emergency_contact, profile_pic, province, district, city, address, academic_group, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $full_name, sanitize($_POST['father_name']), sanitize($_POST['cnic']), $_POST['dob'], $_POST['gender'],
            $email, $_POST['mobile'], $_POST['whatsapp'], $_POST['emergency_contact'], $profile_pic,
            $_POST['province'], $_POST['district'], $_POST['city'], $_POST['address'], $_POST['academic_group'], $password
        ]);
        $student_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO registrations (student_id, category, test_mode, fee) VALUES (?, ?, ?, ?)");
        $stmt->execute([$student_id, $_POST['category'], $_POST['test_mode'], $_POST['fee']]);
        $registration_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO payments (registration_id, payment_method, transaction_id, receipt_image, payment_date, sender_number, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $registration_id, $_POST['payment_method'], $_POST['transaction_id'], $receipt_image,
            $_POST['payment_date'], $_POST['sender_number'], $_POST['fee']
        ]);

        $pdo->commit();
        $message = "SUCCESS|Registration successful! Our team will verify your payment soon.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $message = "ERROR|Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration | Aspire Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-step { display: none; }
        .form-step.active { display: block; animation: fadeIn 0.5s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg fixed-top scrolled">
        <div class="container"><a class="navbar-brand fw-bold" href="index.php">ASPIRE</a></div>
    </nav>

    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="premium-card p-5 shadow-2xl mt-5">
                    <h2 class="text-center fw-bold mb-5">Join the <span class="text-gradient">Elite Prep</span> Program</h2>

                    <?php if($message):
                        $parts = explode('|', $message);
                        $type = ($parts[0] == 'SUCCESS') ? 'success' : 'danger';
                    ?>
                        <div class="alert alert-<?php echo $type; ?> rounded-4 p-4 mb-4"><?php echo $parts[1]; ?></div>
                    <?php endif; ?>

                    <div class="progress-stepper">
                        <div class="step-item active">1</div>
                        <div class="step-item">2</div>
                        <div class="step-item">3</div>
                        <div class="step-item">4</div>
                    </div>

                    <form action="register.php" method="POST" enctype="multipart/form-data" id="regForm">
                        <!-- Step 1: Personal -->
                        <div class="form-step active">
                            <h4 class="mb-4">Personal Information</h4>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label fw-600">Full Name</label><input type="text" name="full_name" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">Father Name</label><input type="text" name="father_name" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">CNIC / B-Form</label><input type="text" name="cnic" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">Date of Birth</label><input type="date" name="dob" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-12"><label class="form-label fw-600">Profile Picture</label><input type="file" name="profile_pic" class="form-control p-3 rounded-3" accept="image/*" required></div>
                            </div>
                            <div class="mt-5 text-end"><button type="button" class="btn btn-premium btn-next px-5">Next Step</button></div>
                        </div>

                        <!-- Step 2: Academic -->
                        <div class="form-step">
                            <h4 class="mb-4">Academic Details</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-600">Academic Group</label>
                                    <select name="academic_group" class="form-select p-3 rounded-3" required>
                                        <option value="Pre-Engineering">Pre-Engineering (ECAT)</option>
                                        <option value="Pre-Medical">Pre-Medical (MDCAT)</option>
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label fw-600">Email Address</label><input type="email" name="email" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">Mobile Number</label><input type="tel" name="mobile" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">WhatsApp Number</label><input type="tel" name="whatsapp" class="form-control p-3 rounded-3"></div>
                            </div>
                            <div class="mt-5 d-flex justify-content-between">
                                <button type="button" class="btn btn-light btn-prev px-4">Back</button>
                                <button type="button" class="btn btn-premium btn-next px-5">Next Step</button>
                            </div>
                        </div>

                        <!-- Step 3: Location -->
                        <div class="form-step">
                            <h4 class="mb-4">Location Details</h4>
                            <div class="row g-3">
                                <div class="col-md-4"><label class="form-label fw-600">Province</label><input type="text" name="province" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-4"><label class="form-label fw-600">District</label><input type="text" name="district" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-4"><label class="form-label fw-600">City</label><input type="text" name="city" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-12"><label class="form-label fw-600">Complete Address</label><textarea name="address" class="form-control p-3 rounded-3" rows="3" required></textarea></div>
                            </div>
                            <div class="mt-5 d-flex justify-content-between">
                                <button type="button" class="btn btn-light btn-prev px-4">Back</button>
                                <button type="button" class="btn btn-premium btn-next px-5">Next Step</button>
                            </div>
                        </div>

                        <!-- Step 4: Payment -->
                        <div class="form-step">
                            <h4 class="mb-4">Test Mode & Payment</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-600">Test Mode</label>
                                    <select name="test_mode" id="test_mode" class="form-select p-3 rounded-3" required>
                                        <option value="Online Remote Test">Online Remote Test (Rs. 600)</option>
                                        <option value="Physical On-Campus Test">Physical On-Campus Test (Rs. 1000)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-600">Payment Method</label>
                                    <select name="payment_method" class="form-select p-3 rounded-3" required>
                                        <option value="JazzCash">JazzCash</option>
                                        <option value="Easypaisa">Easypaisa</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>
                                </div>
                                <div class="col-12 p-4 glass-card bg-primary-subtle text-primary mb-3">
                                    <p class="mb-0 fw-bold">Total Payable: Rs. <span id="fee_display">600</span></p>
                                    <input type="hidden" name="fee" id="fee_input" value="600">
                                    <input type="hidden" name="category" value="Unified Mock">
                                </div>
                                <div class="col-md-6"><label class="form-label fw-600">Transaction ID</label><input type="text" name="transaction_id" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">Payment Date</label><input type="date" name="payment_date" class="form-control p-3 rounded-3" required></div>
                                <div class="col-12"><label class="form-label fw-600">Payment Receipt Screenshot</label><input type="file" name="receipt_image" class="form-control p-3 rounded-3" accept="image/*" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">Choose Password</label><input type="password" name="password" class="form-control p-3 rounded-3" required></div>
                                <div class="col-md-6"><label class="form-label fw-600">Confirm Password</label><input type="password" class="form-control p-3 rounded-3" required></div>
                            </div>
                            <div class="mt-5 d-flex justify-content-between">
                                <button type="button" class="btn btn-light btn-prev px-4">Back</button>
                                <button type="submit" class="btn btn-premium px-5">Complete & Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
