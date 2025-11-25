<?php
// setup_admin.php - chạy lần đầu để tạo tài khoản admin (nếu bạn muốn)
// LƯU Ý: sau khi chạy và xác nhận admin đã được tạo, bạn nên xóa file này để bảo mật.

require_once 'functions.php';
$mysqli = db_connect();

$admin_user = 'admin';
$admin_pass = 'admin123'; // bạn nên đổi mật khẩu sau khi đăng nhập

// kiểm tra tồn tại
$stmt = $mysqli->prepare('SELECT id FROM taikhoan WHERE username = ?');
$stmt->bind_param('s', $admin_user);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    $stmt->close();
    $hash = password_hash($admin_pass, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare('INSERT INTO taikhoan (username,password) VALUES (?, ?)');
    $stmt->bind_param('ss', $admin_user, $hash);
    if ($stmt->execute()) {
        echo 'Admin đã được tạo. Username: ' . $admin_user . ' Password: ' . $admin_pass;
    } else {
        echo 'Lỗi khi tạo admin';
    }
    $stmt->close();
} else {
    echo 'Admin đã tồn tại.';
}
?>