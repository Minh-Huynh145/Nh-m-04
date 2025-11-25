<?php
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message='';

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']==='add') {
    $zone = $_POST['zone_name'] ?? '';
    $cpu = $_POST['cpu'] ?? '';
    $gpu = $_POST['gpu'] ?? '';
    $ram = $_POST['ram'] ?? '';
    $monitor = $_POST['monitor'] ?? '';
    $mouse = $_POST['mouse'] ?? '';
    $kb = $_POST['kb'] ?? '';
    $headset = $_POST['headset'] ?? '';
    $price = floatval($_POST['price'] ?? 0);
    if ($zone) {
        $stmt = $mysqli->prepare('INSERT INTO cauhinh (zone_name,cpu,gpu,ram,monitor,mouse,kb,headset,price) VALUES (?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('ssssssssd',$zone,$cpu,$gpu,$ram,$monitor,$mouse,$kb,$headset,$price);
        $stmt->execute();
        $stmt->close();
        $message='Đã thêm cấu hình';
    } else $message='Vui lòng nhập tên khu vực';
}

$rows=[];
$res = $mysqli->query('SELECT * FROM cauhinh ORDER BY id ASC');
while($r=$res->fetch_assoc()) $rows[]=$r;
$res->close();

include 'header.php';
?>
<h1>Quản lý cấu hình</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
<form method="post" class="form">
  <input type="hidden" name="action" value="add">
  <label>Tên khu vực (zone_name)<br><input name="zone_name" required></label>
  <label>CPU<br><input name="cpu"></label>
  <label>GPU<br><input name="gpu"></label>
  <label>RAM<br><input name="ram"></label>
  <label>Monitor<br><input name="monitor"></label>
  <label>Mouse<br><input name="mouse"></label>
  <label>Keyboard<br><input name="kb"></label>
  <label>Headset<br><input name="headset"></label>
  <label>Giá (VND/giờ)<br><input name="price" type="number" step="0.01"></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li><?php echo htmlspecialchars($r['zone_name']); ?> - <?php echo htmlspecialchars($r['cpu']); ?> - <a href="cauhinh.php?delete=<?php echo $r['id']; ?>">Xóa</a></li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>