<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order nước</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="app">
        <header>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <div class="drowdown">
                        <li class="dropbtn"><a href="#">Order nước</a></li>
                        <div class="dropdown-content">
                            <a href="./TraSua/TraSua.php">Trà sữa</a>
                            <a href="./SinhTo/SinhTo.php">Sinh tố</a>
                            <a href="./Coffee/Coffee.php">Coffee</a>
                        </div>
                    </div>
                    <div class="drowdown">
                        <li class="dropbtn"><a href="#">Chỉnh sửa</a></li>
                        <div class="dropdown-content">
                            <a href="./Them/ThemSP.php">Thêm sản phẩm</a>
                            <a href="./Xoa/XoaSP.php">Xóa sản phẩm</a>
                            <a href="./Sua/Sua.php">Cập nhật sản phẩm</a>
                        </div>
                    </div>
                    <li><a href="Cart.php">Giỏ hàng</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
            include "./KetNoi/db.php";

            $sql = "SELECT g.MaGoi, g.MaSP, m.TenSP, g.SoLuong, g.ThanhTien
        FROM goinuoc g
        JOIN menu m ON g.MaSP = m.MaSP";

            $sql2 = "select Sum(ThanhTien) as TongTien from goinuoc";

            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);
            ?>

            <h2>Giỏ hàng</h2>

            <table border="1" cellpadding="8">
                <tr>
                    <th>Mã đơn</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>

                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['MaGoi'] ?></td>
                        <td><?php echo $row['TenSP'] ?></td>
                        <td><?php echo $row['SoLuong'] ?></td>
                        <td><?php echo number_format($row['ThanhTien']) ?> đ</td>
                    </tr>

                <?php } ?>

                <?php $row2 = $result2->fetch_assoc(); ?>
                <tr>
                    <td colspan="3"><strong>Tổng tiền</strong></td>
                    <td><strong><?php echo number_format($row2['TongTien']) ?> đ</strong></td>
            </table>
            <form action="" method="post">
                <input type="submit" value="Thanh toán" name="btnThanhToan">
            </form>
            <?php
            if (isset($_POST['btnThanhToan'])) {
                $sqlDelete = "DELETE FROM goinuoc";
                if ($conn->query($sqlDelete) === TRUE) {
                    echo "<script>alert('Thanh toán thành công! Giỏ hàng đã được làm mới.'); </script>";
                } else {
                    echo "Lỗi: " . $sqlDelete . "<br>" . $conn->error;
                }
            }
            ?>
        </main>
        <footer>
            <p>&copy; 2025 Drink Ordering Service</p>
        </footer>
    </div>
</body>

</html>