<?php
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message='';

$uploadDir = 'assets/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']==='add') {
    $ten = $_POST['tenkhuyenmai'] ?? '';
    $imgPath = '';

    // Xử lý upload file
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

    if ($ten && !$message) {
        $stmt = $mysqli->prepare('INSERT INTO khuyenmai (tenkhuyenmai,img) VALUES (?, ?)');
        $stmt->bind_param('ss', $ten, $imgPath);
        $stmt->execute();
        $stmt->close();
        $message='Đã thêm khuyến mãi';
    } elseif (!$ten) {
        $message='Vui lòng nhập tên';
    }
}

$rows=[];
$res = $mysqli->query('SELECT * FROM khuyenmai ORDER BY id DESC');
while($r=$res->fetch_assoc()) $rows[]=$r;
$res->close();

include 'header.php';
?>
<h1>Quản lý khuyến mãi</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form">
  <input type="hidden" name="action" value="add">
  <label>Tên khuyến mãi<br><input name="tenkhuyenmai" required></label>
  <label>Chọn ảnh từ thiết bị<br><input type="file" name="img" accept="image/*"></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li>
    <?php echo htmlspecialchars($r['tenkhuyenmai']); ?>
    <?php if($r['img']): ?>
      <br><img src="<?php echo htmlspecialchars($r['img']); ?>" style="max-width:150px;">
    <?php endif; ?>
    - <a href="khuyenmai.php?delete=<?php echo $r['id']; ?>">Xóa</a>
  </li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>
