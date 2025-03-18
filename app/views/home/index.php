<?php require_once APP_PATH . '/views/shared/header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Chào mừng đến với hệ thống quản lý sinh viên</h1>
        <p class="lead">Hệ thống giúp quản lý thông tin sinh viên một cách hiệu quả</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="d-grid gap-3">
                <a href="<?= BASE_URL ?>/sinhvien/index" class="btn btn-primary btn-lg">
                    <i class="fas fa-list"></i> Xem danh sách sinh viên
                </a>
                <a href="<?= BASE_URL ?>/sinhvien/create" class="btn btn-success btn-lg">
                    <i class="fas fa-user-plus"></i> Thêm sinh viên mới
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Quản lý sinh viên</h5>
                    <p class="card-text">Thêm, sửa, xóa và xem thông tin chi tiết của sinh viên</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-search fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Tìm kiếm nhanh</h5>
                    <p class="card-text">Dễ dàng tìm kiếm thông tin sinh viên theo nhiều tiêu chí</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-chart-bar fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Thống kê</h5>
                    <p class="card-text">Xem báo cáo và thống kê về dữ liệu sinh viên</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_PATH . '/views/shared/footer.php'; ?> 