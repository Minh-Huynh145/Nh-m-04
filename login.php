<?php
// login.php - đăng nhập
require_once 'functions.php';
$mysqli = db_connect();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $message = 'Vui lòng điền đầy đủ thông tin.';
    } else {
        $stmt = $mysqli->prepare('SELECT id, password FROM taikhoan WHERE username = ?');
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
            // username không tồn tại
            $message = 'Tài khoản chưa được đăng ký';
        } else {
            $stmt->bind_result($id,$hash);
            $stmt->fetch();
            if ($password===$hash) {
                // đăng nhập thành công
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                redirect('index.php');
            } else {
                // username tồn tại nhưng sai mật khẩu
                $message = 'Sai tên đăng nhập hoặc mật khẩu';
            }
        }
        $stmt->close();
    }
}

include 'header.php';
?>
<main>
<h1>Đăng nhập</h1>
<?php if(isset($_SESSION['reg_success'])): ?>
  <div class="alert"><?php echo htmlspecialchars($_SESSION['reg_success']); unset($_SESSION['reg_success']); ?></div>
<?php endif; ?>
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
  <button class="btn" type="submit">Đăng nhập</button>
</form>
</main>
<?php include 'footer.php'; ?>