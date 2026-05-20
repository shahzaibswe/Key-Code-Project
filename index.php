<?php
require_once 'includes/header.php';
?>

<div class="hero" style="text-align: center; padding: 60px 0;">
    <h1>Welcome to the Internship Management Portal</h1>
    <p>Kickstart your career with real-world experience.</p>
    <div style="margin-top: 30px;">
        <a href="student/register.php" class="btn btn-primary">Join as a Student</a>
        <a href="admin/login.php" class="btn" style="background: #64748b; color: white; margin-left: 10px;">Admin Access</a>
    </div>
</div>

<div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <div class="card">
        <h3>For Students</h3>
        <ul>
            <li>Browse available internships</li>
            <li>Submit weekly tasks</li>
            <li>Track your performance</li>
            <li>Get certified upon completion</li>
        </ul>
    </div>
    <div class="card">
        <h3>For Admins</h3>
        <ul>
            <li>Manage internship programs</li>
            <li>Assign and review tasks</li>
            <li>Monitor student progress</li>
            <li>Generate offer letters</li>
        </ul>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
