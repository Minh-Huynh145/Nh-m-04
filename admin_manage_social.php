<?php
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message = '';

$uploadDir = 'assets/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $mxh = $_POST['mxh'] ?? '';
    $url = $_POST['url'] ?? '';
    $imgPath = '';

    if ($mxh && $url) {
        // Xử lý upload ảnh
        if (!empty($_FILES['img']['name'])) {
            $filename = time() . '_' . basename($_FILES['img']['name']);
            $target = $uploadDir . $filename;
            $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg','jpeg','png','gif'];

            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
                    $imgPath = $filename;
                } else {
                    $message = 'Lỗi khi upload ảnh';
                }
            } else {
                $message = 'Chỉ cho phép ảnh JPG, PNG, GIF.';
            }
        }

        $stmt = $mysqli->prepare('INSERT INTO social (mxh, url, img) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $mxh, $url, $imgPath);
        $stmt->execute();
        $stmt->close();

        if (!$message) $message = 'Đã thêm mạng xã hội';
    } else {
        $message = 'Vui lòng nhập đầy đủ';
    }
}

$rows = [];
$res = $mysqli->query('SELECT * FROM social ORDER BY id DESC');
while($r = $res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>

<h1>Quản lý MXH</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data">
  <input type="hidden" name="action" value="add">
  <label>Tên MXH<br><input name="mxh" required></label>
  <label>URL<br><input name="url" required></label>
  <label>Ảnh (tùy chọn)<br><input type="file" name="img" accept="image/*"></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li>
    <?php echo htmlspecialchars($r['mxh']); ?> 
    <?php if($r['img']): ?>
        <br><img src="assets/<?php echo htmlspecialchars($r['img']); ?>" style="max-width:100px;">
    <?php endif; ?>
    - <a href="index.php?delete_social=<?php echo $r['id']; ?>">Xóa</a>
  </li>
<?php endforeach; ?>
</ul>

<?php include 'footer.php'; ?>
