<?php
// header.php - top navigation included across pages
require_once 'functions.php';
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Genus Gaming</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <div class="brand">Genus Gaming</div>
      <nav class="main-nav">
        <a href="index.php" class="nav-item">Trang chủ</a>
        <a href="cyber.php" class="nav-item">Cyber</a>
        <a href="cauhinh.php" class="nav-item">Cấu hình</a>
        <a href="fb.php" class="nav-item">F&B</a>
        <a href="khuyenmai.php" class="nav-item">Khuyến mãi</a>
        <a href="tintuc.php" class="nav-item">Tin tức</a>
      </nav>
      <div class="auth">
        <?php if(isset($_SESSION['username'])): ?>
          <span class="user">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
          <a href="logout.php" class="btn">Đăng xuất</a>
        <?php else: ?>
          <a href="register.php" class="btn register">Đăng ký</a>
          <a href="login.php" class="btn">Đăng nhập</a>
        <?php endif; ?>
      </div>
    </div>
  </header>
  <main class="container">
