<?php require_once APP_PATH . '/views/shared/header.php'; ?>

<?php
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
        <h2 class="mb-0">Thông tin chi tiết sinh viên</h2>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Mã SV:</strong> <?= htmlspecialchars($this->sinhVienModel->masv) ?></li>
            <li class="list-group-item"><strong>Họ Tên:</strong> <?= htmlspecialchars($this->sinhVienModel->hoten) ?></li>
            <li class="list-group-item"><strong>Giới Tính:</strong> <?= htmlspecialchars($this->sinhVienModel->gioitinh) ?></li>
            <li class="list-group-item"><strong>Ngày Sinh:</strong> <?= !empty($this->sinhVienModel->ngaysinh) ? date('d/m/Y', strtotime($this->sinhVienModel->ngaysinh)) : 'Không có dữ liệu' ?></li>
            <li class="list-group-item"><strong>Mã Ngành:</strong> <?= htmlspecialchars($this->sinhVienModel->manganh) ?></li>
            <li class="list-group-item">
                <strong>Hình Ảnh:</strong><br>
                <?php if (!empty($this->sinhVienModel->hinh)): ?>
                    <img src="<?= BASE_URL . '/' . htmlspecialchars($this->sinhVienModel->hinh) ?>" 
                         alt="Hình sinh viên" class="img-thumbnail" style="max-width: 200px;">
                <?php else: ?>
                    Không có hình ảnh
                <?php endif; ?>
            </li>
        </ul>
        <a href="<?= BASE_URL ?>/sinhvien/index" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>
</div>

<?php require_once APP_PATH . '/views/shared/footer.php'; ?> 