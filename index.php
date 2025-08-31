<?php session_start(); ?>
<?php /* removed base include */ include __DIR__.'/includes/head.php'; ?>
<title>EWU Library Management System</title>
<style>

/* Minimal clean look inspired by EWU library site */
:root{--brand:#0d3b66;--accent:#f4d35e;--light:#f7f7fb;}
*{box-sizing:border-box}
body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#fff;color:#123}
a{color:var(--brand);text-decoration:none}
.header{display:flex;gap:16px;align-items:center;padding:14px 20px;border-bottom:3px solid var(--brand);background:linear-gradient(180deg,#fff 0,#eef5ff 100%)}
.header img{height:56px;width:56px;border-radius:50%;object-fit:cover;border:2px solid var(--brand)}
.header h1{margin:0;font-size:22px;color:var(--brand)}
.nav{display:flex;gap:14px;flex-wrap:wrap;margin-top:8px}
.nav a{padding:8px 12px;border:1px solid #cdd;border-radius:10px;background:#fff}
.hero{background:url('./assets/images/ewu_campus.jpg') center/cover no-repeat;min-height:260px;display:flex;align-items:center}
.hero .overlay{background:rgba(13,59,102,.70);padding:28px;border-radius:16px;margin:20px;color:#fff}
.container{max-width:1050px;margin:20px auto;padding:0 16px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px}
.card{border:1px solid #e1e5ee;border-radius:16px;box-shadow:0 8px 24px rgba(0,0,0,.05);overflow:hidden;background:#fff}
.card header{padding:12px 16px;background:#f6f8ff;border-bottom:1px solid #e6e9f2;font-weight:600;color:#0d3b66}
.card .content{padding:16px}
.btn{display:inline-block;padding:10px 14px;border-radius:10px;border:1px solid var(--brand);background:var(--brand);color:#fff}
.btn.outline{background:#fff;color:var(--brand)}
.table{width:100%;border-collapse:collapse}
.table th,.table td{padding:10px;border-bottom:1px solid #e6e6ef;text-align:left}
.footer{margin-top:40px;padding:18px;color:#345;background:#f8fafc;border-top:1px solid #e6edf7}
form .row{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px}
input,select{padding:10px;border:1px solid #cfd7e3;border-radius:8px;width:100%}
.alert{padding:10px;border-radius:8px;background:#eaf7ff;border:1px solid #bee3ff;color:#0d3b66;margin-bottom:12px}

</style>
</head>
<body>
<header class="header">
  <img src="assets/images/ewu_library_logo.jpg" alt="EWU Library">
  <div>
    <h1>Dr. S. R. Lasker Library – EWU</h1>
    <div class="nav">
      <a href="/index.php">Home</a>
      <a href="search.php">Search Books</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>
  </div>
</header>

<section class="hero">
  <div class="overlay">
    <h2>Gateway to Knowledge</h2>
    <p>Find, borrow, and manage books with a clean interface inspired by the official EWU Library site.</p>
    <a class="btn" href="search.php">Start Searching</a>
  </div>
</section>

<?php if(function_exists('date')): ?>
<div class="container"><div class="alert">PHP is running. Server time: <?= date('Y-m-d H:i:s') ?></div>
<?php else: ?>
<div class="container"><div class="alert">If you see this but no time, PHP may not be executing.</div>
<?php endif; ?>
<div class="container">
  <div class="grid">
    <div class="card">
      <header>Modern Library Interior</header>
      <div class="content">
        <img src="assets/images/ewu_library_inside.jpg" alt="Library interior" style="width:100%;height:160px;object-fit:cover;border-radius:12px">
        <p>Browse thousands of titles across departments and subjects.</p>
      </div>
    </div>
    <div class="card">
      <header>Accounts</header>
      <div class="content">
        <p>Create an account as <strong>User</strong>, <strong>Librarian</strong>, or <strong>Admin</strong>. Role-based access controls gate features.</p>
        <a class="btn" href="register.php">Create Account</a>
      </div>
    </div>
    <div class="card">
      <header>Reports & Fines</header>
      <div class="content">
        <p>Admins can view transactions, overdue items, and fine collections.</p>
        <a class="btn outline" href="login.php">Go to Dashboard</a>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
  © East West University Library Management System — demo project for XAMPP
</footer>
</body>
</html>
