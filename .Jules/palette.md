# Key Learnings - Internship Portal

## Architecture
- **Relative Paths:** Use a `$base_path` variable derived from `$_SERVER['PHP_SELF']` to resolve assets and includes across different directory levels (root, `/admin`, `/student`).
- **Database:** Standardize on PDO with support for both MySQL and SQLite. SQLite is used for local development and verification.
- **Authentication:** Role-based access control (RBAC) implemented via sessions (`$_SESSION['role']`).

## UI/UX
- **Visuals:** Integrated Chart.js for student performance visualization.
- **Styling:** Centralized `assets/style.css` for consistent professional branding.

## Deployment
- Ensure `uploads/` directory exists with appropriate permissions.
- Initialize database using `database.sqlite.sql` for SQLite or `database.sql` for MySQL.
