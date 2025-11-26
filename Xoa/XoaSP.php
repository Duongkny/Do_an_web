<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order nước</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../SinhTo/SinhTo.css">
    <script src="../Sua/Sua.js" defer></script>
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
                            <a href="../TraSua/TraSua.html">Trà sữa</a>
                            <a href="../SinhTo/SinhTo.php">Sinh tố</a>
                            <a href="../Coffee/Coffee.php">Coffee</a>
                        </div>
                    </div>
                    <div class="drowdown">
                        <li class="dropbtn"><a href="#">Chỉnh sửa</a></li>
                        <div class="dropdown-content">
                            <a href="../Them/ThemSP.php">Thêm sản phẩm</a>
                            <a href="XoaSP.php">Xóa sản phẩm</a>
                            <a href="../Sua/Sua.php">Cập nhật sản phẩm</a>
                        </div>
                    </div>
                    <li><a href="../Cart.php">Giỏ hàng</a></li>
                </ul>
            </nav>
        </header>
        <?php
        include '../KetNoi/db.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maSP = $_POST['MaSP'];

            $sql = "delete from Menu where MaSP = '" . $maSP . "'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Xóa sản phẩm thành công!'); </script>";
                $maSP = "";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
        <main>
            <?php
            $sql1 = "SELECT * FROM Menu ";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0) {
            ?>
                <form action="" method="post">
                    <label for="">Mã sản phẩm cần xóa</label>
                    <input type="text" name="MaSP" id="MaSP">
                    <input type="submit" value="Xóa sản phẩm">
                    <table border="1">
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại</th>
                            <th>Chọn</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) {

                        ?>
                            <tr>
                                <td> <?php echo $row['MaSP'] ?> </td>
                                <td> <?php echo $row['TenSP'] ?> </td>
                                <td> <?php echo $row['Loai'] ?> </td>
                                <td><input type="radio" name="chon"
                                        onclick="fillForm(
            '<?php echo $row['MaSP']; ?>',
            '<?php echo $row['TenSP']; ?>',
            '<?php echo $row['Loai']; ?>',
            '<?php echo $row['SoLuong']; ?>',
            '<?php echo $row['HinhAnh']; ?>',
            '<?php echo $row['Gia']; ?>'
        )"></td>
                            </tr>

                    <?php

                        }
                    }

                    ?>
                    </table>
                </form>
        </main>
        <footer>
            <p>&copy; 2025 Drink Ordering Service</p>
        </footer>
    </div>
</body>

</html>