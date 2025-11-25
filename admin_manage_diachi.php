<?php
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message='';

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']==='add') {
    $tencoso = $_POST['tencoso'] ?? '';
    $vitri = $_POST['vitri'] ?? '';
    if ($tencoso && $vitri) {
        $stmt = $mysqli->prepare('INSERT INTO diachi (tencoso,vitri) VALUES (?, ?)');
        $stmt->bind_param('ss',$tencoso,$vitri);
        $stmt->execute();
        $stmt->close();
        $message='Đã thêm cơ sở';
    } else $message='Vui lòng nhập đầy đủ';
}

$rows=[];
$res = $mysqli->query('SELECT * FROM diachi ORDER BY id DESC');
while($r=$res->fetch_assoc()) $rows[]=$r;
$res->close();

include 'header.php';
?>
<h1>Quản lý cơ sở</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
<form method="post" class="form">
  <input type="hidden" name="action" value="add">
  <label>Tên cơ sở<br><input name="tencoso" required></label>
  <label>Địa chỉ (vị trí)<br><input name="vitri" required></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li><?php echo htmlspecialchars($r['tencoso']); ?> - <?php echo htmlspecialchars($r['vitri']); ?> - <a href="cyber.php?delete=<?php echo $r['id']; ?>">Xóa</a></li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>