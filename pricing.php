<?php require_once 'includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pricing | Aspire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg fixed-top scrolled">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">ASPIRE</a>
        </div>
    </nav>
    <div class="container py-5 mt-5 text-center">
        <h1 class="display-4 fw-bold mt-5" data-aos="fade-up">Transparent <span class="text-gradient">Pricing</span></h1>
        <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100">Quality education at an affordable price.</p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="premium-card p-5">
                    <h5 class="text-muted">Online Remote</h5>
                    <h2 class="display-5 fw-bold my-4">Rs. 600</h2>
                    <ul class="list-unstyled text-start mb-5">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Attempt from home</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Digital Performance Report</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Rank Analytics</li>
                    </ul>
                    <a href="register.php" class="btn btn-light w-100 border">Select Plan</a>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="premium-card p-5 border-primary">
                    <h5 class="text-primary fw-bold">Physical On-Campus</h5>
                    <h2 class="display-5 fw-bold my-4 text-gradient">Rs. 1000</h2>
                    <ul class="list-unstyled text-start mb-5">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Real Exam Environment</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Printed Question Paper</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> One-on-one Guidance</li>
                    </ul>
                    <a href="register.php" class="btn btn-premium w-100">Get Started</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
