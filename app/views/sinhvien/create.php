<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Thêm sinh viên mới</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo BASE_URL; ?>/sinhvien/store" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="masv" class="form-label">Mã sinh viên</label>
                                <input type="text" class="form-control" id="masv" name="masv" required>
                            </div>

                            <div class="mb-3">
                                <label for="hoten" class="form-label">Họ tên</label>
                                <input type="text" class="form-control" id="hoten" name="hoten" required>
                            </div>

                            <div class="mb-3">
                                <label for="gioitinh" class="form-label">Giới tính</label>
                                <select class="form-control" id="gioitinh" name="gioitinh" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ngaysinh" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" required>
                            </div>

                            <div class="mb-3">
                                <label for="hinh" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="hinh" name="hinh">
                            </div>

                            <div class="mb-3">
                                <label for="manganh" class="form-label">Mã ngành</label>
                                <input type="text" class="form-control" id="manganh" name="manganh" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
                                <a href="<?php echo BASE_URL; ?>" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 