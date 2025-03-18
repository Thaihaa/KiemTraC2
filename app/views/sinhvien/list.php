<?php require_once APP_PATH . '/views/shared/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Danh sách sinh viên</h2>
        <a href="<?php echo BASE_URL; ?>/sinhvien/create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm sinh viên mới
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Mã SV</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Hình</th>
                        <th>Mã Ngành</th>
                        <th style="width: 150px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (isset($result) && $result instanceof PDOStatement): 
                        $data = $result->fetchAll(PDO::FETCH_ASSOC);
                        if (count($data) > 0):
                            foreach ($data as $row):
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row['masv'] ?? '') ?></td>
                                <td><a href="<?= BASE_URL ?>/sinhvien/detail?id=<?= htmlspecialchars($row['masv'] ?? '') ?>">
                                    <?= htmlspecialchars($row['hoten'] ?? '') ?></a></td>
                                <td><?= htmlspecialchars($row['gioitinh'] ?? '') ?></td>
                                <td><?= isset($row['ngaysinh']) ? date('d/m/Y', strtotime($row['ngaysinh'])) : '' ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['hinh'])): ?>
                                        <img src="<?= BASE_URL . '/' . htmlspecialchars($row['hinh']) ?>" 
                                             alt="Hình sinh viên" 
                                             class="img-thumbnail" 
                                             style="max-width: 50px;">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['manganh'] ?? '') ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>/sinhvien/edit?id=<?= htmlspecialchars($row['masv'] ?? '') ?>" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="<?= BASE_URL ?>/sinhvien/delete?id=<?= htmlspecialchars($row['masv'] ?? '') ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Bạn có chắc muốn xóa sinh viên này?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                    <?php 
                            endforeach;
                        else:
                    ?>
                            <tr>
                                <td colspan="7" class="text-center">Không có sinh viên nào.</td>
                            </tr>
                    <?php
                        endif;
                    else:
                    ?>
                        <tr>
                            <td colspan="7" class="text-center">Có lỗi xảy ra khi tải dữ liệu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once APP_PATH . '/views/shared/footer.php'; ?> 