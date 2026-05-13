<?php
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspire Mock Test Portal | Premier MDCAT & ECAT Preparation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="bg-primary text-white rounded-3 p-1 me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-bolt"></i>
                </div>
                <span class="fw-bold text-dark">ASPIRE</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories.php">Tests</a></li>
                    <li class="nav-item"><a class="nav-link" href="pricing.php">Pricing</a></li>
                    <li class="nav-item ms-lg-4">
                        <a href="login.php" class="nav-link text-primary fw-bold">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="register.php" class="btn btn-premium px-4">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="position-relative pt-5 overflow-hidden">
        <div class="blob" style="top: -10%; right: -10%;"></div>
        <div class="blob" style="bottom: 10%; left: -5%; width: 300px; height: 300px; background: rgba(34, 211, 238, 0.1);"></div>

        <div class="container pt-5 mt-5">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6" data-aos="fade-up">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 fw-bold">
                        <i class="fas fa-sparkles me-1"></i> The #1 Preparation Portal
                    </span>
                    <h1 class="display-3 fw-extrabold mb-4">Master Your Future with <span class="text-gradient">Aspire Mock Tests</span></h1>
                    <p class="lead text-secondary mb-5">Experience the most advanced, CoreTech-inspired mock test platform designed for MDCAT & ECAT excellence. Your journey to top universities starts here.</p>

                    <div class="d-flex flex-wrap gap-3 mb-5">
                        <a href="register.php" class="btn btn-premium btn-lg px-5">Join Now <i class="fas fa-arrow-right ms-2"></i></a>
                        <a href="test-schedule.php" class="btn btn-light btn-lg px-4 border">View Schedule</a>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <div class="d-flex -space-x-2">
                            <img src="https://i.pravatar.cc/40?img=1" class="rounded-circle border border-2 border-white" width="40">
                            <img src="https://i.pravatar.cc/40?img=2" class="rounded-circle border border-2 border-white" width="40" style="margin-left: -12px;">
                            <img src="https://i.pravatar.cc/40?img=3" class="rounded-circle border border-2 border-white" width="40" style="margin-left: -12px;">
                        </div>
                        <div class="text-sm">
                            <span class="fw-bold d-block">10,000+ Students</span>
                            <span class="text-muted">Already joined Aspire this year</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
                    <div class="position-relative">
                        <div class="glass-card p-2 shadow-2xl rotate-3">
                            <img src="https://img.freepik.com/free-vector/online-registration-concept-illustration_114360-2232.jpg" alt="Portal" class="img-fluid rounded-4">
                        </div>
                        <!-- Floating Stat Card -->
                        <div class="position-absolute bottom-0 start-0 mb-4 ms-n4 glass-card p-3 shadow-xl d-none d-md-block" data-aos="fade-right" data-aos-delay="400">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success text-white rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Payment Verified</h6>
                                    <small class="text-muted">Just now by Admin</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-4 text-center">
                <div class="col-md-3" data-aos="fade-up">
                    <h2 class="display-5 fw-bold text-primary mb-1"><span class="counter" data-target="15000">0</span>+</h2>
                    <p class="text-muted fw-semibold">Active Students</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="display-5 fw-bold text-primary mb-1"><span class="counter" data-target="500">0</span>+</h2>
                    <p class="text-muted fw-semibold">Mock Tests</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="display-5 fw-bold text-primary mb-1"><span class="counter" data-target="98">0</span>%</h2>
                    <p class="text-muted fw-semibold">Satisfaction Rate</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="display-5 fw-bold text-primary mb-1"><span class="counter" data-target="24">0</span>/7</h2>
                    <p class="text-muted fw-semibold">Expert Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-5 bg-light position-relative overflow-hidden">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Why Aspire is <span class="text-gradient">Different</span></h2>
                <p class="text-muted max-w-2xl mx-auto">We combine premium design with pedagogical excellence.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="premium-card p-5 h-100">
                        <div class="icon-square bg-primary-subtle text-primary rounded-3 mb-4" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bolt fs-4"></i>
                        </div>
                        <h4>Instant Analytics</h4>
                        <p class="text-muted">Get your results and detailed performance breakdown immediately after finishing your test.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="premium-card p-5 h-100">
                        <div class="icon-square bg-secondary-subtle text-secondary rounded-3 mb-4" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-layer-group fs-4"></i>
                        </div>
                        <h4>Hybrid Flexibility</h4>
                        <p class="text-muted">Switch between online remote testing and physical on-campus exams with one simple click.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="premium-card p-5 h-100">
                        <div class="icon-square bg-accent-subtle text-info rounded-3 mb-4" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shield-halved fs-4"></i>
                        </div>
                        <h4>Secure Dashboard</h4>
                        <p class="text-muted">Your data, payments, and results are protected with industry-standard security protocols.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <h3 class="mb-4 d-flex align-items-center">
                        <div class="bg-primary text-white rounded-3 p-1 me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bolt fs-6"></i>
                        </div>
                        ASPIRE
                    </h3>
                    <p class="text-secondary">Providing high-grade mock tests for ambitious students aiming for medical and engineering excellence.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white opacity-50"><i class="fab fa-twitter fs-5"></i></a>
                        <a href="#" class="text-white opacity-50"><i class="fab fa-linkedin fs-5"></i></a>
                        <a href="#" class="text-white opacity-50"><i class="fab fa-facebook fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 ms-lg-auto">
                    <h6 class="text-white fw-bold mb-4">Platform</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-secondary text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="about.php" class="text-secondary text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="categories.php" class="text-secondary text-decoration-none">Tests</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="text-white fw-bold mb-4">Resources</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="test-schedule.php" class="text-secondary text-decoration-none">Schedule</a></li>
                        <li class="mb-2"><a href="pricing.php" class="text-secondary text-decoration-none">Pricing</a></li>
                        <li class="mb-2"><a href="faq.php" class="text-secondary text-decoration-none">Help Center</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-5">
            <div class="text-center text-secondary">
                <small>&copy; 2025 Aspire Mock Test Portal. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
