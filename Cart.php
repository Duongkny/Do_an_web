<?php
include "./KetNoi/db.php";

$sql = "SELECT g.MaGoi, g.MaSP, m.TenSP, g.SoLuong, g.ThanhTien
        FROM goinuoc g
        JOIN menu m ON g.MaSP = m.MaSP";

$result = $conn->query($sql);
?>

<h2>Giỏ hàng</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Mã đơn</th>
    <th>Sản phẩm</th>
    <th>Số lượng</th>
    <th>Thành tiền</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['MaGoi'] ?></td>
    <td><?php echo $row['TenSP'] ?></td>
    <td><?php echo $row['SoLuong'] ?></td>
    <td><?php echo number_format($row['ThanhTien']) ?> đ</td>
</tr>
<?php } ?>

</table>
