<?php
// admin_dashboard.php - dashboard đơn giản (chỉ cho admin)
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
include 'header.php';
?>
<h1>Admin Dashboard</h1>
<ul>
  <li><a href="admin_manage_home.php">Quản lý Trang chủ (banner)</a></li>
  <li><a href="admin_manage_social.php">Quản lý MXH</a></li>
  <li><a href="admin_manage_diachi.php">Quản lý cơ sở</a></li>
  <li><a href="admin_manage_cauhinh.php">Quản lý cấu hình</a></li>
  <li><a href="admin_manage_dichvu.php">Quản lý F&B</a></li>
  <li><a href="admin_manage_khuyenmai.php">Quản lý khuyến mãi</a></li>
  <li><a href="admin_manage_news.php">Quản lý tin tức</a></li>
</ul>
<?php include 'footer.php'; ?>