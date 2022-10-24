<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
include "../function/connect.php";
include "swal.php";
include('function/head.php');
include "function/slide.php";
include "function/navbar.php";
$result = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE order_id = '$_GET[id]'");
$fetch = mysqli_fetch_array($result);
$show_order = mysqli_query($con, "SELECT * FROM tb_order WHERE order_id = '$_GET[id]'");
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <h2 class="text-center">ออเดอร์ที่สั่ง</h2>
                        <hr>
                        <table class="table text-center table-bordered">
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
                                <td><?= number_format($row['price']); ?></td>
                                <td><?= $row['qty']; ?></td>
                                <td><?= number_format($row['delivery']); ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4">ค่าส่ง <?= number_format($delivery); ?> บาท</td>
                            </tr>
                            <tr>
                                <?php $total_all = $total + $delivery; ?>
                                <td colspan="4">
                                    <h5 class="text-success">ราคารวม <?= number_format($total_all); ?> บาท </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <h2 class="text-center">หลักฐานการโอน</h2>
                    <img src="../<?= $fetch['money_img']; ?>" class="img-fluid w-100" alt="">
                </div>
            </div>
            <a href="check_order.php" class="btn btn-primary col-12">เสร็จสิ้น</a>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $fetch['order_id']; ?>">
                <input type="hidden" name="status" value="0">
                <input name="order_success" type="submit"
                    class="<?= $fetch['status'] == "3" ? 'btn btn-warning col-12' : ''; ?>"
                    value="<?php echo $fetch['status'] == "3" ? 'ตรวจสอบเรียบร้อย' : ''; ?>"
                    onclick="confirmorder(event)">
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
        $_SESSION['success'] = "ตรวจสอบเรียบร้อย";
        echo $use->Swal('success','ตรวจสอบเรียบร้อย','','order.php');
    } else {
        echo "error";
    }
}
?>
<?php include 'function/footer.php'; ?>