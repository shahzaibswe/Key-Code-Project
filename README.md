# Internship Management Portal

A comprehensive, role-based platform for managing student internships, tasks, and certifications.

## Features

### For Students
- **Registration & Login**: Secure authentication for students.
- **Dashboard**: Track internship progress and performance using Chart.js visualizations.
- **Internship Discovery**: Browse and join available internship programs.
- **Task Submission**: Submit weekly assignments with notes and file uploads.
- **Profile Management**: Update personal information and security settings.
- **Certifications**: Generate and print certificates upon successful completion.

### For Admins
- **Admin Dashboard**: Overview of system statistics (total students, active programs, pending reviews).
- **Internship Management**: Create, edit, and track internship programs.
- **Task Management**: Assign specific tasks to internship programs with deadlines.
- **Submission Review**: Evaluate student work, provide feedback, and assign scores.
- **Offer Letters**: Automatically generate printable offer letters for students.

## Technical Stack
- **Backend**: PHP 8.3
- **Database**: SQLite (via PDO for easy cross-compatibility with MySQL)
- **Frontend**: HTML5, CSS3 (Custom Responsive UI), JavaScript
- **Charts**: Chart.js (CDN)
- **Architecture**: Role-Based Access Control (RBAC)

## Getting Started
1. Ensure PHP 8.3 is installed.
2. Start the built-in PHP server:
   ```bash
   php -S localhost:8000
   ```
3. Open `http://localhost:8000` in your browser.
4. Default Admin (if none exists): `admin@example.com` / `admin` (Created on first login attempt).

## Project Structure
- `admin/`: Admin-side logic and pages.
- `student/`: Student-side logic and pages.
- `includes/`: Common layout components (header, footer).
- `config/`: Database connection and configuration.
- `assets/`: CSS, JS, and image assets.
- `uploads/`: Directory for student task submissions.
