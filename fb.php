<?php
require_once 'functions.php';
$mysqli = db_connect();

// handle delete (admin)
if (isset($_GET['delete']) && is_admin()) {
    $id = intval($_GET['delete']);
    $stmt = $mysqli->prepare('DELETE FROM dichvu WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('fb.php');
}

// fetch services
$rows = [];
$res = $mysqli->query('SELECT * FROM dichvu ORDER BY id DESC');
while($r = $res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>
<main>
<h1>F&B - Dịch vụ</h1>
<div class="nav-fb">
  <a href="#food">Thức ăn</a> | <a href="#drink">Nước uống</a> | <a href="#khac">Khác</a>
</div>

<div class="service-grid">
<?php foreach($rows as $row): ?>
  <div class="service-item" title="Giá: <?php echo htmlspecialchars($row['price']); ?>">
    <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="">
    <div class="hover-info">
      <div><?php echo htmlspecialchars($row['food'] ?: $row['drink'] ?: $row['khac']); ?></div>
      <div><?php echo htmlspecialchars($row['price']); ?> VND</div>
    </div>
    <?php if(is_admin()): ?>
      <a class="btn small" href="fb.php?delete=<?php echo $row['id']; ?>">Xóa</a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>

<?php if(is_admin()): ?>
  <a href="admin_manage_dichvu.php" class="btn">Quản lý F&B</a>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>