<?php
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message='';

$uploadDir = 'assets/'; // thư mục lưu ảnh
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']==='add') {
    $type = $_POST['type'] ?? 'food';
    $name = $_POST['name'] ?? '';
    $price = floatval($_POST['price'] ?? 0);
    $imgPath = '';

    // Xử lý file upload
    if (!empty($_FILES['img']['name'])) {
        $fileName = basename($_FILES['img']['name']);
        $targetFile = $uploadDir . time() . '_' . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg','jpeg','png','gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                $imgPath = $targetFile;
            } else {
                $message = 'Không thể tải ảnh lên.';
            }
        } else {
            $message = 'Chỉ cho phép ảnh JPG, PNG, GIF.';
        }
    }

    if ($name && !$message) {
        if ($type === 'food') {
            $stmt = $mysqli->prepare('INSERT INTO dichvu (food,price,img) VALUES (?, ?, ?)');
            $stmt->bind_param('sds', $name, $price, $imgPath);
        } elseif ($type === 'drink') {
            $stmt = $mysqli->prepare('INSERT INTO dichvu (drink,price,img) VALUES (?, ?, ?)');
            $stmt->bind_param('sds', $name, $price, $imgPath);
        } else {
            $stmt = $mysqli->prepare('INSERT INTO dichvu (khac,price,img) VALUES (?, ?, ?)');
            $stmt->bind_param('sds', $name, $price, $imgPath);
        }
        $stmt->execute();
        $stmt->close();
        $message='Đã thêm dịch vụ';
    } elseif (!$name) {
        $message='Vui lòng nhập tên';
    }
}

$rows=[];
$res = $mysqli->query('SELECT * FROM dichvu ORDER BY id DESC');
while($r=$res->fetch_assoc()) $rows[]=$r;
$res->close();

include 'header.php';
?>
<h1>Quản lý F&B</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form">
  <input type="hidden" name="action" value="add">
  <label>Bạn muốn thêm dịch vụ gì?<br>
    <select name="type">
      <option value="food">Thức ăn</option>
      <option value="drink">Nước uống</option>
      <option value="khac">Khác</option>
    </select>
  </label>
  <label>Tên dịch vụ<br><input name="name" required></label>
  <label>Giá (VND)<br><input name="price" type="number" step="0.01"></label>
  <label>Chọn ảnh từ thiết bị<br><input type="file" name="img" accept="image/*"></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li>
    <?php echo htmlspecialchars($r['food'] ?: $r['drink'] ?: $r['khac']); ?> - <?php echo htmlspecialchars($r['price']); ?>
    <?php if($r['img']): ?>
      <br><img src="<?php echo htmlspecialchars($r['img']); ?>" style="max-width:150px;">
    <?php endif; ?>
    - <a href="fb.php?delete=<?php echo $r['id']; ?>">Xóa</a>
  </li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>
