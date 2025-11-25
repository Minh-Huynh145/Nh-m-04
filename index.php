<?php
// index.php - trang chủ với banner và social (admin có quyền thêm/xóa)
require_once 'functions.php';
include 'header.php';

$mysqli = db_connect();

// handle delete banner (admin)
if (isset($_GET['delete_banner']) && is_admin()) {
    $id = intval($_GET['delete_banner']);
    $stmt = $mysqli->prepare('DELETE FROM trangchu WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('index.php');
}

// fetch banners
$banners = [];
$res = $mysqli->query('SELECT * FROM trangchu ORDER BY id DESC');
while($r = $res->fetch_assoc()) $banners[] = $r;
$res->close();

// handle delete social (admin)
if (isset($_GET['delete_social']) && is_admin()) {
    $id = intval($_GET['delete_social']);
    $stmt = $mysqli->prepare('DELETE FROM social WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('index.php');
}

// fetch social
$socials = [];
$res = $mysqli->query('SELECT * FROM social ORDER BY id DESC');
while($r = $res->fetch_assoc()) $socials[] = $r;
$res->close();
?>

<link rel="stylesheet" href="css/style.css">

<h1>Trang chủ</h1>

<section class="banners">
  <h2>Banners</h2>
  <div class="banner-slider">
    <?php foreach($banners as $b): ?>
      <div class="banner-slide">
        <img src="assets/<?php echo htmlspecialchars($b['img']); ?>" alt="<?php echo htmlspecialchars($b['banner']); ?>">
        <div class="banner-name"><?php echo htmlspecialchars($b['banner']); ?></div>
        <?php if(is_admin()): ?>
          <a class="btn small" href="index.php?delete_banner=<?php echo $b['id']; ?>">Xóa</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if(is_admin()): ?>
    <a href="admin_manage_home.php" class="btn">Quản lý banner</a>
  <?php endif; ?>
</section>

<section class="socials">
  <h2>Mạng xã hội</h2>
  <div class="social-list">
    <?php foreach($socials as $s): ?>
      <a class="social-item" href="<?php echo htmlspecialchars($s['url']); ?>" target="_blank">
        <?php if($s['img']): ?>
          <img src="assets/<?php echo htmlspecialchars($s['img']); ?>" alt="<?php echo htmlspecialchars($s['mxh']); ?>">
        <?php endif; ?>
        <span><?php echo htmlspecialchars($s['mxh']); ?></span>
      </a>
    <?php endforeach; ?>
  </div>
  <?php if(is_admin()): ?>
    <a href="admin_manage_social.php" class="btn">Quản lý MXH</a>
  <?php endif; ?>
</section>

<script src="js/main.js"></script>
<?php include 'footer.php'; ?>