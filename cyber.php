<?php
require_once 'functions.php';
$mysqli = db_connect();

// handle delete (admin)
if (isset($_GET['delete']) && is_admin()) {
    $id = intval($_GET['delete']);
    $stmt = $mysqli->prepare('DELETE FROM diachi WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('cyber.php');
}

// fetch addresses
$rows = [];
$res = $mysqli->query('SELECT * FROM diachi ORDER BY id DESC');
while($r = $res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>
<main>
<h1>Cyber - Các cơ sở</h1>
<div class="grid">
<?php foreach($rows as $row): ?>
  <div class="card">
    <h3><?php echo htmlspecialchars($row['tencoso']); ?></h3>
    <p><?php echo htmlspecialchars($row['vitri']); ?></p>
    <?php if(is_admin()): ?>
      <a class="btn small" href="cyber.php?delete=<?php echo $row['id']; ?>">Xóa</a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>
<?php if(is_admin()): ?>
  <a href="admin_manage_diachi.php" class="btn">Quản lý cơ sở</a>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>