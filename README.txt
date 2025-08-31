
EWU Library Management System — PHP + MySQL (XAMPP)
===================================================

Quick setup
-----------
1) Copy the entire `ewu_lms` folder into `C:\xampp\htdocs\` (Windows) or `/Applications/XAMPP/htdocs/` (macOS).
2) Start Apache and MySQL in XAMPP Control Panel.
3) Open phpMyAdmin and run the SQL script:
   - Import `database.sql` (creates DB `ewu_lms`, tables, and sample data).
4) Visit: http://localhost/ewu_lms/
5) Login:
   - Admin: email `admin@ewu.edu`, password `admin123`

Roles
-----
- user: search/borrow/reserve, view own loans & reservations
- librarian: manage books, issue/return, reservations, fines, reports
- admin: everything + view users

Structure
---------
/includes/db.php        → DB connection
/includes/auth.php      → sessions & role helpers
/index.php              → home (uses your provided images)
/login.php, /register.php, /dashboard.php
/search.php             → public search + borrow/reserve actions
/admin/*                → books, loans, reservations, fines, reports, users
/user/*                 → my_loans, my_reservations
/actions/*              → POST handlers
/assets/images/*        → your provided images are here
/assets/style.css       → minimal styling

Fines
-----
- On return: fine = max(0, DATEDIFF(return_date, due_date)) × 5 taka/day.
- Mark as paid in Admin → Fines.

Emails/SMS
----------
- For the assignment, notifications are placeholders (no SMTP configured).

Troubleshooting "looks static"
------------------------------
If the page looks like a plain static site (no login, no PHP processing), you're likely opening
`index.php` via `file:///` or using a static server (e.g., VS Code Live Server).
**Always run through XAMPP Apache** and use a `http://localhost/...` URL.

Checklist:
- Start Apache & MySQL in XAMPP
- Put the folder in `htdocs` (e.g., `C:\xampp\htdocs\ewu_lms`)
- Visit `http://localhost/ewu_lms/` (NOT double-clicking index.php)
- Import `database.sql` in phpMyAdmin
- Test PHP: create `phpinfo.php` with `<?php phpinfo(); ?>` and open via `http://localhost/phpinfo.php`


Admin password reset (local dev)
--------------------------------
1) Visit http://localhost/ewu_lms/tools/reset_admin.php
2) It will set admin@ewu.edu to admin123 (or create it if missing).
3) Delete the tools/ folder before submitting your assignment.
