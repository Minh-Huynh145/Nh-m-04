<?php
// register.php - đăng ký tài khoản mới
require_once 'functions.php';

$mysqli = db_connect();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $message = 'Vui lòng điền đầy đủ thông tin.';
    } else {
        // kiểm tra tồn tại username
        $stmt = $mysqli->prepare('SELECT id FROM taikhoan WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = 'Tài khoản đã tồn tại.';
        } else {
            $stmt->close();
            // lưu password bằng password_hash
            $stmt = $mysqli->prepare('INSERT INTO taikhoan (username,password) VALUES (?, ?)');
            $stmt->bind_param('ss', $username, $password);
            if ($stmt->execute()) {
                // đăng ký thành công -> thông báo và chuyển sang trang đăng nhập
                $_SESSION['reg_success'] = 'Đăng ký thành công';
                redirect('login.php');
            } else {
                $message = 'Lỗi khi lưu dữ liệu.';
            }
        }
        $stmt->close();
    }
}

include 'header.php';
?>
<main>
<h1>Đăng ký</h1>
<?php if($message): ?>
  <div class="alert"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<form method="post" class="form">
  <label>Tên đăng nhập<br>
    <input type="text" name="username" required>
  </label>
  <label>Mật khẩu<br>
    <input type="password" name="password" required>
  </label>
  <button class="btn" type="submit">Đăng ký</button>
</form>
</main>
<?php include 'footer.php'; ?>