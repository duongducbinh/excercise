<?php
// Kết nối đến CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng SinhVien, MonHoc và DangKy sử dụng INNER JOIN
$sql = "SELECT SinhVien.MSSV, SinhVien.HoTen, MonHoc.MaMH, MonHoc.TenMH, DangKy.Ky
        FROM SinhVien
        INNER JOIN DangKy ON SinhVien.MSSV = DangKy.MSSV
        INNER JOIN MonHoc ON MonHoc.MaMH = DangKy.MaMH";

$result = $conn->query($sql);

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giao diện PHP</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Danh sách đăng ký môn học</h1>
    <table>
        <tr>
            <th>MSSV</th>
            <th>Họ và tên</th>
            <th>Mã môn học</th>
            <th>Tên môn học</th>
            <th>Kỳ</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['MSSV']; ?></td>
                <td><?php echo $row['HoTen']; ?></td>
                <td><?php echo $row['MaMH']; ?></td>
                <td><?php echo $row['TenMH']; ?></td>
                <td><?php echo $row['Ky']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
