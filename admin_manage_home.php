<?php
// Quản lý banner trên trang chủ
require_once 'functions.php';
if (!is_admin()) redirect('login.php');
$mysqli = db_connect();
$message = '';

// handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $banner = $_POST['banner'] ?? '';

    // kiểm tra xem có file upload không
    if ($banner && isset($_FILES['img']) && $_FILES['img']['error'] === 0) {

        // tạo thư mục upload nếu chưa có
        if (!is_dir('assets')) mkdir('assets');

        $filename = time() . '_' . basename($_FILES['img']['name']);
        $target_path = 'assets/' . $filename;

        // lưu file vào thư mục
        if (move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {

            // CHỈ LƯU TÊN FILE VÀO DB
            $stmt = $mysqli->prepare('INSERT INTO trangchu (banner, img) VALUES (?, ?)');
            $stmt->bind_param('ss', $banner, $filename);
            $stmt->execute();
            $stmt->close();

            $message = 'Đã thêm banner';
        } else {
            $message = 'Lỗi khi tải ảnh lên.';
        }

    } else {
        $message = 'Vui lòng nhập đầy đủ và chọn ảnh.';
    }
}

// fetch
$rows = [];
$res = $mysqli->query('SELECT * FROM trangchu ORDER BY id DESC');
while($r=$res->fetch_assoc()) $rows[] = $r;
$res->close();

include 'header.php';
?>
<h1>Quản lý banner</h1>
<?php if($message): ?><div class="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data">
  <input type="hidden" name="action" value="add">
  <label>Tên banner<br><input name="banner" required></label>
  <label>Ảnh<br><input type="file" name="img" accept="image/*" required></label>
  <button class="btn" type="submit">Thêm</button>
</form>

<h2>Danh sách</h2>
<ul>
<?php foreach($rows as $r): ?>
  <li><?php echo htmlspecialchars($r['banner']); ?> - <a href="index.php?delete_banner=<?php echo $r['id']; ?>">Xóa</a></li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>