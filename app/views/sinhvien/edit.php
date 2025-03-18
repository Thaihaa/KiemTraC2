<?php 
require_once APP_PATH . '/views/shared/header.php';

// Kiểm tra xem có dữ liệu sinh viên không
if (!isset($this->sinhVienModel) || !isset($this->sinhVienModel->masv)) {
    echo "<div class='alert alert-danger'>Không tìm thấy thông tin sinh viên</div>";
    echo "<a href='" . BASE_URL . "/sinhvien/index' class='btn btn-primary'>Quay lại danh sách</a>";
    require_once APP_PATH . '/views/shared/footer.php';
    exit;
}
?>

<div class="card">
    <div class="card-header">
        <h2 class="mb-0">Sửa thông tin sinh viên</h2>
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/sinhvien/update" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" name="masv" value="<?= htmlspecialchars($this->sinhVienModel->masv ?? '') ?>">
            <input type="hidden" name="hinh_cu" value="<?= htmlspecialchars($this->sinhVienModel->hinh ?? '') ?>">
            
            <div class="mb-3">
                <label for="hoten" class="form-label">Họ tên <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hoten" name="hoten" 
                       value="<?= htmlspecialchars($this->sinhVienModel->hoten ?? '') ?>" required>
                <div class="invalid-feedback">Vui lòng nhập họ tên</div>
            </div>

            <div class="mb-3">
                <label for="gioitinh" class="form-label">Giới tính <span class="text-danger">*</span></label>
                <select class="form-select" id="gioitinh" name="gioitinh" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" <?= ($this->sinhVienModel->gioitinh ?? '') === 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= ($this->sinhVienModel->gioitinh ?? '') === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
                <div class="invalid-feedback">Vui lòng chọn giới tính</div>
            </div>

            <div class="mb-3">
                <label for="ngaysinh" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" 
                       value="<?= htmlspecialchars($this->sinhVienModel->ngaysinh ?? '') ?>" required>
                <div class="invalid-feedback">Vui lòng chọn ngày sinh</div>
            </div>

            <div class="mb-3">
                <label for="hinh" class="form-label">Hình ảnh</label>
                <?php if (!empty($this->sinhVienModel->hinh)): ?>
                    <div class="mb-2">
                        <img src="<?= BASE_URL . '/' . htmlspecialchars($this->sinhVienModel->hinh) ?>" 
                             alt="Hình hiện tại" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" id="hinh" name="hinh" accept="image/*">
                <div class="form-text">Để trống nếu không muốn thay đổi hình</div>
            </div>

            <div class="mb-3">
                <label for="manganh" class="form-label">Mã ngành <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="manganh" name="manganh" 
                       value="<?= htmlspecialchars($this->sinhVienModel->manganh ?? '') ?>" required>
                <div class="invalid-feedback">Vui lòng nhập mã ngành</div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật
                </button>
                <a href="<?= BASE_URL ?>/sinhvien/index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Kích hoạt validation của Bootstrap
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php require_once APP_PATH . '/views/shared/footer.php'; ?> 