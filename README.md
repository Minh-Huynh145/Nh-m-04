Genus Gaming - Web quản lý quán net
---------------------------------

Hướng dẫn nhanh:
1. Import file `database.sql` vào phpMyAdmin để tạo database và bảng.
2. Chỉnh sửa `functions.php` để đặt đúng thông tin MySQL (DB_USER, DB_PASS).
3. Upload toàn bộ thư mục lên máy chủ Apache/PHP hoặc đặt vào htdocs (XAMPP).
4. Truy cập `setup_admin.php` (nếu cần) để tạo tài khoản admin, hoặc tự thêm admin qua phpMyAdmin.
5. Đăng ký tài khoản => đăng nhập => admin có thể quản lý các phần.

Ghi chú:
- Tên admin mặc định cần tạo bằng `setup_admin.php` hoặc thêm trực tiếp trong DB.
- Các hình ảnh được tham chiếu bằng URL. Bạn có thể upload ảnh vào thư mục `assets/` rồi dùng đường dẫn tương đối `assets/img.jpg`.
