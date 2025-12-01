<?php
include '../KetNoi/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order nước</title>
    <link rel="stylesheet" href="../style.css">
    <script src="Sua.js" defer></script>
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
                            <a href="../Them/ThemSP.php">Thêm sản phẩm</a>
                            <a href="../Xoa/XoaSP.php">Xóa sản phẩm</a>
                            <a href="Sua.php">Cập nhật sản phẩm</a>
                        </div>
                    </div>
                    <li><a href="../Cart.php">Giỏ hàng</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MaSP = $_POST['MaSP'];
                $TenSP = $_POST['TenSP'];
                $DanhMuc = $_POST['DanhMuc'];
                $SoLuong = $_POST['SoLuong'];
                $HinhAnh = $_FILES['HinhAnh']['name'];
                $Gia = $_POST['price'];

                // Xử lý hình ảnh
                $target_dir = "../img/";
                $target_file = $target_dir . basename($HinhAnh);
                move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $target_file);
                // Cập nhật sản phẩm trong cơ sở dữ liệu
                $sql = "UPDATE Menu SET TenSP='$TenSP', Loai='$DanhMuc', SoLuong=$SoLuong,HinhAnh='$HinhAnh' ,Gia=$Gia WHERE MaSP='$MaSP'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Cập nhật sản phẩm thành công!');</script> ";
                    $MaSP = $TenSP = $DanhMuc = $SoLuong = $HinhAnh = $Gia = "";
                } else {
                    echo "Lỗi khi cập nhật sản phẩm: " . $conn->error;
                }
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="MaSP">Mã sản phẩm</label><br>
                <input type="text" id="MaSP" name="MaSP" required><br><br>
                <label for="product_name">Tên Sản Phẩm:</label><br>
                <input type="text" id="TenSP" name="TenSP" required><br><br>

                <label for="category">Danh Mục:</label><br>
                <select id="category" name="DanhMuc" required>
                    <option value="TraSua">Trà Sữa</option>
                    <option value="SinhTo">Sinh Tố</option>
                    <option value="Coffee">Coffee</option>
                </select><br><br>
                <label for="SoLuong">Số lượng</label><br>
                <input type="number" id="SoLuong" name="SoLuong" required><br><br>
                <label for="HinhAnh">Hình Ảnh:</label><br>
                <img id="HinhAnh" src="" alt="Hình Ảnh Sản Phẩm" width="100"><br>
                <input type="file" name="HinhAnh" id="HinhAnh"><br><br>
                <label for="price">Giá:</label><br>
                <input type="number" id="price" name="price" required><br><br>
                <input type="submit" value="Cập nhật Sản Phẩm">
                <?php
                $sql1 = "SELECT * FROM Menu";
                $result = $conn->query($sql1);
                if ($result->num_rows > 0) {
                ?>
                    <table border="1">
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Chọn</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td> <?php echo $row['MaSP'] ?> </td>
                                <td> <?php echo $row['TenSP'] ?> </td>
                                <td> <?php echo $row['Loai'] ?> </td>
                                <td><?php echo $row['SoLuong'] ?></td>
                                <td><?php echo $row['Gia'] ?></td>
                                <td>
                                    <input type="radio" name="chon"
                                        onclick="fillForm(
            '<?php echo $row['MaSP']; ?>',
            '<?php echo $row['TenSP']; ?>',
            '<?php echo $row['Loai']; ?>',
            '<?php echo $row['SoLuong']; ?>',
            '<?php echo $row['HinhAnh']; ?>',
            '<?php echo $row['Gia']; ?>'
        )">
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                }
                ?>

            </form>
        </main>
        <footer>
            <p>&copy; 2025 Drink Ordering Service</p>
        </footer>
    </div>
</body>

</html>