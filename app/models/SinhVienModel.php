<?php
class SinhVienModel {
    private $conn;
    private $table_name = "sinhvien";

    public $masv;
    public $hoten;
    public $gioitinh;
    public $ngaysinh;
    public $hinh;
    public $manganh;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách sinh viên
    public function getAll() {
        try {
            $query = "SELECT masv, hoten, gioitinh, ngaysinh, hinh, manganh FROM " . $this->table_name . " ORDER BY masv ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            // Kiểm tra xem có dữ liệu không
            if ($stmt->rowCount() == 0) {
                return null;
            }
            
            return $stmt;
        } catch(PDOException $e) {
            throw new Exception("Lỗi khi lấy danh sách sinh viên: " . $e->getMessage());
        }
    }

    // Thêm sinh viên mới
    public function create($data) {
        try {
            // Kiểm tra dữ liệu
            if (empty($data['masv']) || empty($data['hoten']) || empty($data['gioitinh']) || empty($data['ngaysinh']) || empty($data['manganh'])) {
                throw new Exception("Vui lòng điền đầy đủ thông tin bắt buộc");
            }

            $query = "INSERT INTO " . $this->table_name . " 
                    (masv, hoten, gioitinh, ngaysinh, hinh, manganh) 
                    VALUES 
                    (:masv, :hoten, :gioitinh, :ngaysinh, :hinh, :manganh)";

            $stmt = $this->conn->prepare($query);

            // Làm sạch và bind dữ liệu
            $masv = htmlspecialchars(strip_tags($data['masv']));
            $hoten = htmlspecialchars(strip_tags($data['hoten']));
            $gioitinh = htmlspecialchars(strip_tags($data['gioitinh']));
            $ngaysinh = htmlspecialchars(strip_tags($data['ngaysinh']));
            $hinh = $data['hinh'] ? htmlspecialchars(strip_tags($data['hinh'])) : null;
            $manganh = htmlspecialchars(strip_tags($data['manganh']));

            $stmt->bindParam(":masv", $masv);
            $stmt->bindParam(":hoten", $hoten);
            $stmt->bindParam(":gioitinh", $gioitinh);
            $stmt->bindParam(":ngaysinh", $ngaysinh);
            $stmt->bindParam(":hinh", $hinh);
            $stmt->bindParam(":manganh", $manganh);

            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            throw new Exception("Lỗi khi thêm sinh viên: " . $e->getMessage());
        }
    }

    // Cập nhật sinh viên
    public function update() {
        try {
            // Kiểm tra dữ liệu
            if (empty($this->masv) || empty($this->hoten) || empty($this->gioitinh) || 
                empty($this->ngaysinh) || empty($this->manganh)) {
                throw new Exception("Vui lòng điền đầy đủ thông tin bắt buộc");
            }

            $query = "UPDATE " . $this->table_name . "
                    SET
                        hoten = :hoten,
                        gioitinh = :gioitinh,
                        ngaysinh = :ngaysinh,
                        hinh = :hinh,
                        manganh = :manganh
                    WHERE
                        masv = :masv";
        
            $stmt = $this->conn->prepare($query);
        
            // Làm sạch dữ liệu
            $this->masv = htmlspecialchars(strip_tags($this->masv));
            $this->hoten = htmlspecialchars(strip_tags($this->hoten));
            $this->gioitinh = htmlspecialchars(strip_tags($this->gioitinh));
            $this->ngaysinh = htmlspecialchars(strip_tags($this->ngaysinh));
            $this->manganh = htmlspecialchars(strip_tags($this->manganh));
            // Không làm sạch $this->hinh vì nó có thể là null
        
            // Bind dữ liệu
            $stmt->bindParam(":masv", $this->masv);
            $stmt->bindParam(":hoten", $this->hoten);
            $stmt->bindParam(":gioitinh", $this->gioitinh);
            $stmt->bindParam(":ngaysinh", $this->ngaysinh);
            $stmt->bindParam(":hinh", $this->hinh);
            $stmt->bindParam(":manganh", $this->manganh);
        
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            throw new Exception("Lỗi khi cập nhật sinh viên: " . $e->getMessage());
        }
    }

    // Xóa sinh viên
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE masv = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->masv);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Lấy thông tin một sinh viên
    public function getOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE masv = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->masv);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                // Chỉ gán giá trị khi tồn tại dữ liệu
                $this->hoten = $row['hoten'] ?? '';
                $this->gioitinh = $row['gioitinh'] ?? '';
                $this->ngaysinh = $row['ngaysinh'] ?? '';
                $this->hinh = $row['hinh'] ?? '';
                $this->manganh = $row['manganh'] ?? '';
                return true;
            }
            
            // Reset các thuộc tính nếu không tìm thấy dữ liệu
            $this->hoten = '';
            $this->gioitinh = '';
            $this->ngaysinh = '';
            $this->hinh = '';
            $this->manganh = '';
            return false;
        } catch(PDOException $e) {
            throw new Exception("Lỗi khi lấy thông tin sinh viên: " . $e->getMessage());
        }
    }
}
?> 