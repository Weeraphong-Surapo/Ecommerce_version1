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
$result = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE order_id = '$_GET[id]'");
$fetch = mysqli_fetch_array($result);
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">ออเดอร์ที่ต้องส่ง</h3>
            <div class="table-responsive table-hover">
                <table class="table table-bordered text-center ">
                    <tr class="bg-primary text-white">
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>ค่าจัดส่ง</th>
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
                        <td><?= $row['delivery']; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4">ค่าส่ง <?= $delivery; ?></td>
                    </tr>
                    <tr>
                        <?php $total_all = $total + $delivery; ?>
                        <td colspan="4">
                            <h1>ราคารวม <?= $total_all; ?> บาท</h1>
                        </td>
                    </tr>
                </table>
            </div>
            <a href="order.php" class="btn btn-primary col-12 mb-2">กลับหน้าออเดอร์</a>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $fetch['order_id']; ?>">
                <input type="hidden" name="status" value="1">
                <input name="order_success" type="submit"
                    class="<?= $fetch['status'] == "0" ? 'btn btn-warning col-12' : ''; ?>"
                    value="<?php echo $fetch['status'] == "0" ? 'จัดส่งสินค้า' : ''; ?>"
                    onclick="confirmdelivery(event)">
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['order_success'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql = "UPDATE tb_user_delivery SET status = $status WHERE order_id = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['success'] = "จัดส่งสินค้าเรียบร้อย";
        echo '<script>window.location="delivery.php"</script>';
    } else {
        echo "error";
    }
}
?>
<?php include('function/footer.php'); ?>