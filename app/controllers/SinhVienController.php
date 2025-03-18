<?php
require_once APP_PATH . '/models/SinhVienModel.php';
require_once APP_PATH . '/config/database.php';

class SinhVienController {
    private $sinhVienModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sinhVienModel = new SinhVienModel($this->db);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        try {
            $result = $this->sinhVienModel->getAll();
            require_once APP_PATH . '/views/sinhvien/list.php';
        } catch (Exception $e) {
            echo "Có lỗi xảy ra: " . $e->getMessage();
        }
    }

    // Hiển thị form thêm sinh viên
    public function create() {
        require_once APP_PATH . '/views/sinhvien/create.php';
    }

    // Xử lý thêm sinh viên
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Lấy dữ liệu từ form
                $data = [
                    'masv' => $_POST['masv'],
                    'hoten' => $_POST['hoten'],
                    'gioitinh' => $_POST['gioitinh'],
                    'ngaysinh' => $_POST['ngaysinh'],
                    'manganh' => $_POST['manganh'],
                    'hinh' => null
                ];

                // Xử lý upload hình ảnh
                if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] == 0) {
                    $target_dir = ROOT . "/public/uploads/";
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                        $data['hinh'] = 'public/uploads/' . basename($_FILES["hinh"]["name"]);
                    }
                }

                // Thêm sinh viên vào database
                if ($this->sinhVienModel->create($data)) {
                    header("Location: " . BASE_URL . "/sinhvien/index");
                    exit();
                } else {
                    throw new Exception("Không thể thêm sinh viên");
                }
            } catch (Exception $e) {
                echo "Có lỗi xảy ra: " . $e->getMessage();
            }
        }
    }

    // Hiển thị form sửa sinh viên
    public function edit($id = null) {
        try {
            if (!$id) {
                $id = isset($_GET['id']) ? $_GET['id'] : null;
            }
            if ($id) {
                $this->sinhVienModel->masv = $id;
                if ($this->sinhVienModel->getOne()) {
                    require_once APP_PATH . '/views/sinhvien/edit.php';
                } else {
                    throw new Exception("Không tìm thấy sinh viên với mã " . htmlspecialchars($id));
                }
            } else {
                throw new Exception("Không tìm thấy mã sinh viên");
            }
        } catch (Exception $e) {
            echo "Có lỗi xảy ra: " . $e->getMessage();
            echo "<br><a href='" . BASE_URL . "/sinhvien/index' class='btn btn-primary mt-3'>Quay lại danh sách</a>";
        }
    }

    // Xử lý cập nhật sinh viên
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Lấy dữ liệu từ form
                $this->sinhVienModel->masv = $_POST['masv'] ?? '';
                $this->sinhVienModel->hoten = $_POST['hoten'] ?? '';
                $this->sinhVienModel->gioitinh = $_POST['gioitinh'] ?? '';
                $this->sinhVienModel->ngaysinh = $_POST['ngaysinh'] ?? '';
                $this->sinhVienModel->manganh = $_POST['manganh'] ?? '';
                
                // Xử lý upload hình ảnh mới nếu có
                if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] == 0) {
                    $target_dir = ROOT . "/public/uploads/";
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                        $this->sinhVienModel->hinh = 'public/uploads/' . basename($_FILES["hinh"]["name"]);
                    }
                } else {
                    // Giữ lại hình cũ nếu không upload hình mới
                    $this->sinhVienModel->hinh = $_POST['hinh_cu'] ?? null;
                }

                // Cập nhật sinh viên
                if ($this->sinhVienModel->update()) {
                    header("Location: " . BASE_URL . "/sinhvien/index");
                    exit();
                } else {
                    throw new Exception("Không thể cập nhật thông tin sinh viên");
                }
            } catch (Exception $e) {
                echo "Có lỗi xảy ra: " . $e->getMessage();
                echo "<br><a href='" . BASE_URL . "/sinhvien/index' class='btn btn-primary mt-3'>Quay lại danh sách</a>";
            }
        }
    }

    // Xử lý xóa sinh viên
    public function delete($id = null) {
        try {
            if (!$id) {
                $id = isset($_GET['id']) ? $_GET['id'] : null;
            }
            if ($id) {
                $this->sinhVienModel->masv = $id;
                if($this->sinhVienModel->delete()) {
                    header("Location: " . BASE_URL . "/sinhvien/index");
                    exit();
                } else {
                    throw new Exception("Không thể xóa sinh viên");
                }
            } else {
                throw new Exception("Không tìm thấy sinh viên");
            }
        } catch (Exception $e) {
            echo "Có lỗi xảy ra: " . $e->getMessage();
        }
    }

    // Hiển thị thông tin chi tiết sinh viên
    public function detail($id = null) {
        try {
            if (!$id) {
                $id = isset($_GET['id']) ? $_GET['id'] : null;
            }
            if ($id) {
                $this->sinhVienModel->masv = $id;
                if ($this->sinhVienModel->getOne()) {
                    require_once APP_PATH . '/views/sinhvien/detail.php';
                } else {
                    throw new Exception("Không tìm thấy sinh viên với mã " . htmlspecialchars($id));
                }
            } else {
                throw new Exception("Không tìm thấy mã sinh viên");
            }
        } catch (Exception $e) {
            echo "Có lỗi xảy ra: " . $e->getMessage();
            echo "<br><a href='" . BASE_URL . "/sinhvien/index' class='btn btn-primary mt-3'>Quay lại danh sách</a>";
        }
    }
}
?> 