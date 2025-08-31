<?php
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/auth.php';
$msg = isset($_GET['ok']) ? 'Registration successful. Please log in.' : '';
$err = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = trim($_POST['email'] ?? ''); $pass = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT id,name,email,password_hash,role FROM users WHERE email=?");
    $stmt->bind_param('s',$email); $stmt->execute(); $res = $stmt->get_result();
    if($row = $res->fetch_assoc()){
        if(password_verify($pass, $row['password_hash'])){
            $_SESSION['user'] = ['id'=>$row['id'],'name'=>$row['name'],'email'=>$row['email'],'role'=>$row['role']];
            redirect('dashboard.php');
        } else { $err = 'Invalid credentials.'; }
    } else { $err = 'User not found.'; }
}
?>
<?php /* removed base include */ include __DIR__.'/includes/head.php'; ?>
<title>Login</title>
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
  <img src="assets/images/ewu_library_logo.jpg" alt="logo"><h1>Login</h1>
</header>
<div class="container">
<?php if($msg): ?><div class="alert"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<?php if($err): ?><div class="alert"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<form method="post">
  <div class="row">
    <div><label>Email<br><input type="email" name="email" required></label></div>
    <div><label>Password<br><input type="password" name="password" required></label></div>
  </div>
  <p><button class="btn">Login</button> <a class="btn outline" href="register.php">Create account</a></p>
</form>
</div>
</body></html>
