<?php
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message='';

$uploadDir = 'assets/'; // thư mục lưu ảnh
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']==='add') {
    $tintuc = $_POST['tintuc'] ?? '';
    $imgPath = '';

    // Kiểm tra file upload
    if (!empty($_FILES['img']['name'])) {
        $fileName = basename($_FILES['img']['name']);
        $targetFile = $uploadDir . time() . '_' . $fileName; // thêm time() để tránh trùng tên
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra định dạng file ảnh
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

    if ($tintuc && !$message) {
        $stmt = $mysqli->prepare('INSERT INTO news (tintuc,img) VALUES (?, ?)');
        $stmt->bind_param('ss', $tintuc, $imgPath);
        $stmt->execute();
        $stmt->close();
        $message = 'Đã thêm tin tức';
    } elseif (!$tintuc) {
        $message = 'Vui lòng nhập nội dung';
    }
}

$rows=[];
$res = $mysqli->query('SELECT * FROM news ORDER BY id DESC');
while($r=$res->fetch_assoc()) $rows[]=$r;
$res->close();

include 'header.php';
?>

<h1>Quản lý tin tức</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form">
  <input type="hidden" name="action" value="add">
  <label>Nội dung tin tức<br><textarea name="tintuc" required></textarea></label>
  <label>Chọn ảnh từ thiết bị<br><input type="file" name="img" accept="image/*"></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li>
    <?php echo htmlspecialchars(substr($r['tintuc'],0,120)); ?>...
    <?php if($r['img']): ?>
      <br><img src="<?php echo htmlspecialchars($r['img']); ?>" style="max-width:150px;">
    <?php endif; ?>
    - <a href="tintuc.php?delete=<?php echo $r['id']; ?>">Xóa</a>
  </li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>
