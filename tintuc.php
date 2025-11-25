<?php
require_once 'functions.php';
$mysqli = db_connect();

if (isset($_GET['delete']) && is_admin()) {
    $id = intval($_GET['delete']);
    $stmt = $mysqli->prepare('DELETE FROM news WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    redirect('tintuc.php');
}

$rows = [];
$res = $mysqli->query('SELECT * FROM news ORDER BY id DESC');
while($r = $res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>
<main>
<h1>Tin tức</h1>
<div class="grid">
<?php foreach($rows as $row): ?>
  <div class="card">
    <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="">
    <p><?php echo nl2br(htmlspecialchars($row['tintuc'])); ?></p>
    <?php if(is_admin()): ?>
      <a class="btn small" href="tintuc.php?delete=<?php echo $row['id']; ?>">Xóa</a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
</div>
<?php if(is_admin()): ?>
  <a href="admin_manage_news.php" class="btn">Quản lý tin tức</a>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>