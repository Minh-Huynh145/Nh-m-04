<?php
require_once 'functions.php';
$mysqli = db_connect();

if (isset($_GET['delete']) && is_admin()) {
    $id = intval($_GET['delete']);
    $stmt = $mysqli->prepare('DELETE FROM khuyenmai WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('khuyenmai.php');
}

$rows = [];
$res = $mysqli->query('SELECT * FROM khuyenmai ORDER BY id DESC');
while($r = $res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>
<main>
<h1>Khuyến mãi</h1>
<div class="grid">
<?php foreach($rows as $row): ?>
  <div class="card">
    <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="">
    <h3><?php echo htmlspecialchars($row['tenkhuyenmai']); ?></h3>
    <?php if(is_admin()): ?>
      <a class="btn small" href="khuyenmai.php?delete=<?php echo $row['id']; ?>">Xóa</a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>
<?php if(is_admin()): ?>
  <a href="admin_manage_khuyenmai.php" class="btn">Quản lý khuyến mãi</a>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>