<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinh Tố</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../SinhTo/SinhTo.css">
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
                            <a href="../Sua/Sua.php">Cập nhật sản phẩm</a>
                        </div>
                    </div>
                    <li><a href="../Cart.php">Giỏ hàng</a></li>
                </ul>
            </nav>
        </header>
        <?php
        include '../KetNoi/db.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['MaSP']) && isset($_POST['Gia']) && isset($_POST['SoLuong'])) {

                $MaSP = $_POST['MaSP'];
                $Gia = $_POST['Gia'];
                $SL = $_POST['SoLuong'];

                $ThanhTien = $Gia * $SL;
                $MaGoi = "GO" . time();

                $sqlInsert = "INSERT INTO goinuoc (MaGoi, MaSP, SoLuong, ThanhTien)
                      VALUES ('$MaGoi', '$MaSP', '$SL', '$ThanhTien')";

                if ($conn->query($sqlInsert) === TRUE) {
                    echo "<script>alert('Đã thêm vào giỏ hàng!'); </script>";
                    $MaSP = "";
                    $MaGoi = "";
                    $SL = 0;
                    $ThanhTien = 0;
                } else {
                    echo "Lỗi SQL: " . $conn->error;
                }
            }
        }




        $sql = "SELECT * FROM Menu WHERE Loai='Coffee'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>

                <main>
                    <form action="" method="post">
                        <div class="row">
                            <div class="column">
                                <h2><?php echo $row['TenSP'] ?></h2>
                                <img src="../img/<?php echo $row['HinhAnh'] ?>" class="drink-image">
                                <p><?php echo $row['Gia'] ?></p>

                                <!-- Gửi dữ liệu cần thiết -->
                                <input type="hidden" name="MaSP" value="<?php echo $row['MaSP']; ?>">
                                <input type="hidden" name="Gia" value="<?php echo $row['Gia']; ?>">
                                <p>Số lượng hiện tại : <?php echo $row['SoLuong'] ?> </p>
                                <input type="number" name="SoLuong" value="1" min="1">

                                <input type="submit" class="button" value="Thêm vào giỏ hàng">
                            </div>
                        </div>
                    </form>

                </main>

        <?php
            }
        }
        ?>


        <footer>
            <p>&copy; 2025 Drink Ordering Service</p>
        </footer>
    </div>
</body>

</html>