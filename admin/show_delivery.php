<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
include "../function/connect.php";
include('function/head.php');
include "function/slide.php";
include "function/navbar.php";
$show_order = mysqli_query($con, "SELECT * FROM tb_order WHERE order_id = '$_GET[id]'");
?>
<div class="container mt-4">
    <div class="card shadow-lg p-3">
        <div class="card-body">
            <h3 class="text-center">ออเดอร์ที่ต้องส่ง</h3>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr class="bg-primary text-white">
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                    </tr>
                    <?php
                    $total = 0;
                    $delivery = 0;
                    foreach ($show_order as $row) {
                        $delivery += $row['delivery'];
                        $total += ($row['price'] * $row['qty']);
                    ?>
                    <tr>
                        <td><?= $row['product']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td><?= $row['qty']; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3">ค่าส่ง <?= $delivery; ?></td>
                    </tr>
                    <tr>
                        <?php $total_all = $total + $delivery; ?>
                        <td colspan="3">
                            <h1>ราคารวม <?= $total_all; ?> บาท</h1>
                        </td>
                    </tr>
                </table>
            </div>
            <a href="delivery.php" class="btn btn-primary col-12 mb-2">ย้อนกลับ</a>
        </div>
    </div>
</div>
<?php include('function/footer.php'); ?>