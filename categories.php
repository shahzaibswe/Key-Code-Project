<?php require_once 'includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mock Test Categories | Aspire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <!-- Nav (Shared) -->
    <nav class="navbar navbar-expand-lg fixed-top scrolled">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="bg-primary text-white rounded-3 p-1 me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-bolt"></i></div>
                <span class="fw-bold text-dark">ASPIRE</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item ms-lg-2"><a href="register.php" class="btn btn-premium px-4">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="py-5 mt-5">
        <div class="container py-5 text-center">
            <h1 class="display-4 fw-bold" data-aos="fade-up">Our <span class="text-gradient">Mock Test</span> Categories</h1>
            <p class="text-muted" data-aos="fade-up" data-aos-delay="100">Specialized preparation tracks for your specific career path.</p>
        </div>
    </header>

    <section class="pb-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="premium-card p-5 h-100">
                        <div class="icon-square bg-primary-subtle text-primary rounded-4 p-3 d-inline-block mb-4"><i class="fas fa-user-md fs-2"></i></div>
                        <h3>Pre-Medical (MDCAT)</h3>
                        <p class="text-muted mb-4">Focused on Biology, Chemistry, Physics, and English logic for medical college entrance.</p>
                        <a href="register.php" class="btn btn-outline-primary w-100 rounded-pill">Enroll in MDCAT</a>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="premium-card p-5 h-100">
                        <div class="icon-square bg-secondary-subtle text-secondary rounded-4 p-3 d-inline-block mb-4"><i class="fas fa-microchip fs-2"></i></div>
                        <h3>Pre-Engineering (ECAT)</h3>
                        <p class="text-muted mb-4">Master Mathematics, Physics, and Chemistry required for top engineering universities.</p>
                        <a href="register.php" class="btn btn-outline-secondary w-100 rounded-pill">Enroll in ECAT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
