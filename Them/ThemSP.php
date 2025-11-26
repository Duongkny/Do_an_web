<?php
include '../KetNoi/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSP = $_POST['MaSP'];
    $tenSP = $_POST['TenSP'];
    $danhMuc = $_POST['DanhMuc'];
    $soLuong = $_POST['SoLuong'];
    $hinhAnh = $_FILES['HinhAnh']['name'];
    $price = $_POST['price'];

    move_uploaded_file($_FILES['HinhAnh']['tmp_name'], "../img/" . $hinhAnh);

    $sql = "INSERT INTO Menu (MaSP,TenSP, Loai, SoLuong, HinhAnh, Gia) VALUES ( '". $maSP . "' , '" . $tenSP . "', '" . $danhMuc . "', " . $soLuong . ", '" . $hinhAnh . "', " . $price . ")";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sản phẩm thành công!'); </script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order nước</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="app">
        <header>
            <nav>
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <div class="drowdown">
                        <li class="dropbtn"><a href="#">Order nước</a></li>
                        <div class="dropdown-content">
                            <a href="../TraSua/TraSua.php">Trà sữa</a>
                            <a href="../SinhTo/SinhTo.php">Sinh tố</a>
                            <a href="../Coffee/Coffee.php">Coffee</a>
                        </div>
                    </div>
                    <div class="drowdown">
                        <li class="dropbtn"><a href="#">Chỉnh sửa</a></li>
                        <div class="dropdown-content">
                            <a href="ThemSP.php">Thêm sản phẩm</a>
                            <a href="../Xoa/XoaSP.php">Xóa sản phẩm</a>
                            <a href="../Sua/Sua.php">Cập nhật sản phẩm</a>
                        </div>
                    </div>
                    <li><a href="../Cart.php">Giỏ hàng</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Thêm Sản Phẩm Mới</h1>
            <form action="ThemSP.php" method="POST" enctype="multipart/form-data">
                <label for="MaSP">Mã sản phẩm</label><br>
                <input type="text" id="MaSP" name="MaSP" required><br><br>
                <label for="product_name">Tên Sản Phẩm:</label><br>
                <input type="text" id="product_name" name="TenSP" required><br><br>

                <label for="category">Danh Mục:</label><br>
                <select id="category" name="DanhMuc" required>
                    <option value="TraSua">Trà Sữa</option>
                    <option value="SinhTo">Sinh Tố</option>
                    <option value="Coffee">Coffee</option>
                </select><br><br>
                <label for="SoLuong">Số lượng</label><br>
                <input type="number" id="SoLuong" name="SoLuong" required><br><br>
                <label for="HinhAnh">Hình ảnh</label><br>
                <input type="file" id="HinhAnh" name="HinhAnh" required><br><br>
                <label for="price">Giá:</label><br>
                <input type="number" id="price" name="price" required><br><br>

                <input type="submit" value="Thêm Sản Phẩm">
            </form>
        </main>
        <footer>
            <p>&copy; 2025 Drink Ordering Service</p>
        </footer>
    </div>
</body>
</html>