<?php
require_once 'functions.php';
$mysqli = db_connect();

// handle delete (admin)
if (isset($_GET['delete']) && is_admin()) {
    $id = intval($_GET['delete']);
    $stmt = $mysqli->prepare('DELETE FROM cauhinh WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('cauhinh.php');
}

// fetch configs
$rows = [];
$res = $mysqli->query('SELECT * FROM cauhinh ORDER BY id ASC');
while($r = $res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>
<main>
<h1>Cấu hình</h1>
<div class="grid">
<?php foreach($rows as $row): ?>
  <div class="card zone">
    <h3><?php echo htmlspecialchars($row['zone_name']); ?></h3>
    <ul>
      <li>CPU: <?php echo htmlspecialchars($row['cpu']); ?></li>
      <li>GPU: <?php echo htmlspecialchars($row['gpu']); ?></li>
      <li>RAM: <?php echo htmlspecialchars($row['ram']); ?></li>
      <li>Monitor: <?php echo htmlspecialchars($row['monitor']); ?></li>
      <li>Mouse: <?php echo htmlspecialchars($row['mouse']); ?></li>
      <li>Keyboard: <?php echo htmlspecialchars($row['kb']); ?></li>
      <li>Headset: <?php echo htmlspecialchars($row['headset']); ?></li>
      <li>Price: <?php echo htmlspecialchars($row['price']); ?> VND/giờ</li>
    </ul>
    <?php if(is_admin()): ?>
      <a class="btn small" href="cauhinh.php?delete=<?php echo $row['id']; ?>">Xóa</a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>
<?php if(is_admin()): ?>
  <a href="admin_manage_cauhinh.php" class="btn">Quản lý cấu hình</a>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>